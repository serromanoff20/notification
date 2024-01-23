<?php

namespace App\Http\Controllers;

use App\Models\Responses\Response;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
//use Illuminate\Http\Response;

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
        $resModel = new Response();

        try{
            $char = 'c';
            $test = [
                'number' => 1,
                'string' => 'test',
                'char' => $char,
                'gettype_char' => gettype($char),
            ];

            return $resModel->getSuccess(['check' => $test]);
        }catch (Exception $exception) {
            return $resModel->getExceptionError($exception);
        }

    }
}
