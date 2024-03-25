<?php namespace App\Models\Push;

use App\Consts;
use App\Models\ModelApp;
use App\Models\LogRequest;
use Illuminate\Support\Facades\Http;
use stdClass;

/**
 * Class ExpoAPI
 *
 * for push-notifications in mobile version-app
 * @package app\models\push
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 *
 */
class ExpoAPI extends ModelApp
{
    /**
     * URL-address of Expo-server
     */
    private const SEND_URL = "https://exp.host/--/api/v2/push/send";

    private string $token;
    private string $title_message;
    private string $body_message;

    public mixed $returnedModel = [];

    /**
     * ExpoAPI constructor
     * @param array $params
     */
    public function __construct(array $params)
    {
        parent::__construct();

        if (
            isset($params['tokens'])
            && isset($params['title'])
            && isset($params['message'])
        ) {
            $this->token = $params['tokens'];
            $this->title_message = $params['title'];
            $this->body_message = $params['message'];
        } else {
            $this->setError(get_called_class(), 'Неверно переданы параметры');
            $this->setEmptyModel($this->returnedModel);
        }
    }

    /**
     * Common function of call which defined what it is from push-notification of function
     * todo надо будет дописать условие получения массива токенов!!!
     * @return array
     */
    public function callPush(): array
    {
        $content = [];
        if (gettype($this->token) === 'string') {
            $content = $this->callOnePush();
        } elseif (gettype($this->token) === 'array') {
//          $content = $model->callArrayPush();
        }

        return $content;
    }

    /**
     * @return array
     */
    public function callOnePush(): array
    {
        $headers = array(
            'host' => 'exp.host',
            'Content-Type' => 'application/json',
            'cache-control' => 'no-cache',
            'Accept-Encoding' => 'gzip, deflate'
        );

        $body_request = array(
            'to' => $this->token,
            'title' => $this->title_message,
            'body' => $this->body_message,
            'icon' => "https://xn--80amifbldd4e.xn--p1ai/icon.png"
        );

        $response = Http::withHeaders($headers)->post(self::SEND_URL, $body_request);

        return $this->checkResponse($response->body());
    }

    protected function checkResponse(string $responseBody): array
    {
        $this->returnedModel = json_decode($responseBody);

        if (
            isset($this->returnedModel->data)
            && isset($this->returnedModel->data->id)
            && isset($this->returnedModel->data->status)
            && $this->returnedModel->data->status = 'ok'
        ){
            return (array)$this->returnedModel->data;
        } else {
            $this->setError(get_called_class(), 'Уведомление не отправилось или неверно обработаны возвращаемые данные');

            return [];
        }
    }
//on stage development ++
//    /**
//     * @param array $tokens
//     * @param string $title_message
//     * @param string $body_message
//     * @return array|string
//     * @throws Exception
//     * @throws InvalidConfigException
//     */
//    private function callArrayOfPushs(array $tokens, string $title_message, string $body_message)//: array|string
//    {
//        $payload1 = array(
//            'to' => [
//                'ExponentPushToken[wpM9_CMUV_2e0dPhgjgO6V]',
//                'ExponentPushToken[j9T7j2JQmPekHvIoOSEVGa]',
//                'ExponentPushToken[oe0TAyEVntnD-s0_pnb4dc]'
//            ],
//            //'title' => "Breaking news!",//$title_message,
//            'body' => "Breaking news!"
//        );
//
//        $client = new Client();
//        $response = $client->createRequest()
//            ->setUrl(self::SEND_URL)
//            ->setMethod('POST')
//            ->setFormat(Client::FORMAT_JSON)
//            ->addHeaders(['Content-Type' => 'application/json'])
//            ->addHeaders(['Accept-Encoding' => 'gzip, deflate'])
//            ->addHeaders(['cache-control' => 'no-cache'])
//            ->addHeaders(['host' => 'exp.host'])
//            ->addHeaders(['Accept' => 'application/json'])
//            ->setData($payload1)
//            ->send();
//
//        $httpcode = $response->getHeaders()->get('http-code');
//        if ($response->isOk && $httpcode == 200) {
//            return $response->data;
//        } else {
//            return ['code' => $httpcode, 'response' => $response, 'params' => $payload1];
//        }
//    }
//on stage development --
}
