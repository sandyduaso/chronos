<?php

namespace Parchment\Helpers;

class Word
{
    /**
     * Returns an abbreviated word.
     *
     * @param  string  $string
     * @param  boolean $dotted
     * @param  string  $glue
     * @param  string  $delimiter
     * @return string
     */
    public function acronymize($string = "",  $dotted = false, $glue = ".", $delimiter = " ")
    {
        $string = explode( $delimiter, $string );
        $str_arr = [];

        foreach ( $string as $str ) {
            if ( isset( $str[0] ) ) $str_arr[] = $str[0];
        }

        $acronym = implode( $glue, $str_arr );

        return $acronym . ( $dotted ? $glue : '');
    }

    /**
     * Static alias for acronymize.
     *
     * @param  string  $string
     * @param  boolean $dotted
     * @param  string  $glue
     * @param  string  $delimiter
     * @return string
     */
    public static function acronym($string = "",  $dotted = false, $glue = ".", $delimiter = " ")
    {
        return (new self)->acronymize($string, $dotted, $glue, $delimiter);
    }

    /**
     * Converts bytes into nearest unit.
     *
     * @param  integer  $bytes
     * @param  integer  $precision
     * @param  array    $units
     * @return string
     */
    public static function bytes($bytes, $precision = 2, $units = [])
    {
        $units = array_merge($units, array('B', 'KB', 'MB', 'GB', 'TB'));
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
