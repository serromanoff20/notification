<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Helper
{
    public static function fromCollectionInArray(Collection $collection): array
    {


        return (array)$collection;
    }
}
