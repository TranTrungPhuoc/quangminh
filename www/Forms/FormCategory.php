<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormCategory extends AForm {

    protected $method = "POST";

    public function getConfig($row=[]): array
    {
        $group = [];

        $group['name'] = $this->getInput(
            [ "title" => "Name" ],
            [
                "type"=>"text",
                "placeholder"=>"Name",
                "min"=>2,
                "max"=>60,
                "value"=> ($row)?trim($row[0]['name']):'',
                "required" => "required",
                "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
            ]
        );

        $group['slug'] = $this->getInput(
            [ "title" => "Slug" ],
            [
                "type"=>"text",
                "placeholder"=>"Slug",
                "min"=>2,
                "max"=>60,
                "value"=> ($row)?trim($row[0]['slug']):'',
                "required" => "required",
                "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
            ]
        );

        $group['parents'] = $this->getInput(
            [ "title" => "Parents" ],
            [
                "type"=>"select",
                "options"=>["Category 1","Category 2"],
                "error"=>"Pays incorrect"
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