<?php

namespace App\Exceptions;

use Exception;

class UndefinedException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {

    }

    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function render()
    {
//        \Log::debug('User not found');
    }
}
