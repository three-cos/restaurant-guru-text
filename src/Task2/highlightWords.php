<?php

namespace Task2;

function highlightWords(string $text, array $array_of_words): string
{
    $array_of_words = array_map('mb_strtolower', $array_of_words);
    $words = explode(' ', $text);

    foreach ($words as &$word) {
        if (in_array(mb_strtolower($word), $array_of_words)) {
            $word = "[{$word}]";
        }
    }

    return implode(' ', $words);
}