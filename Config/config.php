<?php

   return [
    
        "name" => "Redirect",
       // "email" => Modules\Email\Models\Email::class,

       'admin' => [

            'navigationbar'=>[
                
                "group" => "Indstillinger",

                "sorting" => 1000,
                
                "link" => [ "icon" => "fas fa-user-lock", "name" => "Redirect", "link" => "redirect.index", 'new_window' => false ],

                "submenu" => [

    
                    ["icon" => "fas fa-user-lock", "name" => "Device redirect", "link" => "device-redirects.index", 'new_window' => false ]                  

                ],       
               
            ],

         
        ],

    
        

    ];
 