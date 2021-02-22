<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class LateTime extends Model
{
    /**
     * @var int
     */
    public $hours;
    /**
     * @var int
     */
    public $minutes;
}