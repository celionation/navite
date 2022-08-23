<?php

declare(strict_types=1);

namespace NaviteCore\Session;

interface SessionInterface
{
    /**
     * Set the $key to the value in the session
     *
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws SessionInvalidArguementException MUST be thrown if the $key string is not a legal value.
     */
    public function set(string $key, $value): void;

    /**
     * Sets the specific value to a specific array key of the session
     *
     * @param string $key - The value of item to store
     * @param mixed $value - The value of the item to store. Must be serializable.
     * @return void
     * @throws SessionInvalidArguementException MUST be thrown if the $key string is not a legal value.
     */
    public function setArray(string $key, $value): void;

    /**
     * Get / Return the value of a specific key of the session
     *
     * @param string $key - The key of the item to store.
     * @param mixed $default - The default value to return if the $key cannot be found.
     * @return mixed
     * @throws SessionInvalidArguementException MUST be Thrown.
     */
    public function get(string $key, $default = null);

    /**
     * Remove the value for the specified key from the session.
     *
     * @param string $key - The key of the item that will be unset
     * @return boolean
     * @throws SessionInvalidArguementException
     */
    public function delete(string $key): bool;

    /**
     * Destory the session, Along with session cookies.
     *
     * @since 1.0.0
     * @return void
     */
    public function invalidate(): void;

    /**
     * Returns the request value and remove it from the session.
     *
     * @since 1.0.0
     * @param string $key - The Key to retrieve and remove the value for.
     * @param mixed $value - The Value to return if the requested value cannot be found.
     * @return mixed
     */
    public function flush(string $key, $value = null);

    /**
     * Determine whether an item is request in the session.
     *
     * @param string $key - The session item key.
     * @return boolean
     * @throws SessionInvalidArguementException MUST be thrown if the $key string is not a legal value.
     */
    public function has(string $key): bool;
}