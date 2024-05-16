<?php

namespace App\Classes\Helpers;

use RuntimeException;
use Throwable;

final class JsonConverter
{
    /**
     * @param mixed $payload
     *
     * @throws RuntimeException if the payload cannot be encoded
     */
    public static function encode($payload): string
    {
        try {
            return json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } catch (Throwable $throwable) {
            throw new RuntimeException('Invalid content.', $throwable->getCode(), $throwable);
        }
    }

    /**
     * @throws RuntimeException if the payload cannot be decoded
     *
     * @return mixed
     */
    public static function decode(string $payload)
    {
        try {
            return json_decode($payload, true, 512, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } catch (Throwable $throwable) {
            throw new RuntimeException('Invalid content.', $throwable->getCode(), $throwable);
        }
    }
}
