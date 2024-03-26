<?php namespace App\Models\Notifications\Push;

use App\Consts;
use App\Models\ModelApp;
use Illuminate\Support\Facades\Http;

class FirebaseAPI extends ModelApp
{
    /**
     * URL-address of Expo-server
     */
    private const SEND_URL = "https://fcm.googleapis.com/fcm/send";

    /**
     * Generated via firebase console. This key must be given frontend
     */
    public const VAPIDKEY = "BFNcEvhay0biTh325tNGaIHDyL0qquEjQ3cFc3qqq5X-RTn9dzoUqg5JJhxg1Y1VUzkP9KIUjGXh3jlivfObO30";

    /**
     * Token by which sends message
     * @var string
     */
    private string $token;

    /**
     * Title of message
     * @var string
     */
    private string $title_message;

    /**
     * Body of message
     * @var string
     */
    private string $body_message;

    /**
     * Model that returned. May self include empty array or data that returned by FirebaseAPI.
     * @var mixed
     */
    public mixed $returnedModel = [];

    /**
     * FirebaseAPI constructor
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
            $this->setBodyModel($this);
        }
    }

    /**
     * Common function of call which defined what it is from push-notification of function
     * todo надо будет дописать условие получения массива токенов!!!
     *
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
     * Function than call one push-notification.
     * @return array
     */
    public function callOnePush(): array
    {
        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'key=' . Consts::SERVER_KEY
        );

        $body_request = array(
            "to" => $this->token,
            "notification" => [
                "title" => $this->title_message,
                "body" => $this->body_message,
                "icon" => Consts::FAVICON_OGKH,
                "click_action" => "https://xn--80amifbldd4e.xn--p1ai/"
            ]
        );

        $response = Http::withHeaders($headers)->post(self::SEND_URL, $body_request);

        return $this->checkResponse($response->body());
    }

    protected function checkResponse(string $responseBody): array
    {
        $this->returnedModel = json_decode($responseBody);
//d5ig-bkTu985u0cM8f48DR:APA91bEfZo0wztnz48nXucvZtq6PlcgV6BYGlZ7t-ujLrtdPuOtRskxd1ItLB2sX48NEcjH5P8SKzIhCFHltbYG3WH1ijYIy-qT35M6weNxxo1FyhKzRNq6jB6kuVQz9zXWlAVg-HQhC --- wrong token
//f3d5M6XpR8ZlgGltC21tuj:APA91bG2tOfw_rg4Qu4D7sK_5kEqtf4YqXOleVKXFfuZ5H-ikt7FODv7Jek3A5vWHrBSX0uRsB1sK435PfEI1Ht37GwbGq06l4Tt53Wht1v_JZiAFfhTJLANo5DHKiwVxW3BRXqSiM-T --- correct token
        if (
            isset($this->returnedModel->success)
            && $this->returnedModel->success === 1
        ){
            return (array)$this->returnedModel;
        } else {
            $this->setError(get_called_class(), 'Уведомление не отправилось или неверно обработаны возвращаемые данные');

            return [];
        }
    }

//stage development ++
//    public function call()//: bool
//    {
//        $this->setScenario(self::SCENARIO_CREATE);
//
//        $result = $this->callPush($this->tokens, $this->title_message, $this->body_message);
//        if (gettype($result) === 'boolean') {
//            return true;
//        }
//        return false;
//    }
//stage development --
}
