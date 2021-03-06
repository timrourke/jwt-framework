<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2018 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose\Component\Core\Util;

/**
 * Class Hash.
 */
final class Hash
{
    /**
     * Hash Parameter.
     *
     * @var string
     */
    private $hash;

    /**
     * Hash Length.
     *
     * @var int
     */
    private $length;

    /**
     * @return Hash
     */
    public static function sha1(): self
    {
        return new self('sha1', 20);
    }

    /**
     * @return Hash
     */
    public static function sha256(): self
    {
        return new self('sha256', 32);
    }

    /**
     * @return Hash
     */
    public static function sha384(): self
    {
        return new self('sha384', 48);
    }

    /**
     * @return Hash
     */
    public static function sha512(): self
    {
        return new self('sha512', 64);
    }

    /**
     * @param string $hash
     * @param int    $length
     */
    private function __construct(string $hash, int $length)
    {
        $this->hash = $hash;
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Compute the HMAC.
     *
     * @param string $text
     *
     * @return string
     */
    public function hash(string $text): string
    {
        return hash($this->hash, $text, true);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->hash;
    }
}
