<?php

namespace Task2;

/**
 * Есть строка $text в UTF-8 кодировке и массив слов $array_of_words (в той же самой кодировке). 
 * Необходимо выделить первые вхождения каждого из слов с помощью квадратных скобок (Вася заменить на [Вася]), при этом не учитывать регистр (выделять как вася так и ваСя). 
 * Выделить нужно только целые слова, а не подслова. Например, есть строка «Мама мыла раму» и массив «ама», «раму». В результате должно получиться «Мама мыла [раму]», а не «М[ама] мыла [раму]». 
 */
function highlightWords(string $text, array $array_of_words): string
{
    $array_of_words = array_map('mb_strtolower', $array_of_words);
    $array_of_words = array_combine($array_of_words, $array_of_words);

    $words = explode(' ', $text);

    foreach ($words as &$word) {
        if ($array_of_words === []) {
            break;
        }

        $lowercase_word = mb_strtolower($word);

        if (in_array($lowercase_word, $array_of_words)) {
            $word = "[{$word}]";

            unset($array_of_words[$lowercase_word]);
        }
    }

    return implode(' ', $words);
}
