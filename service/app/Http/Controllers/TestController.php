<?php

namespace App\Http\Controllers;

use App\Models\Responses\Response;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TestController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Endpoint for tests
     *
     * @return string
     */
    public function test(): string
    {
        $messages = new Response();

        try{
            $char = '/';
            $test = [
                'number' => 1,
                'string' => 'test',
                'char' => $char,
                'gettype_char' => gettype($char),
            ];

            return $messages->getSuccess(['check' => $test]);
        }catch (Exception $exception) {
            return $messages->getExceptionError($exception);
        }

    }
}
