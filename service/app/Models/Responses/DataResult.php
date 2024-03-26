<?php namespace App\Models\Responses;

use App\Consts;
use App\Exceptions\ErrorHandler;
use JetBrains\PhpStorm\Pure;

/**
 * Class DataResult
 *
 * Resulting set data which may self include success response, ErrorHandler and ExceptionHandler
 * @package App\Models\Core
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "ТехноКорп"
 * @property array $errors
 * @property array $data
 */
class DataResult
{
    /**
     * Categories of resulting set data
     * @var string
     */
    public string $type;

    /**
     * Model that is initialized in the controller and
     * returned as the final result when an action is called
     * @var array
     */
    public array $model;

    /**
     * List messages about errors that may be called in model
     * @var array
     */
    public array $errors;

    /**
     * DataResult constructor.
     * @param array $model
     * @param array $messages
     */
    public function __construct(array $model, array $messages=[])
    {
        $this->model = $model;

        if (empty($messages)){
            $this->errors[0] = new ErrorHandler("", "");
        } else {
            $this->errors = $messages;
        }
    }
}
