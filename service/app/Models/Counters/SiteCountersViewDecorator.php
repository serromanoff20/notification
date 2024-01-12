<?php

namespace App\Models\Counters;

/**
 * Class SiteCountersViewDecorator
 *
 * Класс-декоратор ИПУ.
 * Отображает счётчики с показаниями.
 *
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 * @package app\models\counters
 * @property array counters
 */
class SiteCountersViewDecorator extends SiteCountersView
{

    /**
     * SiteCountersView constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Статический массив ИПУ
     *
     * @var array
     */
    protected static array $counters = [];

    /**
     * Массив ИПУ дополненный переопределениями и свойствами
     *
     * @param array $counters
     * @return array
     */
    public function getAllCompleted(array $counters): array
    {
        self::$counters = (is_array($counters) && (count($counters) > 0)) ? $counters : [];
        self::countersTypesRedefinition();

        return self::$counters;
    }

    /**
     * Дополненный массив ИПУ по лицевому и id организации
     *
     * @param string $number
     * @param int $orgId
     * @return array
     */
    public function findByNumberOrgId(string $number, int $orgId): array
    {
        $countersCollection = self::getAllByNumberOrgId($number, $orgId);

        $counters = array();
        foreach ($countersCollection as $item) {
            $counters[] = $item;
        }

        return $this->getAllCompleted($counters);
    }

// USED in CountersMediator++
//    /**
//     * Дополненный массив ИПУ абонента по лицевому и id организации
//     *
//     * @param string $number
//     * @param int $orgId
//     * @param int $abonentId
//     * @return array
//     */
//    public function findByNumberOrgIdAbonentId(string $number, int $orgId, int $abonentId): array
//    {
//        $counters = self::getAllByNumberOrgIdAbonentId($number, $orgId, $abonentId);
//
//        return $this->getAllCompleted($counters);
//    }
// USED in CountersMediator--

//function duplicate (new SiteCountersView)->getById(); USED in CountersMediator++
//    /**
//     * Дополненный массив ИПУ абонента по id счетчика
//     * @param int $id
//     * @return array
//     */
//    public function findById(int $id): array
//    {
//        $counter = self::getById($id);
//        $counters = ($counter) ? [$counter] : [];
//
//        return $this->getAllCompleted($counters);
//    }
//function duplicate (new SiteCountersView)->getById(); USED in CountersMediator--

    /**
     * Форматирование типов значений
     */
    private static function countersTypesRedefinition()
    {
        foreach (self::$counters as $key => $row) {
            $row->counterLimitValue = (float)$row->counterLimitValue;
            $row->counterValue = (float)$row->counterValue;
            $row->isVerification = !!$row->isVerification;
            $row->onModeration = !!$row->onModeration;
            self::$counters[$key] = $row;
        }
    }
}
