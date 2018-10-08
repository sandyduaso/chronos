<?php

namespace Field\Support\Traits;

trait TemplateTrait
{
    /**
     * The template of the current field.
     *
     * @var string
     */
    protected $template;

    /**
     * The code of the fieldtype.
     *
     * @var string
     */
    protected $code;

    /**
     * Retrieves the template for the given field.
     *
     * @param  string $code
     * @param  string $templateFieldName
     * @return mixed
     */
    public function template($code = null, $templateFieldName = null)
    {
        $this->code = $code ?? $this->fieldtype->code;

        if (! is_null($templateFieldName)) {
            $this->template = $this->{$templateFieldName};
        } else {
            $this->template = $this->fieldtype->where('code', $this->code)->first()->template;
        }

        if (is_null($this->template)) {
            $this->template = $this->getDefaultTemplate();
        }

        return $this;
    }

    /**
     * HTML render of a default input field.
     *
     * @return string
     */
    public function getDefaultTemplate()
    {
        return '<input type="%type%" name="%name%" placeholder="%label%" %attributes%>';
    }

    /**
     * Render the current field's using the given template.
     *
     * @return html|string
     */
    public function render()
    {
        $template = $this->template;
        $template = $this->attachInputTags($template);
        $template = $this->replaceKeyVariables($template);
        $template = $this->replaceInputElement($template);

        return $template;
    }

    /**
     * Mutates the column `attributes` into a string.
     *
     * @return string
     */
    public function getAttributedAttribute()
    {
        $attributes = array_filter(array_map('trim', explode(PHP_EOL, $this->attribute)));

        foreach ($attributes as &$attribute) {
            $attribute = explode('=', $attribute)[0]
                            . "="
                            . '"'
                            . str_replace(
                                ['"', "'"],
                                '',
                                trim(explode('=', $attribute)[1] ?? '')
                              )
                            . '"';
        }

        return implode(' ', $attributes);
    }

    /**
     * Replaces the Key Variables with actual value.
     *
     * @param  string $template
     * @return string
     */
    public function replaceKeyVariables($template)
    {
        $template = preg_replace('/%name%/', $this->name, $template);
        $template = preg_replace('/%label%/', $this->label, $template);
        $template = preg_replace('/%tabindex%/', $this->sort, $template);
        $template = preg_replace('/%field_id%/', $this->id, $template);
        $template = preg_replace('/%type%/', $this->type, $template);
        $template = preg_replace('/%attributes%/', $this->attributed, $template);
        $template = preg_replace('/%value%/', '', $template);
        // $template = preg_replace('/%value%/', $this->value, $template);

        return $template;
    }

    /**
     * Replaces the input element.
     *
     * @param  string $template
     * @return string
     */
    public function replaceInputElement($template)
    {
        switch ($this->code) {
            case 'vuetify-select':
            case 'vuetify-radio':
            case 'vuetify-checkbox':
            case 'select':
            case 'radio':
            case 'radio-field':
            case 'checkbox':
                $values = explode('|', $this->value);

                foreach ($values as &$value) {
                    $value = str_replace('*', '', $value);
                    $value = str_replace("’", "&quot;", $value);
                    $value = str_replace("'", "&quot;", $value);
                    $value = addslashes($value);
                }
                // $values = addslashes(json_encode($values));

                $template = preg_replace('/%items%/', json_encode($values), $template);
                // dd($template);

                return $template;
                break;

            default:
                return $template;
                break;
        }

        return $template;
    }

    /**
     * Attaches an HTML input tag with the value of the `field_id`
     * and the field %name%.
     *
     * @param  string $template
     * @return string
     */
    public function attachInputTags($template)
    {
        $template .= '<input type="hidden" name="%name%[field_id]" value="%field_id%">';

        return $template;
    }
}
