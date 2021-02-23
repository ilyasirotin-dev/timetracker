<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class CreateHolidayForm extends Form
{
    /**
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {
        /**
         * Holiday name field
         */
        $name = new Text('name', ['class' => 'form-control']);
        $name->setLabel('Name');
        $name->setFilters(
            [
                'alpha',
                'trim',
            ]
        );
        $name->addValidator(
            new PresenceOf(['message' => 'Holiday name is required'])
        );

        $this->add($name);

        /**
         * Holiday date
         */
        $date = new Date('date', ['class' => 'form-control']);
        $date->setLabel('Date');
        $date->addValidator(
            new PresenceOf(['message' => 'Holiday date is required'])
        );

        $this->add($date);

        /**
         * Holiday description
         */
        $description = new TextArea('description', ['class' => 'form-control']);
        $description->setLabel('Description');
        $description->setFilters(
            [
                'striptags',
                'trim',
            ]
        );

        $this->add($description);

        /**
         * Repeat every year
         */
        $repeat = new Select('repeat',
            [
                0 => 'No',
                1 => 'Yes',
            ],
            ['class' => 'form-select']
        );
        $repeat->setLabel('Repeat');

        $this->add($repeat);
    }
}
