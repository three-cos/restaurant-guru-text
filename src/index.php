<?php

include_once './vendor/autoload.php';

use Task1\Rules\AllowedAttributesRule;
use Task1\Rules\TagsAreClosedRule;
use Task1\Rules\TagsWhitelistRule;
use Task1\Validator;

use function Task2\highlightWords;

$validator = new Validator();

$examplePost = '<a></a>';

$result = $validator->isValid($examplePost, [
    new AllowedAttributesRule,
    new TagsAreClosedRule,
    new TagsWhitelistRule,
]);

var_dump($result); // true

var_dump(
    highlightWords('Мама мыла раму', ['ама', 'раму']) // Мама мыла [раму]
);