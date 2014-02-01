<?php
namespace niclasleonbock\Volcano;

class Volcano
{
    /**
     * Implodes an array using either a callable function or a string as glue.
     *
     * @param  callable|string $glue A callable (function) or string to use for glueing the elements.
     * @return string
     */
    public static function implode($glue, array $pieces)
    {
        if (is_callable($glue)) {
            $string = '';

            foreach ($pieces as $count => $piece) {
                $string .= $piece;

                if ($count < count($pieces)-1) {
                     $string .= call_user_func($glue, $piece, $count);
                }
            }

            return $string;
        }

        if (is_string($glue)) {
            return implode($glue, $pieces);
        }
    }

    /**
     * Implodes a string using either a callable function or a string as glue.
     *
     * @param  string $delimeter Delimeter to use for splitting the elements.
     * @param  string $string    String to be split.
     * @param  int    $int       Additional integer, used for limit in explode or chunk size in str_split.
     * @return array
     */
    public static function explode($delimiter, $string, $int = 1)
    {
        if ($delimiter == '') {
            return str_split($string, $int);
        }

        return explode($delimiter, $string, $int);
    }
}
