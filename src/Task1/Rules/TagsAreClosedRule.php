<?php

namespace Task1\Rules;

class TagsAreClosedRule implements RuleInterface
{
    public function isValid(string $post): bool
    {
        preg_match_all('/<\/?[\w\s=":\.\/]+\/?>/', $post, $tagMatches);

        $openTagStack = [];

        foreach ($tagMatches[0] as $tag) {
            if (preg_match('/<\/(?<tag>\w*)>/', $tag, $closeMatch)) {
                if (empty($openTagStack) || array_pop($openTagStack) !== $closeMatch['tag']) {
                    return false;
                }
            } elseif (! preg_match('/\/>$/', $tag)) {
                if (preg_match('/<(?<tag>\w*)/', $tag, $openMatch)) {
                    $openTagStack[] = $openMatch['tag'];
                }
            }
        }

        if (! empty($openTagStack)) {
            return false;
        }

        return true;
    }
}
