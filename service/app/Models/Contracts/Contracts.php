<?php

namespace App\Models\Contracts;

use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    /**
     * Allow to create new rows in table
     *
     * @var array
     */
    protected array $fillable = [
        'contractType',
        'contractName',
        'valid',
        'organizationId',
        'code',
        'base1c',
        'inn',
        'kpp',
        'rs',
        'bik',
        'st',
        'bankName',
        'bankId',
        'address',
        'phone',
        'counterTypeId',
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

}
