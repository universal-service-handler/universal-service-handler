<?php
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
