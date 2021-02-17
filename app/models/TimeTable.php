<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class TimeTable extends Model
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $start;
    /**
     * @var string
     */
    public $end;
    /**
     * @var string
     */
    public $created_at;

    public function initialize()
    {
        $this->belongsTo(
            'user_id',
            Users::class,
            'id',
        );
    }
}