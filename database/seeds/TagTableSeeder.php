<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = ['Technology', 'Design', 'Lifestyle'];

        $i = 0;
        foreach ($list as $value) {
            $tag = new Tag();
            $tag->name = $value;
            $tag->save();
            $i++;        
        }
    }
}
