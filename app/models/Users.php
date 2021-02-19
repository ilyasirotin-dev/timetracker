<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Messages\Messages;
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{
    public $id;
    public $fname;
    public $lname;
    public $username;
    public $email;
    public $is_admin;
    public $password;
    public $created_at;
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

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new UniquenessValidator(
                [
                    'message' => 'Sorry, The email was registered by another user',
                ]
            )
        );

        $validator->add(
            'username',
            new UniquenessValidator(
                [
                    'message' => 'Sorry, That username is already taken',
                ]
            )
        );

        //return $this->validate($validator);
    }
}