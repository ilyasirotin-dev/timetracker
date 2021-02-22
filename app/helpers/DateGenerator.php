<?php
declare(strict_types=1);

namespace App\Helpers;

use http\Params;

class DateGenerator
{
    /**
     * @param int $month
     * @param $year
     * @param string $step
     * @return array
     * @throws \Exception
     *
     * Generates a list of dates for given month and year in 'Y-m-d' format
     */
    public static function getDatesList($month, $year, $step = 'P1D'): array
    {
        $datesList = [];
        $dateString = $year.'-'.$month;
        $lastDayOfMonth = date('t', strtotime($dateString));

        $firstDateOfMonth = new \DateTime($dateString.'-1');
        $step = new \DateInterval($step);
        $period = new \DatePeriod($firstDateOfMonth, $step, $lastDayOfMonth - 1);

        foreach ($period as $date) {
            $datesList[] = $date->format('d-M-y');
        }

        return $datesList;
    }

    /**
     * @param int $selected
     * @param int $first
     * @param int $last
     * @return array
     *
     * Generates a month names list which can be useful in <select> html tag
     */
    public static function getMonthNamesList($selected = 1, $firstMonth = 1, $lastMonth = 12)
    {
        $monthList = [];
        for($i = $firstMonth; $i <= $lastMonth; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $monthList[$i] = [
                'name' => $month,
                'selected' => $i == $selected ? 'selected' : '',
            ];
        }

        return $monthList;
    }

    /**
     * @param $selected
     * @param $firstDate
     * @param $lastDate
     * @return array
     *
     * Generates a years list which can be useful in <select> html tag
     */
    public static function getYearsList($selected, $firstDate, $lastDate): array
    {
        if($firstDate === null || $lastDate === null) {
            return [
                'year' => date('Y'),
                'selected' => 'selected',
            ];
        }
        else {
            $firstYear = date('Y', (int)$firstDate);
            $lastYear = date('Y', (int)$lastDate);

            for ($i = $firstYear; $i <= $lastYear; $i++) {
                $yearsList[] = [
                    'year' => $i,
                    'selected' => $i == $selected ? 'selected' : '',
                ];
            }

            return $yearsList;
        }
    }

}