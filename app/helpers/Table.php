<?php
declare(strict_types=1);

namespace App\Helpers;

use App\Models\TimeTable;
use App\Models\Users;
use Phalcon\Exception;

class Table
{
    /**
     * @var int
     */
    public $userId;
    /**
     * @var bool
     */
    public $isAdmin;
    /**
     * @var Users
     */
    public $users;
    /**
     * @var array
     */
    public $dates;
    /**
     * @var array
     */
    public $years;
    /**
     * @var array
     */
    public $currentYear;
    /**
     * @var int
     */
    public $currentMonth;
    /**
     * @var array
     */
    public $timeRecords;

    public function __construct($month = 0, $year = 0, $userId = 1, $isAdmin = false)
    {
        $this->currentMonth = $month;
        $this->currentYear = $year;
        $this->userId = $userId;
        $this->isAdmin = $isAdmin;
        $this->setUsers();
        $this->setYears();
        $this->setDates();
        $this->setTimeRecords();
    }

    /**
     * Generates a Table
     */
    private function setTimeRecords(): void
    {
        foreach($this->dates as $date) {
            foreach($this->users as $user) {
                $records = $user->getTimeTable(
                    [
                        'conditions' => 'created_at = :date:',
                        'bind' => [
                            'date' => strtotime($date),
                        ]
                    ]
                );
                $dayRecords = [];
                foreach($records as $record) {
                    $start = date('H:m', (int)$record->start);
                    ($record->end === null) ?
                        $end = '' :
                        $end = date('H:m', (int)$record->end);

                    $dayRecords[] = $start." - ".$end;
                }
                $usersDayRecords[$user->fname] = $dayRecords;
            }
            $this->timeRecords[$date] = $usersDayRecords;
        }
    }

    private function setUsers(): void
    {
        try {
            $this->users = Users::find(
                [
                    'conditions' => 'active = 1',
                    'order' => 'field(id, :userId:) DESC',
                    'bind' => [
                        'userId' => $this->userId,
                    ]
                ]
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function setYears(): void
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

        $this->years = DateGenerator::getYearsList($this->currentYear, $firstDate, $lastDate);

    }

    private function setDates(): void
    {
        $this->dates = DateGenerator::getDatesList($this->currentMonth, $this->currentYear);
    }

}