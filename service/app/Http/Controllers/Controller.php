<?php namespace App\Http\Controllers;

use App\Models\ConsoleHandlerException;
use App\Models\LogRequest;
use App\Models\Responses\Response;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;


    /**
     * Endpoint check get-request
     * @param LogRequest $request
     * @return string
     */
    public function test(LogRequest $request): string
    {
        $response = new Response();

        try {
            $params = $request->getBodyParams();
            $model = new ConsoleHandlerException($params);
//            $model->setCheckError(); //debugging
            $result = $model->all();

            if (!$result) {
                return $response->getModelErrors($model->getBodyModel(), $model->getErrors());
            }

            return $response->getSuccess($result);
        } catch (Exception $exception) {
            return $response->getExceptionError($exception);
        }
    }

    /**
     * Endpoint check post-request
     * @param LogRequest $request
     * @return string
     */
    public function check(LogRequest $request): string
    {
        $response = new Response();

        try {

            return $response->getSuccess($request->getQueryParams());
        } catch (Exception $exception) {
            return $response->getExceptionError($exception);
        }
    }
}
