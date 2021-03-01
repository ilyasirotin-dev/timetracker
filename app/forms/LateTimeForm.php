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
        $defaultHours = $defaultMinutes = 0;

        if ($entity !== null) {
            $defaultHours = date("G", (int)$entity->time);
            $defaultMinutes = date('i', (int)$entity->time);
        }

        /**
         * Hours input field
         */
        $hours = new Numeric('hours', [
            'class' => 'form-control',
            'value' => 9,
            'min' => 0,
            'max' => 23,
        ]);
        $hours->setLabel('Hours');
        $hours->setDefault($defaultHours);

        $this->add($hours);

        /**
         * Minutes input field
         */
        $minutes = new Numeric('minutes', [
            'class' => 'form-control',
            'value' => 0,
            'min' => 0,
            'max' => 59,
        ]);
        $minutes->setLabel('Minutes');
        $minutes->setDefault($defaultMinutes);

        $this->add($minutes);
    }
}