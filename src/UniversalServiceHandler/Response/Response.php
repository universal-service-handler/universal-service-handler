<?php
/*
 * @author Zsolt Javorszky
 * @author Sandor Legoza
 * @copyright 2013
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniversalServiceHandler\Response;

class Response
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 0;

    protected $errors;
    protected $status;
    protected $data;

    public function setData($entity)
    {
        $this->data = $entity;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
