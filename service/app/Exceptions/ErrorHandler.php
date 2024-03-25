<?php namespace App\Exceptions;

class ErrorHandler
{
    public string $place;
    public string $message;

    /**
     * ErrorHandler constructor.
     * @param string $place
     * @param string $message
     */
    public function __construct(string $place, string $message)
    {
        $this->place = $place;
        $this->message = $message;
    }
}
