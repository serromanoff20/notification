<?php

namespace App\Http\Controllers;

use App\Models\Messages\Message;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;

class MainController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Endpoint testing
     *
     * @return Response
     */
    public function test(): string
    {
        $messages = new Message();

        try{
            $char = 'c';
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
