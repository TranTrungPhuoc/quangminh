<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormUser extends AForm {

    protected $method = "POST";

    public function getConfig($row=[]): array
    {
        $group = [];

        $group['firstname'] = $this->getInput(
            [ "title" => "Firstname" ],
            [
                "type"=>"text",
                "placeholder"=>"Firstname",
                "min"=>2,
                "max"=>60,
                "value"=> ($row)?trim($row[0]['firstname']):'',
                "required" => "required",
                "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
            ]
        );

        $group['lastname'] = $this->getInput(
            [ "title" => "Lastname" ],
            [
                "type"=>"text",
                "placeholder"=>"Lastname",
                "min"=>2,
                "max"=>120,
                "value"=> ($row)?trim($row[0]['lastname']):'',
                "required" => "required",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['email'] = $this->getInput(
            [
                "id" => "email",
                "title" => "Email"
            ],
            [
                "type"=>"email",
                "placeholder"=>"Email",
                "required" => "required",
                "value"=> ($row)?trim($row[0]['email']):'',
                "error"=>"Le format de votre email est incorrect"
            ]
        );

        if(!$row){
            $group['pwd'] = $this->getInput(
                [
                    "id" => "password",
                    "title" => "Password"
                ],
                [
                    "type"=>"password",
                    "placeholder"=>"Password",
                    "required" => "required",
                    "value"=> '',
                    "error"=>"Votre mot de passe est incorrect"
                ]
            );
    
            $group['pwdConfirm'] = $this->getInput(
                [
                    "id" => "pwdConfirm",
                    "title" => "PwdConfirm"
                ],
                [
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "confirm"=>"pwd",
                    "required" => "required",
                    "value"=> '',
                    "error"=>"Mot de passe de confirmation incorrect"
                ]
            );
        }

        // $group['country'] = $this->input(
        //     [
        //         "id" => "country",
        //         "title" => "Quốc Gia"
        //     ],
        //     [
        //         "type"=>"select",
        //         "options"=>["","FR", "PL"],
        //         "error"=>"Pays incorrect"
        //     ]
        // );

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