<?php
declare(strict_types=1);

namespace App\Helpers;

class DateRelatedHelpers
{
    /**
     * Generates a list of month names
     * @param int $firstMonth
     * @param int $lastMonth
     * @param string $format
     * @return array
     */
    public static function getMonthList($firstMonth = 1, $lastMonth = 12, $format = 'F'): array
    {
        $monthList = [];
        for ($i = $firstMonth; $i <= $lastMonth; $i++) {
            $month = date($format, mktime(0, 0, 0, $i, 1));
            $monthList[$i] = $month;
        }

        return $monthList;
    }

    /**
     * Generates a list of years
     * @param int $firstYear
     * @param int $lastYear
     * @param string $format
     * @return array
     */
    public static function getYearsList($firstYear = 0, $lastYear = 0, $format = 'Y'): array
    {
        if ((checkdate(1, 1, $firstYear) === false ||
                checkdate(1, 1, $lastYear) === false) &&
            $lastYear <= $firstYear) {
            return [date($format)];
        } else {
            return range($firstYear, $lastYear);
        }
    }

    public static function getDuration($startTime, $endTime): int
    {
        $startTime = new \DateTime($startTime);
        $endTime = new \DateTime($endTime);
        $duration = $endTime->diff($startTime);
        return strtotime($duration->format("%h:%i"));
    }

}