<?php

declare(strict_types=1);

namespace NaviteCore\Session\Storage;

interface SessionStorageInterface
{
    public function setSessionName(string $sessionName): void;

    public function getSessionName(): string;

    public function setSessionID(string $sessionID): void;

    public function getSessionID();

    public function setSession(string $key, $value): void;

    public function setArraySession(string $key, $value): void;

    public function getSession(string $key, $default = null);

    public function deleteSession(string $key): void;

    public function invalidate(): void;

    public function flush(string $key, $default = null);

    public function hasSession(string $key): bool;
}