<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;


class Holidays extends Model
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $date;
    /**
     * @var string
     */
    public $info;
    /**
     * @var int
     */
    public $created_at;
    /**
     * @var string
     */
    public $repeatable;

    public function validation(): bool
    {
        $validator = new Validation();

        $validator->add(
            'name',
            new UniquenessValidator([
                'message' => 'That holiday name is already taken',
            ])
        );

        return $this->validate($validator);
    }

    public function beforeCreate(): void
    {
        $this->created_at = time();
    }

}