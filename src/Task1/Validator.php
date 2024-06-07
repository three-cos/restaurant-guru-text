<?php

namespace Task1;

use InvalidArgumentException;
use Task1\Rules\RuleInterface;
use Throwable;

/**
 * Необходимо написать функцию для валидации постов юзера.
Пользователь в сообщениях может использовать только следующие HTML теги и только с такими атрибутами:
<a href="" title=""> </a>
<code> </code>
<i> </i>
<strike> </strike>
<strong> </strong>
Должна быть проверка на закрытие тегов и корректную вложенность тегов, а также на валидность XHTML.
Логика проверки должна быть реализована с помощью регулярных выражений на PHP, нельзя использовать встроенные функции DOM и подобные.
Функция возвращает true, если сообщение валидно, и false в обратном случае.
 */
class Validator
{
    private const POST_IS_VALID = true;

    private const POST_IS_INVALID = false;

    public function isValid(string $post, array $rules): bool
    {
        try {
            /** @var RuleInterface $rule */
            foreach ($rules as $rule) {
                if (! $rule->isValid($post)) {
                    throw new InvalidArgumentException(
                        sprintf('Post is invalid according to: %s', $rule::class)
                    );
                }
            }
        } catch (Throwable $th) {
            // log $th->getMessage()

            return self::POST_IS_INVALID;
        }

        return self::POST_IS_VALID;
    }
}
