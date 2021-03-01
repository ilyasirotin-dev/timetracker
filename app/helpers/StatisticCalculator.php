<?php
declare(strict_types=1);

namespace App\Helpers;

use App\Models\Holidays;
use App\Models\Latecomers;
use App\Models\Users;

class StatisticCalculator
{
    /**
     * @var Users
     */
    public $user;
    /**
     * @var int
     */
    public $month;
    /**
     * @var int
     */
    public $year;

    public function __construct($id = 1, $month = 1, $year = 1)
    {
        $this->user = Users::findFirstById($id);
        $this->setMonth($month);
        $this->setYear($year);
    }

    public function getTotalUserHours(): int
    {
        $startDate = strtotime($this->year . '-' . $this->month . '-1');
        $endDate = strtotime($this->year . '-' . $this->month . '-31');

        $records = $this->user->getTimeTable([
            'conditions' => 'created_at >= :start_date: AND created_at <= :end_date:',
            'bind' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]
        ]);

        $totalHours = 0;
        $totalMinutes = 0;

        foreach ($records as $record) {
            $totalHours += date('H', (int)$record->total);
            $totalMinutes += date('I', (int)$record->total);
        }

        $totalHours += $totalMinutes / 60;

        return $totalHours;
    }

    public function getUserLates(): int
    {
        $lates = Latecomers::count([
            'conditions' => 'user_id = :id: AND created_at = :date:',
            'bind' => [
                'id' => $this->user->id,
                'date' => strtotime($this->year . '-' . $this->month),
            ],
        ]);

        return $lates;
    }

    public function getRequiredHours($workDayLength = 8): int
    {
        $startDate = strtotime($this->year . '-' . $this->month . '-1');
        $endDate = strtotime($this->year . '-' . $this->month . '-31');

        $holidaysCount = Holidays::count([
            'conditions' => 'date >= :start_date: AND date <= :end_date:',
            'bind' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ],
        ]);

        $lastDay = date("t", mktime(0, 0, 0, $this->month, 1, $this->year));
        $workDays = 0;
        for ($i = 29; $i <= $lastDay; $i++) {
            $wd = date("w", mktime(0, 0, 0, $this->month, $i, $this->year));
            if ($wd > 0 && $wd < 6) $workDays++;
        }

        $workDays += 20;

        return ($workDays - $holidaysCount) * $workDayLength;
    }

    public function setMonth($month)
    {
        if (checkdate($month, 1, 1)) {
            $this->month = $month;
        } else {
            $this->month = 1;
        }
    }

    public function setYear($year)
    {
        if (checkdate(1, 1, $year)) {
            $this->year = $year;
        } else {
            $this->year = date('Y');
        }
    }
}