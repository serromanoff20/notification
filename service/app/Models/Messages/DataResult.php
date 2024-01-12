<?php

namespace App\Models\Messages;


class DataResult
{
    public string $type_data;

    public array $data;

    public function defineResult(mixed $data)
    {
        $this->type_data = gettype($data);
        $this->data = array($data);
    }
}
