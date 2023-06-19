<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormMenu extends AForm {

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

        $group['link'] = $this->getInput(
            [ "title" => "Link" ],
            [
                "type"=>"text",
                "placeholder"=>"Link",
                "min"=>2,
                "max"=>120,
                "value"=> ($row)?trim($row[0]['lastname']):'',
                "required" => "required",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['location'] = $this->getInput(
            [ "title" => "Location" ],
            [
                "type"=>"select",
                "options"=>["Top","Bottom"],
                "error"=>"Pays incorrect"
            ]
        );

        $group['topic'] = $this->getInput(
            [ "title" => "Topic" ],
            [
                "type"=>"text",
                "placeholder"=>"Topic",
                "required" => "required",
                "value"=> ($row)?trim($row[0]['topic']):'',
                "error"=>"Le format de votre email est incorrect"
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