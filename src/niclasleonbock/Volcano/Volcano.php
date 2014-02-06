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
    public static function implode($glue, $pieces)
    {
        if (!is_array($pieces) && !$pieces instanceof \Traversable) {
            throw new \InvalidArgumentException('Pieces must be iterable (array or traversable).');
        }

        if (is_callable($glue) || !is_array($pieces)) {
            $string = '';

            $total = is_array($pieces) ? count($pieces) : iterator_count($pieces);
            $count = 0;

            foreach ($pieces as $key => $piece) {
                $count++;
                $string .= $piece;

                if ($count < $total) {
                     $string .= is_string($glue) ? $glue : call_user_func($glue, $piece, $key, $count, $pieces);
                }
            }

            return $string;
        }

        if (is_string($glue)) {
            return implode($glue, $pieces);
        }
    }

    /**
     * Explodes a string delimited by another string or an array of strings.
     *
     * @param  string|array $delimeter Delimeter to use for splitting the elements.
     * @param  string $string    String to be split.
     * @return array
     */
    public static function explode($delimiter, $string)
    {
        if (!is_array($delimiter) && !is_string($delimiter)) {
            throw new \InvalidArgumentException('Delimiter must be of type array or string.');
        }

        if ($delimiter == '') {
            return str_split($string);
        }

        if (is_array($delimiter)) {
            return self::multiexplode($delimiter, $string);
        }

        return explode($delimiter, $string);
    }

    /**
     * Explodes a string delimited by an array of strings.
     *
     * @param  array $delimeter Delimeter to use for splitting the elements.
     * @param  string $string    String to be split.
     * @return array
     */
    public static function multiexplode(array $delimiters, $string)
    {
        $delimiter = array_values($delimiters)[0];

        return explode($delimiter, str_replace($delimiters, $delimiter, $string));
    }
}
