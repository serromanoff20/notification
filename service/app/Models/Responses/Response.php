<?php

declare(strict_types=1);

namespace App\Models\Responses;

use App\Consts;
use App\Exceptions\ExceptionHandler;
use App\Models\ModelApp;
use App\Models\Responses\DataResult;
use Exception;
use Illuminate\Support\Collection;

/**
 * Class Response
 *
 * Класс, отвечающий за систему сообщений в методах контроллеров
 * @package App\Models\Core
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "ТехноКорп"
 * @property array $response
 * @property int $code
 */

class Response
{
    /**
     * Resulting set data from model
     *
//     * @var DataResult
     * @var array
     */
    public DataResult $result;
//    public array $response;

    public string $typeResponse;

    /**
     * inner HTTP-code of application
     *
     * @var int
     */
    public int $code;

    /**
     * Processing a successful data set
     * @param mixed $data
     * @return string
     */
    public function getSuccess(mixed $data): string
    {
        header('Content-type: application/json');

        try {
            if ($data instanceof Collection) {
                $this->response = new DataResult($data->all());
            } else if (gettype($data) === 'array') {
                $this->response = new DataResult($data);
            } else {
                $this->response = new DataResult((array)$data);
            }
            $this->code = Consts::SUCCESS_CODE;

            return json_encode($this, JSON_UNESCAPED_UNICODE);
        } catch (Exception $exception){
            $this->code = Consts::WARNING_CODE;

            return $this->getExceptionError($exception);
        }
    }

    /**
     * Получение массива сообщений об ошибках из ошибок модели
     * @param mixed $data
     * @param array $messages
     * @return string
     */
    public function getModelErrors(mixed $data, array $messages=[]): string
    {
        header('Content-type: application/json');

        try {
            $this->code = !isset($this->code) ? Consts::ERROR_CODE : $this->code;

            $this->getError($data, $messages);

            $is_json = json_encode($this, JSON_UNESCAPED_UNICODE);

            if (!$is_json) {
                return json_encode($this, JSON_THROW_ON_ERROR);
            }
            return $is_json;
        } catch (Exception $exception) {
            return $this->getExceptionError($exception);
        }
    }

    /**
     * Сообщение об ошибке
     * @param mixed $data
     * @param array $messages
     * @return void
     */
    private function getError(mixed $data, array $messages=[]): void
    {
        if (empty($messages)) {
            $message = new ModelApp();
            $message->setError(Consts::ERROR_TYPE, "Ошибка запроса");
            $messages = $message->getErrors();
        }
        $this->response = new DataResult([$data], $messages);
    }


    /**
     * Обработка исключений(Exception)
     * @param Exception $exception
     * @param int $code
     * @return string
     */
    public function getExceptionError(Exception $exception, int $code = 0): string
    {
        header('Content-type: application/json');

        $messages = new ModelApp();

        $messages->setError(Consts::EXCEPTION_TYPE, $exception->getMessage());

        $this->response = new DataResult($exception->getTrace(), $messages->getErrors());
        $this->code = ($code === 0) ? Consts::EXCEPTION_CODE : $code;

        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}
