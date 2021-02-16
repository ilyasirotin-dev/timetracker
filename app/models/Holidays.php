<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class Holidays extends Model
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $holiday_date;
    /**
     * @var string
     */
    public $info;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $set_repeat;

}