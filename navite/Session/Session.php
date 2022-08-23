<?php

declare(strict_types=1);

namespace NaviteCore\Session;

use NaviteCore\Session\Exception\SessionException;
use NaviteCore\Session\Exception\SessionInvalidArguementException;
use Throwable;
use NaviteCore\Session\SessionInterface;
use NaviteCore\Session\Storage\SessionStorageInterface;

class Session implements SessionInterface
{
    protected SessionStorageInterface $storage;

    protected string $sessionName;

    protected const SESSION_PATTERN = "/^[a-zA-Z0-9_\.](1,64)$/";

    /**
     * Session Constructor.
     *
     * @param string $sessionName
     * @param SessionStorageInterface|null $storage
     * @throws SessionInvalidArguementException
     */
    public function __construct(string $sessionName, SessionStorageInterface $storage = null)
    {
        if($this->isSessionKeyValid($sessionName) === false) {
            throw new SessionInvalidArguementException($sessionName . " Is not a Valid Session Name.");
        }
        $this->sessionName = $sessionName;
        $this->storage = $storage;
    }

    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws SessionException
     */
    public function set(string $key, $value): void
    {
        $this->ensureSessionKeyIsValid($key);
        try {
            $this->storage->setSession($key, $value);
        } catch (Throwable $e) {
            throw new SessionException("An Exception was thrown in retrieving the key from session storage. " . $e);
        }
    }

    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws SessionException
     */
    public function setArray(string $key, $value): void
    {
        $this->ensureSessionKeyIsValid($key);
        try {
            $this->storage->setArraySession($key, $value);
        } catch (Throwable $e) {
            throw new SessionException("An Exception was thrown in retrieving the key from session storage. " . $e);
        }
    }

    /**
     * @inheritDoc
     *
     * @param string $key
     * @param mixed $default
     * @return void
     * @throws SessionException
     */
    public function get(string $key, $default = null)
    {
        $this->ensureSessionKeyIsValid($key);
        try {
            return $this->storage->getSession($key, $default);
        } catch (Throwable $e) {
            throw new SessionException("An Exception was thrown in retrieving the key from session storage. " . $e); 
        }
    }

    /**
     * @inheritDoc
     *
     * @param string $key
     * @return boolean
     * @throws SessionException
     */
    public function delete(string $key): bool
    {
        $this->ensureSessionKeyIsValid($key);
        try {
            $this->storage->deleteSession($key);
        } catch (Throwable $e) {
            throw new SessionException("An Exception was thrown in retrieving the key from session storage. " . $e);
        }
        return true;
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function invalidate(): void
    {
        $this->storage->invalidate();
    }

    /**
     * @inheritDoc
     *
     * @param string $key
     * @param [type] $value
     * @return void
     * @throws SessionException
     */
    public function flush(string $key, $value = null)
    {
        $this->ensureSessionKeyIsValid($key);
        try {
            $this->storage->flush($key, $value);
        } catch (Throwable $e) {
            throw new SessionException("An Exception was thrown in retrieving the key from session storage. " . $e);
        }
    }

    /**
     * @inheritDoc
     *
     * @param string $key
     * @return boolean
     */
    public function has(string $key): bool
    {
        $this->ensureSessionKeyIsValid($key);
        return $this->storage->hasSession($key);
    }

    protected function isSessionKeyValid(string $key): bool
    {
        return (preg_match(self::SESSION_PATTERN, $key) === 1);
    }

    protected function ensureSessionKeyIsValid(string $key): void
    {
        if($this->isSessionKeyValid($key) === false) {
            throw new SessionInvalidArguementException($key . " Is not a Valid Session Key");
        }
    }
}