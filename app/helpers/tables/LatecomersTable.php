<?php
declare(strict_types=1);

namespace App\Helpers\Tables;

class LatecomersTable extends TableBase
{
    public function __construct($year = 0, $month = 0)
    {
        parent::__construct($year, $month);
    }

    public function setTableData()
    {
        foreach($this->calendar->datesList as $date) {
            foreach($this->users as $user) {
                $records = $user->getLatecomers(
                    [
                        'conditions' => 'created_at = :date:',
                        'bind' => [
                            'date' => strtotime($date),
                        ]
                    ]
                );
                $dayRecords = [];
                foreach($records as $record) {
                    if($record !== null) {
                        $dayRecords[] = 1;
                    } else {
                        $dayRecords[] = 0;
                    }
                }
                $usersDayRecords[$user->fname] = $dayRecords;
            }
            $this->tableData[$date] = $usersDayRecords;
        }
    }
}