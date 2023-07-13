<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormPost extends AForm {

    protected $method = "POST";

    public function getConfig($row=[], $category=[]): array
    {
        $group = [];

        $group['title'] = $this->getElements(
            [ "title" => "title" ],
            [
                "type"=>"text",
                "placeholder"=>"title",
                "min"=>2,
                "max"=>60,
                "col"=>4,
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
                "col"=>4,
                "value"=> ($row)?trim($row[0]['slug']):'',
                "required" => "required",
                "event" => "",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $option = [];
        if($category){
            foreach ($category as $key => $value) {
                $selected = '';
                if($row){
                    if($value['id'] == $row[0]['parents']){
                        $selected = 'selected';
                    }
                }
                $option[$key]['value'] = $value['id'];
                $option[$key]['title'] = $value['title'];
                $option[$key]['selected'] = $selected;
            }
        }

        $group['parents'] = $this->getElements(
            [
                "id" => "parents",
                "title" => "parents",
                "col"=>4,
            ],
            [
                "type" => "select",
                "options" => $option,
                "error" => "Parents incorrect"
            ]
        );

        $group['description'] = $this->getElements(
            [ "title" => "description" ],
            [
                "type"=>"textarea",
                "placeholder"=>"description",
                "min"=>2,
                "max"=>120,
                "col"=>12,
                "value"=> ($row)?trim($row[0]['description']):'',
                "required" => "required",
                "event" => "",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['content'] = $this->getElements(
            [ "title" => "content" ],
            [
                "type"=>"textarea",
                "placeholder"=>"content",
                "min"=>2,
                "max"=>120,
                "col"=>12,
                "value"=> ($row)?trim($row[0]['content']):'',
                "required" => "required",
                "event" => "",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['canonical'] = $this->getElements(
            [ "title" => "canonical" ],
            [
                "type"=>"text",
                "placeholder"=>"canonical",
                "min"=>2,
                "max"=>120,
                "col"=>4,
                "value"=> ($row)?trim($row[0]['canonical']):'',
                "required" => "",
                "event" => "",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['metatitle'] = $this->getElements(
            [ "title" => "metatitle" ],
            [
                "type"=>"text",
                "placeholder"=>"metatitle",
                "min"=>2,
                "max"=>120,
                "col"=>4,
                "value"=> ($row)?trim($row[0]['metatitle']):'',
                "required" => "",
                "event" => "",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['metadescription'] = $this->getElements(
            [ "title" => "metadescription" ],
            [
                "type"=>"text",
                "placeholder"=>"metadescription",
                "min"=>2,
                "max"=>120,
                "col"=>4,
                "value"=> ($row)?trim($row[0]['metadescription']):'',
                "required" => "",
                "event" => "",
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