<?php
declare(strict_types=1);

namespace App\Helpers\Tables;

class StatisticTable extends TableBase
{
    public function __construct($year = 0, $month = 0)
    {
        parent::__construct($year, $month);
    }

    /**
     * Generates a StatisticTable
     */
    public function setTableData(): void
    {
        foreach($this->calendar->datesList as $date) {
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
            $this->tableData[$date] = $usersDayRecords;
        }
    }
}