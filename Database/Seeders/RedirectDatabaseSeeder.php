<?php

namespace Modules\Redirect\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Redirect\Models\Redirect;


class RedirectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Model::unguard();


        $redirects = config("redirects");
    

        foreach($redirects as $name => $url){

            Redirect::firstOrCreate(
                ['name' =>  $name],
                ['url' => $url]
            );

        }


    }
}
