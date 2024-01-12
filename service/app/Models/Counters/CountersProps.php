<?php

namespace App\Models\Counters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CountersProps
 *
 * Класс таблицы ИПУ. Таблица  [ServiceIPU].[sn].[CountersProps].
 * @package App\Models\Counters
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 * @property int $id
 * @property int $counterId
 * @property string $serialNumber
 * @property string $dateVerification
 * @property integer $isVerification
 * @property string $through
 * @property integer $onModeration
 */
class CountersProps extends Model
{
    use HasFactory;
}
