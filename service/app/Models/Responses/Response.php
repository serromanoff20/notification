<?php

declare(strict_types=1);

namespace App\Models\Responses;

use Exception;

/**
 * Class Response
 *
 * Класс, отвечающий за систему сообщений в методах контроллеров
 * @package App\Models\Core
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "ТехноКорп"
 * @property DataResult $response
 * @property int $code
// * @property string $type
 */

class Response
{
    /**
     * Ответ, который включает в себя необходимый набор свойств
     *
     * @var DataResult
     */
    public DataResult $response;

//    /**
//     * Тип сообщения
//     *
//     * @var string
//     */
//    public string $type;

    /**
     * HTTP-код вывода страницы
     *
     * @var int
     */
    public int $code;

    /**
     * Тип ответа - "ошибка"
     */
    private const ERROR_TYPE = "error";

    /**
     * Тип ответа - "исключение"
     * Исключения, как могут содержать результирующий набор данных(с предупреждением),
     * так и могут содержать информацию об ошибке
     */
    private const EXCEPTION_TYPE = "exception";

    /**
     * Тип ответа - "успешно"
     */
    private const SUCCESS_TYPE = "success";

    /**
     * Сообщение об успешном выполнении
     *
     * @param mixed $data
     * @param int $code
     * @return string
     */
    public function getSuccess(mixed $data, int $code = 200): string
    {
        try {
            $this->response = new DataResult((array)$data, self::SUCCESS_TYPE);

            $this->code = $code;
//            $this->type = self::SUCCESS_TYPE;

//пока не понятно как это работает++
//            if (!$is_json) {
//                return json_encode($this, JSON_THROW_ON_ERROR);
//            }
//пока не понятно как это работает--

            return json_encode($this, JSON_UNESCAPED_UNICODE);
        } catch (Exception $exception){

            return $this->getExceptionError($exception, 203);
        }
    }

    /**
     * Получение массива сообщений об ошибках из ошибок модели
     *
     * @param array $errors
     * @param int $code
     * @return string
     */
    public function getModelErrors(array $errors, int $code = 500): string
    {
        try {
            $arrOut = [];

            if (count($errors) === 0) {
                return json_encode([], JSON_UNESCAPED_UNICODE);
            }

            foreach ($errors as $error_arr) {
                $error_arr = (gettype($error_arr) === 'array') ? $error_arr : array($error_arr);

                $arrOut = array_merge($arrOut, $error_arr);
                $this->getError($arrOut, $code);
            }

            $is_json = json_encode($this, JSON_UNESCAPED_UNICODE);

            if (!$is_json) {
                return json_encode($this, JSON_THROW_ON_ERROR);
            }

            return $is_json;
        } catch (Exception $exception) {
            return $this->getExceptionError($exception, $code);
        }
    }

    /**
     * Сообщение об ошибке
     * @param array $error
     * @param int $code
     *
     * @return void
     */
    protected function getError(array $error, int $code): void
    {
        $key_error = array_key_first($error);
        if (gettype($key_error) === 'string') {
            $this->response->message = $error[$key_error][0] . " - " . $key_error;
        } else {
            $this->response->data = $error;
        }
        $this->code = $code;
//        $this->type = self::ERROR_TYPE;
    }

    /**
     * Обработка исключений(Exception)
     * @param Exception $exception
     * @param int $code
     *
     * @return string
     */
    public function getExceptionError(Exception $exception, int $code = 500): string
    {
        $this->response = new DataResult($exception->getTrace(), $exception->getMessage(), true);

        $this->code = $code;
//        $this->type = self::EXCEPTION_TYPE;

        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}
