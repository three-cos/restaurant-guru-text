<?php

namespace Task1\Rules;

class AllowedAttributesRule implements RuleInterface
{
    public const VALID_ATTRIBUTES = [
        'a' => [
            'href',
            'title',
        ],
    ];

    public function isValid(string $post): bool
    {
        preg_match_all('/<(?<tag>[\w]*)\b(?<attributeString>[^>]*)?>/', $post, $matches);

        for ($i = 0; $i < count($matches['tag']); $i++) {
            $tag = $matches['tag'][$i];
            $attributesString = trim($matches['attributeString'][$i]);

            if (! array_key_exists($tag, self::VALID_ATTRIBUTES)) {
                continue;
            }

            preg_match_all('/(?<attributes>\w*)=\"\w*\"/', $attributesString, $attributes);

            if (array_diff($attributes['attributes'], self::VALID_ATTRIBUTES[$tag]) !== []) {
                return false;
            }
        }

        return true;
    }
}
