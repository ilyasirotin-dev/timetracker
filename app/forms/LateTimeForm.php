<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Form;

class LateTimeForm extends Form
{
    /**
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {
        /**
         * Hours input field
         */
        $hours = new Numeric('hours',
            [
                'class' => 'form-control',
                'value' => 9,
                'min' => 0,
                'max' => 23,
            ]
        );
        $hours->setLabel('Hours');

        $this->add($hours);

        /**
         * Minutes input field
         */
        $minutes = new Numeric('minutes',
            [
                'class' => 'form-control',
                'value' => 0,
                'min' => 0,
                'max' => 59,
            ]
        );
        $minutes->setLabel('Minutes');

        $this->add($minutes);
    }
}