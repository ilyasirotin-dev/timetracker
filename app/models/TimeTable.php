<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class TimeTable extends Model
{
    /**
     * @var int
     */
    public $user_id;
    /**
     * @var int
     */
    public $start;
    /**
     * @var int
     */
    public $end;
    /**
     * @var int
     */
    public $created_at;

    public function initialize()
    {
        $this->belongsTo(
            'user_id',
            Users::class,
            'id',
            [
                'alias' => 'users',
            ]
        );
    }
}