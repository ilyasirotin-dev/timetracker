<?php
declare(strict_types=1);

namespace App\Helpers;

use App\Models\TimeTable;
use App\Models\Users;
use Phalcon\Exception;

class Table
{
    /**
     * @var array
     */
    public $usersList;
    /**
     * @var array
     */
    public $monthTimeRecords;
    /**
     * @var array
     */
    public $datesList;
    /**
     * @var array
     */
    public $yearsList;
    /**
     * @var array
     */
    public $currentYear;
    /**
     * @var int
     */
    public $currentMonth;

    public function __construct($month = 0, $year = 0)
    {
        $this->timeRecords = [];
        $this->currentMonth = $month;
        $this->currentYear = $year;
        $this->setUsersList();
        $this->setYearsList();
        $this->setDatesList();
        $this->setTimeRecords();
    }

    /**
     * @return array
     * Generates a Table
     */
    public function setTimeRecords(): void
    {
        $monthTimeRecords = [];
        $dateTimeRecords = [];
        foreach($this->datesList as $date) {
                try {
                    $dateTimeRecords = TimeTable::find(
                        [
                            'columns' => 'user_id, start, [end], created_at',
                            'conditions' =>  'created_at = :date:',
                            'bind' => [
                                'date' => strtotime($date),
                            ],
                            'order' => 'user_id',
                        ]
                    );
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            $monthTimeRecords[$date] = $dateTimeRecords->toArray();
        }

        $this->monthTimeRecords = $monthTimeRecords;
    }

    private function setUsersList(): void
    {
        try {
            $this->usersList = Users::find(
                [
                    'columns' => 'id, fname, lname',
                ]
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->usersList = $this->usersList->toArray();
    }

    private function setYearsList(): void
    {
        $firstDate = 0;
        $lastDate = 0;
        try {
            $firstDate = TimeTable::minimum(
                [
                    'column' => 'created_at',
                ]
            );
            $lastDate = TimeTable::maximum(
                [
                    'column' => 'created_at',
                ]
            );

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $this->yearsList = DateGenerator::getYearsList($this->currentYear, $firstDate, $lastDate);

    }

    private function setDatesList(): void
    {
        $this->datesList = DateGenerator::getDatesList($this->currentMonth, $this->currentYear);
    }

}