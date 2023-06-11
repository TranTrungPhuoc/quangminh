<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class AddUser extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "submit"=>"save",
                "cancel"=>"index"
            ],
            "groups" => [
                "firstname"=> [
                    "labels" => [
                        "title" => "Họ"
                    ],
                    "inputs" =>[
                        "type"=>"text",
                        "placeholder"=>"Votre prénom",
                        "min"=>2,
                        "max"=>60,
                        "required" => "required",
                        "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
                    ]
                ],
                "lastname"=> [
                    "labels" => [
                        "title" => "Tên"
                    ],
                    "inputs" =>[
                        "type"=>"text",
                        "placeholder"=>"Votre nom",
                        "min"=>2,
                        "max"=>120,
                        "required" => "required",
                        "error"=>"Votre nom doit faire entre 2 et 120 caractères"
                    ]
                ],
                "email"=> [
                    "labels" => [
                        "id" => "email",
                        "title" => "Email"
                    ],
                    "inputs" =>[
                        "type"=>"email",
                        "placeholder"=>"Votre email",
                        "required" => "required",
                        "error"=>"Le format de votre email est incorrect"
                    ]
                ],
                "pwd"=> [
                    "labels" => [
                        "id" => "password",
                        "title" => "Mật Khẩu"
                    ],
                    "inputs" =>[
                        "type"=>"password",
                        "placeholder"=>"Votre mot de passe",
                        "required" => "required",
                        "error"=>"Votre mot de passe est incorrect"
                    ]
                ],
                "pwdConfirm"=> [
                    "labels" => [
                        "id" => "pwdConfirm",
                        "title" => "Xác Nhận Mật Khẩu"
                    ],
                    "inputs" =>[
                        "type"=>"password",
                        "placeholder"=>"Confirmation",
                        "confirm"=>"pwd",
                        "required" => "required",
                        "error"=>"Mot de passe de confirmation incorrect"
                    ]
                ],
                // "country"=> [
                //     "labels" => [
                //         "id" => "country",
                //         "title" => "Quốc Gia"
                //     ],
                //     "inputs" =>[
                //         "type"=>"select",
                //         "options"=>["","FR", "PL"],
                //         "error"=>"Pays incorrect"
                //     ]
                // ]
            ]
        ];
    }
}