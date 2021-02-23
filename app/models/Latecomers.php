<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class Latecomers extends Model
{
    /**
     * @var int
     */
    public $user_id;
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