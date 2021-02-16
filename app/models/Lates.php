<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class Lates extends Model
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $creataed_at;

    public function initialize()
    {
        $this->belongsTo(
            'id',
            Users::class,
            'id'
        );
    }
}