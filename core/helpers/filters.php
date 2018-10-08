<?php

use Crowfeather\Dictionary\ObsceneWord;

if (! function_exists('filter_obscene_words')) {
    /**
     * Filters the forbidden words.
     *
     * @param  string $blurb
     * @return string
     */
    function filter_obscene_words($blurb)
    {
        $blurb = str_replace('<', ' <', $blurb);
        $blurb = str_replace('>', '> ', $blurb);
        $blurb = explode(' ', $blurb);

        $replacer = new ObsceneWord();

        $bannerWords = preg_split('/\r\n|[\r\n]/', settings('banned_words', 'fuck'));
        $replacer->setDictionaryFromArray($bannerWords);

        foreach ($blurb as &$word) {
            $check = trim($word);
            if ((string) settings('is_check_exact_banned_words', true) == "true") {
                if ($replacer->setText($check)->checkAlone()) {
                    $word = $replacer->censor($word);
                }
            } else {
                if ($replacer->setText($check)->checkAmong()) {
                    $word = $replacer->censor($word);
                }
            }
        }

        return implode(" ", $blurb);
    }
}
