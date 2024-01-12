<?php

namespace App\Models\Counters;

use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Counters
 *
 * Класс таблицы ИПУ. Таблица [ServiceIPU].[sn].[Counters].
 * @package app\models\counters
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 * @property int $id
 * @property string $accountNumber
 * @property string $adrId
 * @property string $idCode
 * @property string $counterName
 * @property float $counterVal
 * @property string $counterValDate
 * @property int $created_at
 * @property int $updated_at
 */
class Counters extends Model
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    /**
     * Allow to create new rows in table Counters
     *
     * @var array
     */
    protected array $fillable = [
        'accountNumber',
        'adrId',
        'idCode',
        'counterName',
        'counterVal',
        'counterValDate',
    ];

    /**
     * Unset props created_at and update_at creating new row
     *
     * @var bool
     */
    public bool $timestamps = false;

    /**
     * Counters constructor
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $fullNameClass = get_called_class();
        $this->table = $this->setSchemeName(class_basename($fullNameClass));
    }

    /**
     * Отображение счётчиков по его имени в БД
     *
     * @param string $number
     * @return Collection
     */
    public function findByNumber(string $number): Collection
    {
        return self::where('number', $number)->get();
    }

    /**
     * Отображение всех счётчиков по 10 штук.
     * Выполняется долго.
     *
     * @return Collection
     */
    public function showCounters()//: Collection
    {
        return self::select('id')->whereNotNull('id')->limit(10)->get();
    }
}
