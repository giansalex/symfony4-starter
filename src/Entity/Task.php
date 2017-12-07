<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 07/12/2017
 * Time: 09:06 AM
 */

namespace App\Entity;

/**
 * Class Task
 * @package App\Entity
 */
class Task
{
    protected $task;
    protected $dueDate;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }
}