<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormMenu extends AForm {

    protected $method = "POST";

    public function getConfig($row=[]): array
    {
        $group = [];

        $group['title'] = $this->getElements(
            [ "title" => "title" ],
            [
                "type"=>"text",
                "placeholder"=>"title",
                "min"=>2,
                "max"=>60,
                "value"=> ($row)?trim($row[0]['title']):'',
                "required" => "required",
                "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
            ]
        );

        $group['link'] = $this->getElements(
            [ "title" => "link" ],
            [
                "type"=>"text",
                "placeholder"=>"link",
                "min"=>2,
                "max"=>120,
                "value"=> ($row)?trim($row[0]['link']):'',
                "required" => "required",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "submit"=>"save",
                "cancel"=>"index"
            ],
            "groups" => $group
        ];
    }
}