<?php

namespace App\Models\Responses;

/**
 * Class DataResult
 *
 * Объект, который содержит результирующий набор данных
 * @package App\Models\Core
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "ТехноКорп"

 * @property bool $isException
 * @property array $data
 * @property string $message
 */
class DataResult
{
    public bool $isException = false;

    public array $data;

    public string $message;

    /**
     * DataResult constructor.
     * @param bool $isExc
     * @param array $data
     * @param string $message
     */
    public function __construct(array $data, string $message, bool $isExc=false)
    {
        $this->isException = $isExc;
        $this->data = $data;
        $this->message = $message;
    }
}
