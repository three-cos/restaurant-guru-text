<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Task2\highlightWords;

class WordHighlightTest extends TestCase
{
    #[Test]
    #[DataProvider('textDataProvider')]
    public function text_higlight_works(string $text, array $words, string $expectedResult): void
    {
        $this->assertEquals(
            $expectedResult,
            highlightWords($text, $words)
        );
    }

    public static function textDataProvider(): array
    {
        return [
            ['Мама мыла раму', ['ама', 'раму'], 'Мама мыла [раму]'],
            ['Мама мыла раму', ['АМА', 'РАМУ'], 'Мама мыла [раму]'],
            ['Мама мыла РАМУ', ['АМА', 'РАМУ'], 'Мама мыла [РАМУ]'],
            ['Мама мыла РАМУ', ['АМА', 'раму'], 'Мама мыла [РАМУ]'],
            ['Вася', ['вася'], '[Вася]'],
            ['вася', ['вася'], '[вася]'],
            ['ваСя', ['вася'], '[ваСя]'],
            ['Мама мыла мыла раму раму', ['мыла', 'раму'], 'Мама [мыла] мыла [раму] раму'],
            ['Мама МЫЛА мыла РАМУ раму', ['мыла', 'раму'], 'Мама [МЫЛА] мыла [РАМУ] раму'],
        ];
    }
}
