<?php namespace App\Http\Controllers;

use App\Consts;
use App\Models\LogRequest;
use App\Models\Push\ExpoAPI;
use App\Models\Push\FirebaseAPI;
use App\Models\Responses\Response;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MainController extends Controller
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

            return $response->getSuccess($request->getBodyParams());
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

    /**
     * Endpoint check push-notification throw expo-api
     * @param LogRequest $request
     * @return string
     */
    public function callExpoPush(LogRequest $request): string
    {
        $response = new Response();

        try {
            $params = $request->getBodyParams();

            $model = new ExpoAPI($params);

            if ($model->hasErrors()) {
                $response->code = Consts::ERROR_CLIENT_CODE;

                return $response->getModelErrors($model->getEmptyModel(), $model->getErrors());
            }

            $content = $model->callPush();

            if ($model->hasErrors() || empty($content)) {
                return $response->getModelErrors($model->getEmptyModel(), $model->getErrors());
            }

            return $response->getSuccess($content);
        } catch(Exception $exception) {
            return $response->getExceptionError($exception);
        }
    }

    /**
     * Endpoint check push-notification throw firebase-api
     * @param LogRequest $request
     * @return string
     */
    public function callFirebasePush(LogRequest $request): string
    {
        $response = new Response();

        try {
            $params = $request->getBodyParams();

            $model = new FirebaseAPI($params);

            if ($model->hasErrors()) {
                $response->code = Consts::ERROR_CLIENT_CODE;

                return $response->getModelErrors($model->getEmptyModel(), $model->getErrors());
            }

            $content = $model->callPush();

            if ($model->hasErrors() || empty($content)) {
                return $response->getModelErrors($model->getEmptyModel(), $model->getErrors());
            }

            return $response->getSuccess($content);
        } catch(Exception $exception) {
            return $response->getExceptionError($exception);
        }
    }
}
