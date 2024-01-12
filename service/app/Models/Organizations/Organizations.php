<?php

namespace App\Models\Organizations;

use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    /**
     * Allow to create new rows in table
     *
     * @var array
     */
    protected array $fillable = [
        'nameOrg',
        'valid',
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
