<?php

namespace App\Traits;

trait MigrationTableSchemaTrait
{
    /**
     * @param string $nameTable
     * @return string
     */
    public function setScheme(string $nameTable): string
    {
        return env('DB_SCHEMA') . "." . $nameTable;
    }

    /**
     * @return bool
     */
    public function isDevEnv(): bool
    {
        return (env('DB_SCHEMA') === 'dev') ;
    }
}
