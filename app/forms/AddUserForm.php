<?php


namespace App\Forms;


use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;

class AddUserForm extends Form
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
        $fname = new Text('fname');
        $fname->setLabel('First name');
        $fname->setFilters(
            [
                'string',
                'trim',
            ]
        );
        $fname->addValidator(
            new PresenceOf(['message' => 'First name is required'])
        );


        $this->add($fname);

        /**
         * Last Name
         */
        $lname = new Text('lname');
        $lname->setLabel('Last name');
        $lname->setFilters(
            [
                'string',
                'trim',
            ]
        );
        $fname->addValidator(
            new PresenceOf(['message' => 'Last name is required'])
        );


        $this->add($lname);

        /**
         * Username
         */
        $username = new Text('username');
        $username->setLabel('Username');
        $username->setFilters(
            [
                'string',
                'trim',
            ]
        );
        $username->addValidator(
            new PresenceOf(['message' => 'Username is required'])
        );

        $this->add($username);

        /**
         * E-mail field
         */
        $email = new Text('email');
        $email->setLabel('E-mail');
        $email->setFilters('email');
        $email->addValidators(
            [
                new PresenceOf(['message' => 'E-mail is required']),
                new Email(['message' => 'E-mail is not valid']),
            ]
        );

        $this->add($email);

        /**
         * Role
         */
        $role = new Select('role', ['class' => 'form-select']);
        $role->setLabel('Role');
        $role->setOptions(
            [
                0 => 'User',
                1 => 'Admin',
            ]
        );

        $this->add($role);

        /**
         * Password field
         */
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidator(
            new PresenceOf(['message' => 'Password is required'])
        );

        $this->add($password);

        /**
         * Confirm password
         */
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat password');
        $repeatPassword->addValidators(
            [
            new Confirmation(
                [
                    'message' => 'Password confirmation is required',
                    'with' => 'password'
                ]
            ),
            ]
        );

        $this->add($repeatPassword);
    }
}