<?php

namespace App\Models\Counters;

/**
 * Class SiteCountersViewAdapter
 *
 * Класс-адаптер ИПУ.
 * Адаптирует данные по счётчикам для клиентских прилдожений.
 *
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 * @package app\models\counters
 */
final class SiteCountersViewAdapter extends SiteCountersViewDecorator
{
    /**
     * Массив аккаунтов со счетчиками
     *
     * @var array
     */
    public array $accounts = [];

    /**
     * Дополненный и адаптированный список ИПУ по идентификатору абонента
     *
     * @param int $abonentId
     * @param float|null $minIndication
     * @param float|null $maxIndication
     * @return array
     */
    public function findByAbonentIdAdapted(
        int $abonentId,
        ?float $minIndication = null,
        ?float $maxIndication = null
    ): array {
        $counters = (new CountersMediator())
            ->getAllByAbonentIdAndindication($abonentId, $minIndication, $maxIndication);

        return $this->getAllCompletedAdapted($counters);
    }
}
