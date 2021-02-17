<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $fname;
    /**
     * @var string
     */
    public $lname;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $role;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $active;

    public function initialize()
    {
        $this->hasMany(
            'id',
            TimeTable::class,
            'user_id',
            [
                'alias' => 'TimeTable',
            ]
        );

        $this->hasMany(
            'id',
            Lates::class,
            'user_id',
            [
                'alias' => 'Lates',
            ]
        );
    }
}