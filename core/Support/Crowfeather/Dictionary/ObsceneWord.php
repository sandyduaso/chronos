<?php

namespace Crowfeather\Dictionary;

class ObsceneWord
{

    /**
     * List of obscene words.
     *
     * @var array
     */
    private $dictionary = [];

    /**
     * Array of dictionary words.
     *
     * @var array
     */
    private $dictionaryWords = array();

    /**
     * The current string.
     *
     * @var string
     */
    private $text;

    /**
     * The original string.
     *
     * @var string
     */
    private $textOriginal;

    /**
     * The matched word from the dictionary.
     *
     * @var string
     */
    private $match;

    /**
     * Instance of the class.
     *
     * @param array $dictionaryWords
     */
    public function __construct()
    {
        $this->setDictionaryWords();
    }

    /**
     * Fill the variable with only the words of the dictionary,
     * without the original word rules
     *
     * @return void
     */
    private function setDictionaryWords()
    {
        foreach ($this->dictionary as $w) {
            $this->dictionaryWords[] = is_array($w) ? $w[0] : $w;
        }
    }

    /**
     * Set the bad words list from an array
     *
     * @param  array
     * @return this
     * @throws \Exception
     */
    public function setDictionaryFromArray($array)
    {
        if (is_array($array)) {
            $this->dictionary = $array;
            $this->setDictionaryWords($array);

            return $this;
        }

        throw new \Exception('Invalid dictionary, try to send an array or a file path!');
    }

    /**
     * Set the bad words list from a file
     *
     * @param  string
     * @return this
     * @throws \Exception
     */
    public function setDictionaryFromFile($path)
    {
        if (file_exists($path)) {
            $dict = include $path;
            if (is_array($dict)) {
                $this->dictionary = $dict;
                $this->setDictionaryWords();
                return $this;
            }
            throw new \Exception('The file content must be an array!');
        }
        throw new \Exception('File not found in ' . $path);
    }

    /**
     * Set the text to be checked
     *
     * @param string
     * @return this
     */
    public function setText($text)
    {
        $this->textOriginal = $text;
        $this->text = preg_replace("/([^\w ]*)/iu", "", $text);
        return $this;
    }

    /**
     * Checks for bad words in the text but verifies each dictionary word rule,
     * like alone ou among each word in the text.
     *
     * @return boolean
     */
    public function check()
    {
        foreach ($this->dictionary as $word):
            $rule = "alone";
        if (is_array($word)) {
            $rule = isset($word[1]) ? $word[1] : $rule;
            $word = $word[0];
        }
        $word = preg_replace("/([^\w ]*)/iu", "", $word);
        if ("among" === $rule) {
            if (preg_match("/(" . $word . ")/iu", $this->text)) {
                return true;
            }
        } else {
            if (preg_match("/(\b)+(" . $word . ")+(\b)/iu", $this->text)) {
                return true;
            }
        }
        endforeach;
        return false;
    }

    /**
     * Checks if the text has a bad word among each word
     *
     * @return boolean
     */
    public function checkAmong()
    {
        preg_match_all("/(" . join("|", $this->dictionaryWords) . ")/iu", $this->text, $matches);
        $this->match = end($matches[1]);
        return !! $this->match; //preg_match("/(" . join("|", $this->dictionaryWords) . ")/iu", $this->text);
    }

    /**
     * Checks if the text has a bad word exactly how it appears in the dictionary
     *
     * @return boolean
     */
    public function checkAlone()
    {
        return !! preg_match("/(\b)+(" . join("|", $this->dictionaryWords) . ")+(\b)/iu", $this->text);
    }

    /**
     * Replace banned word with asterisk.
     *
     * @param  string $word
     * @return string
     */
    public function censor($word, $replace = "*")
    {
        $replacer = str_repeat($replace, strlen($this->match));
        return str_replace($this->match, $replacer, $word);
    }
}
