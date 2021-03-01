<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class LateTime extends Model
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $time;
}