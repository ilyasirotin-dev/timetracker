<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class CreateUserForm extends Form
{
    /**
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {

        /**
         * First name
         */
        $fname = new Text('fname', ['class' => 'form-control']);
        $fname->setLabel('First name');
        $fname->setFilters([
            'alpha',
            'trim',
        ]);
        $fname->addValidator(
            new PresenceOf(['message' => 'First name is required'])
        );


        $this->add($fname);

        /**
         * Last Name
         */
        $lname = new Text('lname', ['class' => 'form-control']);
        $lname->setLabel('Last name');
        $lname->setFilters([
            'alpha',
            'trim',
        ]);
        $fname->addValidator(
            new PresenceOf(['message' => 'Last name is required'])
        );


        $this->add($lname);

        /**
         * Username
         */
        $username = new Text('username', ['class' => 'form-control']);
        $username->setLabel('Username');
        $username->setFilters([
            'string',
            'trim',
        ]);
        $username->addValidator(
            new PresenceOf(['message' => 'Username is required'])
        );

        $this->add($username);

        /**
         * E-mail field
         */
        $email = new Text('email', ['class' => 'form-control']);
        $email->setLabel('E-mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf(['message' => 'E-mail is required']),
            new Email(['message' => 'E-mail is not valid']),
        ]);

        $this->add($email);

        /**
         * Role
         */
        $is_admin = new Select('is_admin',
            [
                0 => 'User',
                1 => 'Admin',
            ],
            ['class' => 'form-select']
        );
        $is_admin->setLabel('Role');
        $this->add($is_admin);

        /**
         * Password field
         */
        $password = new Password('password', ['class' => 'form-control']);
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf(['message' => 'Password is required']),
        ]);

        $this->add($password);

        /**
         * Confirm password
         */
        $repeatPassword = new Password('repeatPassword', ['class' => 'form-control']);
        $repeatPassword->setLabel('Repeat password');
        $repeatPassword->addValidators([
            new Confirmation(
                [
                    'message' => 'Passwords doesn\'t match',
                    'with' => 'password'
                ]
            ),
        ]);

        $this->add($repeatPassword);
    }
}