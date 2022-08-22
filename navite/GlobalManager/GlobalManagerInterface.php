<?php

declare(strict_types=1);

namespace NaviteCore\GlobalManager;

interface GlobalManagerInterface
{
    /**
     * Set the global variables.
     *
     * @param string $key
     * @param $value
     * @return void
     */
    public static function set(string $key, $value): void;

    /**
     * Get the value of the global variable.
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key);
}