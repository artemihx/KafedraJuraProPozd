<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class EmailValidator extends AbstractValidator
{
    protected string $message = 'Field :field must be a valid email';

    public function rule(): bool
    {
        return !empty($this->value) && strpos($this->value, '@') !== false;
    }
}