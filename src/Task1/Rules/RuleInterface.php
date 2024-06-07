<?php

namespace Task1\Rules;

interface RuleInterface
{
    public function isValid(string $post): bool;
}