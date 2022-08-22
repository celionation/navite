<?php

declare(strict_types=1);

namespace NaviteCore\Session\Storage;

use NaviteCore\Session\Storage\AbstractSessionStorage;

class NativeSessionStorage extends AbstractSessionStorage
{
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    public function setSession(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function setArraySession(string $key, $value): void
    {
        $_SESSION[$key][] = $value;
    }

    public function getSession(string $key, $default = null)
    {
        if($this->hasSession($key)) {
            return $_SESSION[$key];
        }
        return $default;
    }

    public function deleteSession(string $key): void
    {
        if($this->hasSession($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function invalidate(): void
    {
        $_SESSION = array();
        if(ini_get('session.use.cookies')) {
            $params = session_get_cookie_params();
            setcookie($this->getSessionName(), '', time() - $params['lifetime'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_unset();
        session_destroy();
    }

    public function flush(string $key, $default = null)
    {
        if($this->hasSession($key)) {
            $value = $_SESSION[$key];
            $this->deleteSession($key);
            return $value;
        }
        return $default;
    }

    public function hasSession(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}