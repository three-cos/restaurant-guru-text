<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Task1\Rules\AllowedAttributesRule;
use Task1\Rules\TagsAreClosedRule;
use Task1\Rules\TagsWhitelistRule;

class RulesTest extends TestCase
{
    #[Test]
    #[DataProvider('closedTagsProvider')]
    public function tag_must_be_closed_rule_works(string $post, bool $expectedResult): void
    {
        $rule = new TagsAreClosedRule();

        $this->assertEquals(
            $expectedResult,
            $rule->isValid($post)
        );
    }

    #[Test]
    #[DataProvider('whitelistTagsProvider')]
    public function tag_whitelist_rule_works(string $post, bool $expectedResult): void
    {
        $rule = new TagsWhitelistRule();

        $this->assertEquals(
            $expectedResult,
            $rule->isValid($post)
        );
    }

    #[Test]
    #[DataProvider('allowedAttributesProvider')]
    public function allowed_attributes_rule_works(string $post, bool $expectedResult): void
    {
        $rule = new AllowedAttributesRule();

        $this->assertEquals(
            $expectedResult,
            $rule->isValid($post)
        );
    }

    public static function closedTagsProvider(): array
    {
        return [
            ['<a></a>', true],
            ['<a><img /></a>', true],
            ['<a><a></a></a>', true],
            ['<a><span></span></a>', true],
            ['<a></span><span></a>', false],
            ['<a><a>', false],
            ['</a></a>', false],
            ['<a></a></a>', false],
            ['<a><a></a>', false],
            ['<a></span>', false],
            ['<span></a>', false],
        ];
    }

    public static function whitelistTagsProvider(): array
    {
        return [
            ['<a></a>', true],
            ['<a href=""></a>', true],
            ['<code></code>', true],
            ['<i></i>', true],
            ['<strike></strike>', true],
            ['<strong></strong>', true],
            ['<p></p>', false],
            ['<div></div>', false],
            ['<img />', false],
        ];
    }

    public static function allowedAttributesProvider(): array
    {
        return [
            ['<a href="" title=""></a>', true],
            ['<a href=""></a>', true],
            ['<a title=""></a>', true],
            ['<a target=""></a>', false],
            ['<a onload=""></a>', false],
            ['<script src=""></script>', true], // no attribute rule is set for script tag, so it passed as valid!
        ];
    }
}
