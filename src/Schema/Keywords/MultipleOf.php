<?php

declare(strict_types=1);

namespace League\OpenAPIValidation\Schema\Keywords;

use League\OpenAPIValidation\Schema\Exception\InvalidSchema;
use League\OpenAPIValidation\Schema\Exception\KeywordMismatch;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;
use function sprintf;

class MultipleOf extends BaseKeyword
{
    /**
     * The value of "multipleOf" MUST be a number, strictly greater than 0.
     * A numeric instance is only valid if division by this keyword's value results in an integer.
     *
     * @param mixed     $data
     * @param int|float $multipleOf
     *
     * @throws KeywordMismatch
     */
    public function validate($data, $multipleOf) : void
    {
        try {
            Validator::number()->assert($data);
            Validator::number()->positive()->assert($multipleOf);
        } catch (ValidationException $e) {
            throw InvalidSchema::becauseDefensiveSchemaValidationFailed($e);
        }

        $value = (float) ($data / $multipleOf);
        if ($value - (int) $value !== 0.0) {
            throw KeywordMismatch::fromKeyword('multipleOf', $data, sprintf('Division by %d did not resulted in integer', $multipleOf));
        }
    }
}
