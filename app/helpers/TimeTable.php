<?php
declare(strict_types=1);

namespace App\Helpers;

use App\Models\TimeTable;
use App\Models\Users;
use Phalcon\Exception;

class TimeTable
{
    /**
     * @var array
     */
    public $usersList;
    /**
     * @var array
     */
    public $timeRecords;
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
    }

    /**
     * @return array
     * Generates a TimeTable
     */
    public function getTimeTable(): array
    {
        foreach($this->datesList as $date) {
            $usersTimeRecords = [];
            foreach ($this->usersList as $user) {
                try {
                    $record = TimeTable::find(
                        [
                            'columns' => 'start, [end], created_at',
                            'conditions' => 'user_id = :id: and created_at = :date:',
                            'bind' => [
                                'id' => $user['id'],
                                'date' => $date,
                            ],
                        ]
                    );
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                $usersTimeRecords[] = $record->toArray();
            }
            $this->timeRecords[$date] = $usersTimeRecords;
        }

        return $this->tableTimeRecords;
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