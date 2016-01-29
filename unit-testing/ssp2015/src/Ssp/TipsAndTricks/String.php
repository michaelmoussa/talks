<?php

namespace Ssp\TipsAndTricks;

class String
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Reverses a string.
     *
     * Yes, we can use "strrev", but that would not be a very interesting example.
     *
     * @return string
     */
    public function reverse()
    {
        $reversed = '';

        for ($i = strlen($this->text); $i >= 0; --$i) {
            $reversed .= substr($this->text, $i, 1);
        }

        return $reversed;
    }
}
