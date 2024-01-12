<?php

declare(strict_types=1);

namespace App\Models\Messages;

use Exception;
//use JsonException;

/**
 * Class Messages
 *
 * Класс, отвечающий за систему сообщений в методах контроллеров
 * @package App\Models\Core
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "ТехноКорп"
 * @property string $text
 * @property string $type
 */

class Message
{
    /**
     * Текст сообщения
     *
     * @var DataResult
     */
    public DataResult $data;

    /**
     * Тип сообщения
     *
     * @var string
     */
    public string $type;

    /**
     * HTTP-код вывода страницы
     *
     * @var int
     */
    public int $code;

    /**
     * Тип сообщения - "ошибка"
     */
    private const ERROR_TYPE = "error";


    /**
     * Тип сообщения - "исключение".
     * Исключения, как могут содержать результирующий набор данных(с предупреждением),
     * так и могут содержать информацию об ошибке
     */
    private const EXCEPTION_TYPE = "exception";

    /**
     * Тип сообщения - "успешно"
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
            $this->data->defineResult($data);
            $this->code = $code;
            $this->type = self::SUCCESS_TYPE;

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
     *
     * @param array $error
     * @param int $code
     *
     * @return void
     */
    protected function getError(array $error, int $code): void
    {
        $key_error = array_key_first($error);
        if (gettype($key_error) === 'string') {
            $this->data["message"] = $error[$key_error][0] . " - " . $key_error;
        } else {
            $this->data["message"] = $error;
        }
        $this->code = $code;
        $this->type = self::ERROR_TYPE;
    }

    /**
     * Обработка исключений(Exception)
     *
     * @param Exception $exception
     * @param int $code
     * @return string
     */
    public function getExceptionError(Exception $exception, int $code = 500): string
    {


//        $this->data = [
//            'is_exception' => true,
//            'message' => $e->getMessage(),
//        ];
        $this->code = $code;
        $this->type = self::EXCEPTION_TYPE;

        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}
