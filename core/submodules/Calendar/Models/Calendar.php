<?php

namespace Calendar\Models;

use Calendar\Support\Accessors\CalendarAccessor;
use Calendar\Support\Holidays\HolidaysTrait;
use Pluma\Models\Model;

class Calendar extends Model
{
    use CalendarAccessor,
        HolidaysTrait;

    /**
     * Toggle timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Perform a join on parameters.
     *
     * @param string $table
     * @param array $params
     * @param string $startDate
     * @param string $endDate
     * @return \Pluma\Models\Model
     */
    public static function build(string $table, array $params, string $startDate, string $endDate)
    {
        $joinTable = with(new self)->getTable();

        return self::leftJoin($table, function ($join) use ($params, $table, $joinTable) {
                $join->on("$joinTable.date", '=', "$table.date");
                $join->where($params);
            })
            ->select(['*', "$joinTable.date AS date"])
            ->whereBetween("$joinTable.date", [$startDate, $endDate])
            ->orderBy("$joinTable.date");
    }
}
