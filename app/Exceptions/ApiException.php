<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $data;
    protected $statusCode;

    public function __construct($data = null, $message = null, $statusCode = 500, $code = 0, Exception $previous = null)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;

        parent::__construct($message, $code, $previous);
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
