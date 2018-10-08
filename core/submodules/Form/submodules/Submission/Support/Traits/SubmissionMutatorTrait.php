<?php

namespace Submission\Support\Traits;

use Crowfeather\Traverser\Traverser;
use Field\Models\Field;

trait SubmissionMutatorTrait
{
    /**
     * Array of choices.
     *
     * @var array
     */
    protected $choices;

    /**
     * Gets the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }

    /**
     * Gets the employee count submitted.
     *
     * @return string
     */
    public function getCountAttribute()
    {
        return $this->count();
    }

    /**
     * Get the unserialized results column.
     *
     * @return array
     */
    public function getResultedAttribute()
    {
        return unserialize($this->results) ?? [];
    }

    /**
     * Collection of unserialized results with metadata.
     *
     * @return Object
     */
    public function fields()
    {
        $fields = [];
        foreach (collect($this->resulted)->except(['type']) as $name => $resulted) {
            $fields[$name]['question'] = $field = Field::find($resulted['field_id']);
            $fields[$name]['guess'] = $resulted[$name] ?? null;
            $fields[$name]['choices'] = $choices = $this->choices($field->value ?? '');
            $fields[$name]['answer'] = $this->getCorrectAnswer($field->value ?? '');
            $fields[$name]['points'] = $field->points;
            $fields[$name]['respondents'] = $this->getChoicesWithRespondents($choices, $field);
            $fields[$name]['isCorrect'] = $this->isCorrect($field->value ?? '', $resulted[$name]);
        }

        return json_decode(json_encode($fields));
    }

    /**
     * Gets the array of choices.
     *
     * @param  string $string
     * @return array
     */
    public function choices($string)
    {
        $values = explode('|', $string);

        foreach ($values as $choice) {
            $choices[] = preg_replace('/\*/i', '', $choice);
        }

        return $choices ?? [];
    }

    /**
     * Gets the correct answer.
     *
     * @param  string $string
     * @return mixed
     */
    public function getCorrectAnswer($string)
    {
        $choices = explode('|', $string);

        foreach ($choices as $choice) {
            if (strpos($choice, '*')) {
                return preg_replace('/\*/i', '', $choice);
            }
        }

        return false;
    }

    /**
     * Checks if the given guess is correct.
     *
     * @param  string $value
     * @return boolean
     */
    public function isCorrect($value, $guess)
    {
        return $this->getCorrectAnswer($value) === $guess;
    }

    /**
     * Computes the score of resource.
     *
     * @return string
     */
    public function compute()
    {
        $fields = $this->fields();
        $score = [];
        foreach ($fields as $field) {
            if ($field->isCorrect) {
                $score[] = $field->points;
            }
        }

        return array_sum($score);
    }

    /**
     * Gets the mutated score column.
     *
     * @return string
     */
    public function getScoredAttribute()
    {
        return $this->compute() . "/" . count((array) $this->fields());
    }

    /**
     * Gets the total number of respondents.
     *
     * @param  string $choices
     * @return int
     */
    public function getChoicesWithRespondents($choices, $field)
    {
        $choices = $this->choices($field->value);
        $c = [];
        foreach ($choices as $answer) {
            $result = array_count_values($this->getRespondentsWhoAnswered($answer, $field->name));
            $c[$answer]['count'] = array_shift($result);
            $c[$answer]['percentage'] = $this->getPercentageCount($c[$answer]['count'], $this->form->submissions->count());
        }

        return collect($c)->sortBy('percentage', 0, true);
    }

    public function getRespondentsWhoAnswered($answer, $name)
    {
        $submissions = $this->form->submissions;
        $sub = [];
        foreach ($submissions as $i => $submission) {
            if($answer == $submission->resulted[$name][$name]) {
                $sub[] = $submission->resulted[$name][$name];
            }
        }

        return $sub;
    }

    public function getPercentageCount($x, $total)
    {
        return ($x / $total) * 100;
    }
}
