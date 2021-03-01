<?php
declare(strict_types=1);

namespace App\Helpers\Tables;

class LogTable extends TableBase
{
    public function __construct($year = 0, $month = 0)
    {
        parent::__construct($year, $month);
    }

    /**
     * Generates a LogTable
     */
    public function setTableData(): void
    {
        foreach ($this->calendar->datesList as $date) {
            foreach ($this->users as $user) {
                $records = $user->getTimeTable([
                    'conditions' => 'created_at = :date:',
                    'bind' => [
                        'date' => strtotime($date),
                    ]
                ]);
                $dayRecords = [];
                foreach ($records as $record) {
                    $start = date('H:i', (int)$record->start);
                    ($record->end === null) ?
                        $end = '' :
                        $end = date('H:i', (int)$record->end);

                    $dayRecords[] =
                        [
                            'id' => $record->id,
                            'start' => $start,
                            'end' => $end,
                        ];
                }
                $usersDayRecords[$user->id] = $dayRecords;
            }
            $this->tableData[$date] = $usersDayRecords;
        }
    }
}