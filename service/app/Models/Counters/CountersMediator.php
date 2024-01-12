<?php

namespace App\Models\Counters;

use Illuminate\Database\Eloquent\Model;

class CountersMediator extends Model
{
//while not understand how used++
//    /**
//     * Инстанс класса адаптера
//     * @var CountersAdapterInterface|null
//     */
//    private ?CountersAdapterInterface $provider;
//while not understand how used--

    /**
     * Поиск счетчиков абонента
     * @param int $abonentId
     * @param float|null $minIndication
     * @param float|null $maxIndication
     * @return array
     */
    public function getAllByAbonentIdAndindication(
        int $abonentId,
        ?float $minIndication = null,
        ?float $maxIndication = null
    ): array {
        $accounts = SiteObjectAccountsByAbonentsView::getAllValidByAbonentId($abonentId);
        $allExternalCounters = [];

        foreach ($accounts as $account) {
            if (in_array($account->base, [Orgs::BASE_PAY_PROVIDER, Orgs::BASE_EHYBRID_PROVIDER])) {
                $externalCounters = (new CountersMediator())
                    ->findAllByNumberOrgIdAbonentId($account->number, $account->orgId, $abonentId);
                if ($externalCounters) {
                    foreach ($externalCounters as $externalCounter) {
                        if (
                            isset($minIndication) && isset($maxIndication) &&
                            (($externalCounter->counterValue < $minIndication) ||
                                ($externalCounter->counterValue > $maxIndication))
                        ) {
                            continue;
                        } else {
                            $allExternalCounters[] = $externalCounter;
                        }
                    }
                }
            }
        }

        $internalCounters = (empty($minIndication) || empty($maxIndication)) ?
            SiteCountersViewDecorator::getAllByAbonentId($abonentId)
            : SiteCountersViewDecorator::getLikeCountersByAbonentId($abonentId, $minIndication, $maxIndication);

        return array_merge($internalCounters, $allExternalCounters);
    }

}
