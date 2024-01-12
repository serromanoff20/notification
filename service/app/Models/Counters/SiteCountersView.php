<?php

namespace App\Models\Counters;

use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SiteCountersView
 *
 * Класс ИПУ. Представление [OnlineGKH].[sn].[SiteCountersView].
 * @package app\models\counters
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 * @property int $id
 * @property string $code
 * @property string $counterName
 * @property float $counterValue
 * @property string $counterDate
 * @property int $OrgId
 * @property string $number
 * @property string $serialNumber
 * @property string $dateVerification
 * @property int $counterTypeId
 * @property string $longCounterTypeName
 * @property string $shortCounterTypeName
 * @property int $objectAccountId
 * @property int $adrId
 * @property int $objectId
 * @property string $objectName
 * @property float $counterLimitValue
 * @property string $measure
 * @property string $address
 * @property string $orgName
 * @property string $kontragentName
 * @property int $isVerification
 * @property int $onModeration
 * @property int $status
 * @property string $statusName
 * @property string $created
 */
class SiteCountersView extends Model
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    /**
     * SiteCountersView constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $fullNameClass = get_called_class();
        $this->table = $this->setSchemeName(class_basename($fullNameClass));
    }

    /**
     * ИПУ абонента.
     * Тестовая функция, в продакшене она не должна работать.
     *
     * @param int $abonentId
     * @return Collection|null
     */
    public static function getAllByAbonentId(int $abonentId): ?Collection
    {
        return self::where('abonentId', $abonentId)->get();
    }

//USED in CountersMediator++
//    public static function getAllByAbonentIdType(int $abonentId, int $typeId): array
//    {
//        return self::where('abonentId', $abonentId)->where('counterTypeId', $typeId)->get();
//    }
//USED in CountersMediator--

//USED in CountersMediator++
//    public static function getLikeCountersByAbonentId(
//      int $abonentId,
//      float $minIndication,
//      float $maxIndication
//    ): array
//    {
//        return self::where('abonentId', $abonentId)
//            ->where('counterValue', '>=', $minIndication)
//            ->where('counterValue', '<=', $maxIndication)
//            ->orderBy('counterValue')
//            ->get();
//    }
//USED in CountersMediator--

//USED in CountersMediator++
//    public static function getLikeCountersByTypeByAbonentId(
//        int $abonentId,
//        int $typeId,
//        float $minIndication,
//        float $maxIndication
//    ): array {
//        return self::where('abonentId', $abonentId)
//            ->where('counterTypeId', $typeId)
//            ->where('counterValue', '>=', $minIndication)
//            ->where('counterValue', '<=', $maxIndication)
//            ->orderBy('counterValue')
//            ->get();
//    }
//USED in CountersMediator--


    public static function getAllByNumberOrgId(string $number, int $orgId): ?Collection
    {
        return self::where('number', $number)->where('orgId', $orgId)->get();
    }

    public static function getAllByNumberOrgIdAbonentId(string $number, int $orgId, int $abonentId): ?Collection
    {
        return self::where('number', $number)->where('orgId', $orgId)->where('abonentId', $abonentId)->get();
    }

// USED in CountersMediator++
//    public static function getById(int $id): ?Model
//    {
//        return self::find($id);
//    }
// USED in CountersMediator--
}
