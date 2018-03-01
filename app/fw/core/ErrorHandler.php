<?php


namespace app\fw\core;


class ErrorHandler
{

    public function __construct(){
        if (DEBUG) {
            error_reporting(-1); //E_ALL
        } else {
            error_reporting(0);
        }

        set_error_handler([$this, 'errorHandler']);
        ob_start(); //buffer
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
    }


    public function errorHandler($errno, $errstr, $errfile, $errline) {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
        return true;
    }

    public function fatalErrorHandler() {

        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'],$error['message'],$error['file'],$error['line']);
        } else {
            ob_end_flush();
        }

    }

    public function exceptionHandler(\Exception $e)
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    private function displayError($errno, $errstr, $errfile, $errline, $response = 500) {
        http_response_code($response);
        if ($response == 404 && !DEBUG) {
            require APP . '/views/errors/404.html';
            die();
        }
        if (DEBUG) {
            require APP . '/views/errors/dev.php';
        } else {
            require APP . '/views/errors/prod.php';
        }
        die();
    }

    private function logError($message = '', $file = '', $line = '') {
        error_log("[" . date('Y-m-d H:i:s') .
            "] Error message: {$message} | File: {$file} | Line: {$line}\n-----------------------------\n",
            3, ROOT . '/tmp/errors.log');
    }
}

