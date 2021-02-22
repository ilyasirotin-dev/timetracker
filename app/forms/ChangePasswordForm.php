<?php
declare(strict_types=1);

namespace App\Forms;


use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\PresenceOf;

class ChangePasswordForm extends Form
{
    /**
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {
        /**
         * New Password field
         */
        $newPassword = new Password('newPassword', ['class' => 'form-control']);
        $newPassword->setLabel('New password');
        $newPassword->addValidators(
            [
                new PresenceOf(['message' => 'New password is required']),
            ]
        );

        $this->add($newPassword);

        /**
         * Confirm new password
         */
        $repeatPassword = new Password('repeatPassword', ['class' => 'form-control']);
        $repeatPassword->setLabel('Repeat new password');
        $repeatPassword->addValidators(
            [
                new Confirmation(
                    [
                        'message' => 'Passwords doesn\'t match',
                        'with' => 'newPassword'
                    ]
                ),
            ]
        );

        $this->add($repeatPassword);
    }
}