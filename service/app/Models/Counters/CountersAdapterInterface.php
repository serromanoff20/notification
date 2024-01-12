<?php

declare(strict_types=1);

namespace App\Models\Counters;

/**
 * interface CountersAdapterInterface
 *
 * Интерфейс для адаптированного вывода информации о счетчиках.
 * @package app\models\counters
 * @author Сергей Романов
 * @copyright Copyright (c) ООО "Платеж Центр"
 */
interface CountersAdapterInterface
{
    /**
     * Получение массива счетчиков абонента (внешних)
     * @return array|null
     */
    public function getAbonentCounters(): ?array;

    /**
     * Получение массива счетчиков по лицевому счету
     *
     * @return array|null
     */
    public function getCounters(): ?array;

    /**
     * Проверка наличия счетчиков
     *
     * @return bool
     */
    public function hasCounters(): bool;

    /**
     * Получение счетчика по id
     *
     * @return CountersAdapterInterface|null
     */
    public function getCounterById(): ?CountersAdapterInterface;
}
