<?php

namespace Task1\Rules;

class TagsWhitelistRule implements RuleInterface
{
    private const VALID_TAGS = [
        'a',
        'code',
        'i',
        'strike',
        'strong',
    ];

    public function isValid(string $post): bool
    {
        preg_match_all('/<(?<openTags>[\w]*)\b[^>]*?>/', $post, $tags);

        return array_diff($tags['openTags'], self::VALID_TAGS) === [];
    }
}
