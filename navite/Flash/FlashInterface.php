<?php

declare(strict_types=1);

namespace NaviteCore\Flash;

use NaviteCore\Flash\FlashTypes;

interface FlashInterface
{
    /**
     * Add a flash message stored within the session.
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public static function add(string $message, string $type = FlashTypes::SUCCESS): void;

    /**
     * Get all the message within the session.
     *
     * @return void
     */
    public static function get();
}