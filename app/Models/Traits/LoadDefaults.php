<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;

trait LoadDefaults
{
    public static function getTableName()
    {
        return (new static)->getTable();
    }
    /**
     * Returns the columns with the schema information of the DB table associated with this class.
     * @return array Doctrine\DBAL\Schema\Column
     */
    public static function getTableSchema(){
        $columns = DB::connection()
            ->getDoctrineSchemaManager()
            ->listTableColumns(static::getTableName());
        return $columns;

    }

    /**
     * Loads default values from database table schema.
     *
     * You may call this method to load default values after creating a new instance:
     *
     * ```php
     * // class Customer extends Illuminate\Database\Eloquent\Model
     * $customer = new Customer();
     * $customer->loadDefaultValues();
     * ```
     *
     * @param bool $skipIfSet whether existing value should be preserved.
     * This will only set defaults for attributes that are `null`.
     * @return $this the model instance itself.
     */
    public function loadDefaultValues($skipIfSet = true)
    {
        foreach (static::getTableSchema() as $column) {
            if ($column->getDefault() !== null && (!$skipIfSet || $this->{$column->getName()} === null)) {
                $this->{$column->getName()} = $column->getDefault();
            }
        }
        return $this;
    }
}
