<?php
declare(strict_types=1);

namespace App\Helpers\Tables;

use App\Helpers\Calendar;
use App\Models\Users;
use Phalcon\Di\Injectable;
use Phalcon\Exception;

abstract class TableBase extends Injectable
{
    /**
     * @var Calendar
     */
    public $calendar;
    /**
     * @var TableBase
     */
    public $tableData;
    /**
     * @var array
     */
    public $users;

    public function __construct($year = 0, $month = 0)
    {
        $this->calendar = new Calendar($year, $month, 'Y-m-d');
        $this->setUsers($this->session->get('auth')['id']);
        static::setTableData();
    }

    abstract public function setTableData();

    public function setUsers($firstUser = 0): void
    {
        try {
            $this->users = Users::find([
                'conditions' => 'active = 1',
                'order' => 'field(id, :id:) DESC',
                'bind' => [
                    'id' => $firstUser,
                ]
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}