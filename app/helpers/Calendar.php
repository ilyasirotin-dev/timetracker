<?php
declare(strict_types=1);

namespace App\Helpers;

class Calendar
{
    /**
     * @var int
     */
    public $year;
    /**
     * @var int
     */
    public $month;
    /**
     * @var array
     */
    public $datesList;

    /**
     * Calendar constructor.
     * @param int $year
     * @param int $month
     */
    public function __construct(int $year = 0, int $month = 0, $format = 'Y-m-d')
    {
        $this->setYear($year);
        $this->setMonth($month);
        $this->setDatesList($format);
    }

    /**
     * Generates a list of dates
     * @param string $format
     * @return array
     * @throws \Exception
     */
    public function setDatesList($format): void
    {
        $datesList = [];
        $dateString = $this->year . '-' . $this->month;
        $lastDayOfMonth = date('t', strtotime($dateString));

        $firstDateOfMonth = new \DateTime($dateString . '-1');
        $step = new \DateInterval('P1D');
        $period = new \DatePeriod($firstDateOfMonth, $step, $lastDayOfMonth - 1);

        foreach ($period as $date) {
            $datesList[] = $date->format($format);
        }

        $this->datesList = $datesList;
    }

    /**
     * @param int $year
     */
    public function setYear($year = 0): void
    {
        ($year == 0 || (checkdate(1, 1, $year) === false)) ?
            $this->year = date('Y') :
            $this->year = $year;
    }

    /**
     * @param int $month
     */
    public function setMonth($month = 0): void
    {
        ($month == 0 || (checkdate($month, 1, 1) === false)) ?
            $this->month = date('m') :
            $this->month = $month;
    }

    /**
     * @return array
     */
    public function getDatesList(): array
    {
        return $this->datesList;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return array
     */
    public function getMonth(): int
    {
        return $this->month;
    }
}
