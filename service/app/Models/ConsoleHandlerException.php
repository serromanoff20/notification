<?php

namespace App\Models;

use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsoleHandlerException
 *
 * @package app\models
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 * @property int $id
 * @property string $nameProcedure
 * @property string $descriptionException
 * @property string $created_at
 * @property string $updated_at
 */
class ConsoleHandlerException extends Model
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    const NAME_CLASS = "ConsoleHandlerException";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $fullNameClass = get_called_class();
        $this->table = $this->setScheme(class_basename($fullNameClass));
    }
}
