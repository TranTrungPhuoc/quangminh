<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormUser extends AForm {

    protected $method = "POST";

    public function getConfig($row=[]): array
    {
        $group = [];

        $group['firstname'] = $this->input(
            [ "title" => "Họ" ],
            [
                "type"=>"text",
                "placeholder"=>"Votre prénom",
                "min"=>2,
                "max"=>60,
                "value"=> ($row)?trim($row[0]['firstname']):'',
                "required" => "required",
                "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
            ]
        );

        $group['lastname'] = $this->input(
            [ "title" => "Tên" ],
            [
                "type"=>"text",
                "placeholder"=>"Votre nom",
                "min"=>2,
                "max"=>120,
                "value"=> ($row)?trim($row[0]['lastname']):'',
                "required" => "required",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['email'] = $this->input(
            [
                "id" => "email",
                "title" => "Email"
            ],
            [
                "type"=>"email",
                "placeholder"=>"Votre email",
                "required" => "required",
                "value"=> ($row)?trim($row[0]['email']):'',
                "error"=>"Le format de votre email est incorrect"
            ]
        );

        if(!$row){
            $group['pwd'] = $this->input(
                [
                    "id" => "password",
                    "title" => "Mật Khẩu"
                ],
                [
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "required" => "required",
                    "value"=> '',
                    "error"=>"Votre mot de passe est incorrect"
                ]
            );
    
            $group['pwdConfirm'] = $this->input(
                [
                    "id" => "pwdConfirm",
                    "title" => "Xác Nhận Mật Khẩu"
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

    public function input($labels=[], $inputs=[]){
        return [
            "labels" => $labels,
            "inputs" => $inputs
        ];
    }
}