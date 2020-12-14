<?php

declare(strict_types=1);

namespace League\OpenAPIValidation\Schema\Exception;

use Throwable;

// Indicates that data was not matched against a schema's keyword
class KeywordMismatch extends SchemaMismatch
{
    /** @var string */
    protected $keyword;

    /**
     * @param mixed $data
     *
     * @return KeywordMismatch
     */
    public static function fromKeyword(string $keyword, $data, ?string $message = null, ?Throwable $prev = null) : self
    {
        $instance          = new static(sprintf('Keyword validation failed_: %s ', $message

        ), 0, $prev);
        $instance->keyword = $keyword;
        $instance->data    = $data;

        return $instance;
    }

    public function keyword() : string
    {
        return $this->keyword;
    }

    public function err() : string
    {
        return $this->getRawData();
    }
}
