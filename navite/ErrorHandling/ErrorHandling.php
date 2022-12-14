<?php

declare(strict_types=1);

namespace NaviteCore\ErrorHandling;

use ErrorException;
use NaviteCore\Base\BaseView;

class ErrorHandling
{
    /**
     * Error Handler - Convert all errors to exception by throwing an
     * ErrorException.
     *
     * @return void
     */
    public static function errorHandler($severity, $message, $file, $line)
    {
        if(!error_reporting() && $severity) {
            return;
        }
        throw new ErrorException($message, 0, $file, $line);
    }

    public static function exceptionHandler($exception)
    {
        $code = $exception->getCode();
        if($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        $error = true;
        if($error) {
            echo "<div style='font-size: 18px'>";
            echo "<h1 style='color: red'>Fatal Error</h1>";
            echo "<p>Uncaught exception: " . get_class($exception) . "</p>";
            echo "<p>Message: " . $exception->getMessage() . "</p>";
            echo "<p style='color: tomato; font-size: 22px;'>Stack Trace: ". $exception->getTraceAsString() . "</p>";
            echo "<p>Thrown In " . $exception->getFile() . " on line" . $exception->getLine() . "</p>";
            echo "</div>";
        } else {
            $errorLog = LOG_DIR . "/" . date("y-m-d H:is") . ".txt";
            ini_set('error_log', $errorLog);
            $message = "Uncaught exception: " . get_class($exception);
            $message .= "with message " . $exception->getMessage();
            $message .= "\n Stack Trace: " . $exception->getTraceAsString();
            $message .= "\n Thrown in " . $exception->getFile() . " on line " . $exception->getLine();

            error_log($message);
            echo (new BaseView)->getTemplate("error/{$code}.html.twig", ["error_message" => $message]);
        }
    }

}