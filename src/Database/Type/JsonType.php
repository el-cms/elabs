<?php

namespace App\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

class JsonType extends Type
{

    /**
     * Converts JSON to PHP array
     *
     * @param string $value JSON to convert
     * @param Driver $driver Unused.
     *
     * @return array
     */
    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }

        return json_decode($value, true);
    }

    /**
     * Converts a json string to array, or returns the $value array if one.
     *
     * @param mixed $value The JSON string or an array
     *
     * @return array
     */
    public function marshal($value)
    {
        if (is_array($value) || $value === null) {
            return $value;
        }

        return json_decode($value, true);
    }

    /**
     * Converts a PHP array to JSON
     *
     * @param array $value The array to convert
     * @param Driver $driver Unused
     *
     * @return string
     */
    public function toDatabase($value, Driver $driver)
    {
        return json_encode($value);
    }

    /**
     * Prepares a PDO statement from a JSON string
     *
     * @param string $value The JSON string
     * @param Driver $driver Unused
     *
     * @return PDO statement
     */
    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }

        return PDO::PARAM_STR;
    }
}
