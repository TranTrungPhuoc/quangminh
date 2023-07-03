<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormPost extends AForm {

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
                "event" => "onkeyup",
                "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
            ]
        );

        $group['slug'] = $this->getElements(
            [ "title" => "slug" ],
            [
                "type"=>"text",
                "placeholder"=>"slug",
                "min"=>2,
                "max"=>120,
                "value"=> ($row)?trim($row[0]['slug']):'',
                "required" => "required",
                "event" => "",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $option = [
            // [
            //     "value" => 0,
            //     "title" => "",
            //     "selected" => ""
            // ],
            // [
            //     "value" => "FR",
            //     "title" => "FR",
            //     "selected" => ""
            // ],
            // [
            //     "value" => "PL",
            //     "title" => "PL",
            //     "selected" => ""
            // ]
        ];
        
        if($row){
            $new_option = [];
            foreach ($option as $key => $value) {
                $selected = '';
                if($value['value'] == $row[0]['country']){
                    $selected = 'selected';
                }
                $new_option[$key]['value'] = $value['value'];
                $new_option[$key]['title'] = $value['title'];
                $new_option[$key]['selected'] = $selected;
            }
            // print_r($new_option);

            $option = $new_option;
        }

        $group['parents'] = $this->getElements(
            [
                "id" => "parents",
                "title" => "parents"
            ],
            [
                "type" => "select",
                "options" => $option,
                "error" => "Parents incorrect"
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