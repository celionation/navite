<?php

declare(strict_types=1);

namespace NaviteCore\Flash;

use NaviteCore\Flash\FlashTypes;
use NaviteCore\Flash\FlashInterface;
use NaviteCore\Global\GlobalManager;

class Flash implements FlashInterface
{
    protected const FLASH_KEY = 'flash_message';

    public static function add(string $message, string $type = FlashTypes::SUCCESS): void
    {
        $session = GlobalManager::get('global_session');
        if(!$session->has(self::FLASH_KEY)) {
            $session->set(self::FLASH_KEY, []);
        }
        $session->setArray(self::FLASH_KEY, ['message' => $message, 'type' => $type]);
    }

    public static function get()
    {
        $session = GlobalManager::get('global_session');
        $session->flush(self::FLASH_KEY);
    }
}