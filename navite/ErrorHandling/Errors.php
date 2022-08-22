<?php

declare(strict_types=1);

namespace NaviteCore\Error;

class Errors
{
    /**
     * @var array of error messages with codes
     * @property array of error messages with codes
     */
    private static array $_errors = [
        // 1xxx: Routing and Loading errors
        1000 => '[ERROR 1000] Invalid Http Request Method ',
        1001 => '[ERROR 1001] Invalid Controller or Action ',
        1002 => '[ERROR 1002] Invalid library ',
        1003 => '[ERROR 1003] Property cannot be found ',
        1004 => '[ERROR 1004] Access Denied',
        1005 => '[ERROR 1005] Security Error - Cross Site Forgery',

        //2xxx: Database Errors
        2000 => '[ERROR 2000] Database Connection Error ',
        2001 => '[ERROR 2001] Database Security Error - Not allowed to perform such an operation ',
        2002 => '[ERROR 2002] Database Query Error ',
        2003 => '[ERROR 2003] Database Query Error - Something went wrong in executing the query',


        //3xxx: Request Errors
        3000 => '[ERROR 3000] Security Error - Cross Site Forgery',

        //4xxx: Mail Errors
        4000 => '[ERROR 4000] Mail Error - Mailer could not be initialized',
        4001 => '[ERROR 4001] Mail Error - Mail Content is not compliant',


        //5xxx: Navite Errors
        5000 => '[ERROR 5000] Key Generator Error - Generator could not generate keys',
        5001 => '[ERROR 5001] Views Error - The View Page does not Exists',
        5002 => '[ERROR 5002] Layouts Error - The Layout does not Exists',
        5003 => '[ERROR 5003] Key Validity Error - Your start method requires a valid key.',
        5004 => '[ERROR 5004] Start Method Error - You must first run the start method.',


        //6xxx: Navite Container Errors
        6000 => '[ERROR 6000] Class Instantiable - Class is not instantiable',
        6001 => '[ERROR 6001] Failed To Param - Failed to resolve class because param is missing a type hint',
        6002 => '[ERROR 6002] Failed To Union - Failed to resolve class because of union type for param is missing a type hint',
        6003 => '[ERROR 6003] Failed Invalid Param - Failed to resolve class because of invalid param',
    ];

    /**
     * Get error message based on error code
     * @param string $errorCode identifies the error code
     * @return string identifying the error message
     */
    public static function get(string $errorCode): string
    {
        return self::$_errors[$errorCode];
    }

    /**
     * Set error message
     * @param string $errorMessage
     * @param mixed $errorCode
     * @return string
     */
    public static function set(string $errorMessage, $errorCode): string
    {
        self::$_errors[$errorCode] = !isset(self::$_errors[$errorCode]) ? $errorMessage : self::$_errors[$errorCode] . " - " . $errorMessage;
        return self::$_errors[$errorCode];
    }
}