<?php
declare(strict_types=1);

namespace App\Helpers;


use App\Models\TimeTable;
use Phalcon\Exception;

class DbRelatedHelpers
{
    public static function getYearsFromDb(): array
    {
        $minYear = 0;
        $maxYear = 0;
        try {
            $minYear = TimeTable::minimum(
                [
                    'column' => 'created_at',
                ]
            );
            $maxYear = TimeTable::maximum(
                [
                    'column' => 'created_at',
                ]
            );

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return [
            'min' => (int)date('Y', (int)$minYear),
            'max' => (int)date('Y', (int)$maxYear),
        ];
    }
}