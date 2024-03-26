<?php namespace App\Http\Controllers;

use App\Consts;
use App\Models\LogRequest;
use App\Models\Notifications\Notification;
use App\Models\Notifications\Push\ExpoAPI;
use App\Models\Notifications\Push\FirebaseAPI;
use App\Models\Responses\Response;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
//use App\Types;

class MainController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Endpoint check push-notification throw expo-api
     * @param LogRequest $request
     * @return string
     */
    public function callMobilePush(LogRequest $request): string
    {
        $response = new Response();

        try {
            $params = $request->getBodyParams();

            $model = new ExpoAPI($params);

            if ($model->hasErrors()) {
                $response->code = Consts::ERROR_CLIENT_CODE;

                return $response->getModelErrors($model->getBodyModel(), $model->getErrors());
            }

            $content = $model->callPush();

            if ($model->hasErrors() || empty($content)) {
                return $response->getModelErrors($model->getBodyModel(), $model->getErrors());
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
    public function callWebPush(LogRequest $request): string
    {
        $response = new Response();

        try {
            $params = $request->getBodyParams();

            $model = new FirebaseAPI($params);

            if ($model->hasErrors()) {
                $response->code = Consts::ERROR_CLIENT_CODE;

                return $response->getModelErrors($model->getBodyModel(), $model->getErrors());
            }

            $content = $model->callPush();

            if ($model->hasErrors() || empty($content)) {
                return $response->getModelErrors($model->getBodyModel(), $model->getErrors());
            }

            return $response->getSuccess($content);
        } catch(Exception $exception) {
            return $response->getExceptionError($exception);
        }
    }

    /**
     * Endpoint for mass to calls push notifications
     * @param LogRequest $request
     * @return string
     */
    public function callMassPush(LogRequest $request): string
    {
        $response = new Response();

        try {
            $params = $request->getQueryParams();

            $model = new Notification($params);

            if ($model->hasErrors()) {
                $response->code = Consts::ERROR_CLIENT_CODE;

                return $response->getModelErrors($model->getBodyModel(), $model->getErrors());
            }

            return $response->getSuccess($model->getBodyModel());
        } catch (Exception $exception) {
            return $response->getExceptionError($exception);
        }
    }
}
