<?php namespace App\Models;

use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ConsoleHandlerException
 *
 * @package app\models
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 * @property int $id
 * @property string $nameProcedure
 * @property string $descriptionException
 * @property string $createdAt
 * @property string $updatedAt
 */
class ConsoleHandlerException extends ModelApp
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    const NAME_CLASS = "ConsoleHandlerException";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $fullNameClass = get_class($this);
        $this->table = $this->setScheme(class_basename($fullNameClass));
    }

    public function setCheckError(): void
    {
        $this->setError(get_called_class(), 'Неверно переданы параметры');
        $this->setBodyModel($this);
    }
}
