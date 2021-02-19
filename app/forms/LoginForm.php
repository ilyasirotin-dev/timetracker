<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    /**
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {

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
         * Password field
         */
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators(
            [
                new PresenceOf(['message' => 'Password is required'])
            ]
        );

        $this->add($password);
    }
}