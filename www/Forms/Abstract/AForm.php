<?php
namespace App\Forms\Abstract;

abstract class AForm
{
    abstract public function getConfig(): array;
    public function isSubmit(): bool
    {
        $data = ($this->getMethod() == "post")?$_POST:$_GET;
        if(empty($data))
            return false;
        return true;
    }

    public function getMethod(): string
    {
        return strtolower($this->method);
    }

    public function getInput($labels=[], $inputs=[]){
        return [
            "labels" => $labels,
            "inputs" => $inputs
        ];
    }
}