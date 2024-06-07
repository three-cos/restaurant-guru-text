<?php

namespace Task1\Rules;

class TagsAreClosedRule implements RuleInterface
{
    public function isValid(string $post): bool
    {
        preg_match_all('/<\/?[\w\s="]+\/?>/', $post, $tagMatches);

        $tagStack = [];

        foreach ($tagMatches[0] as $tag) {
            if (preg_match('/<\/(?<tag>\w*)>/', $tag, $closeMatch)) {
                if (empty($tagStack) || array_pop($tagStack) !== $closeMatch['tag']) {
                    return false;
                }
            } elseif (! preg_match('/\/>$/', $tag)) {
                if (preg_match('/<(?<tag>\w*)/', $tag, $openMatch)) {
                    $tagStack[] = $openMatch['tag'];
                }
            }
        }

        if (! empty($tagStack)) {
            return false;
        }

        return true;
    }
}
