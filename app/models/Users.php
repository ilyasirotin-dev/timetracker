<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{
    /**
     * @var int
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
     * @var bool
     */
    public $is_admin;
    /**
     * @var string
     */
    public $password;
    /**
     * @var int
     */
    public $created_at;
    /**
     * @var bool
     */
    public $active;

    public function initialize()
    {
        $this->hasMany(
            'id',
            TimeTable::class,
            'user_id',
            [
                'alias' => 'timetable',
            ]
        );

        $this->hasMany(
            'id',
            Lates::class,
            'user_id',
            [
                'alias' => 'lates',
            ]
        );
    }

    public function validation(): bool
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new UniquenessValidator(
                [
                    'message' => 'The email was registered by another user',
                ]
            )
        );

        $validator->add(
            'username',
            new UniquenessValidator(
                [
                    'message' => 'That username is already taken',
                ]
            )
        );

        return $this->validate($validator);
    }

    public function beforeCreate(): void
    {
        $security = $this->getDi()->get('security');
        $this->password = $security->hash($this->password);
        $this->created_at = time();
        $this->active = true;
    }
}