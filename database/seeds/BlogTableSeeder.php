<?php

use Illuminate\Database\Seeder;
use App\Models\Blog;
class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $list = ['Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Mauris sed nisl nec sapien egestas aliquet', 'Fusce feugiat tristique nisl tristique mattis', 'Vivamus porta lorem vel ligula dapibus mattis'];

        $i = 0;
        foreach ($list as $value) {
            $blog = new Blog();
            $blog->title = $value;
            $blog->slug = str_slug($blog->title);
            $blog->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl nec sapien egestas aliquet. Fusce feugiat tristique nisl tristique mattis. Suspendisse et lorem urna. Integer sodales augue arcu, rhoncus volutpat nibh laoreet eu. Vivamus porta lorem vel ligula dapibus mattis. Sed bibendum, augue vitae cursus consectetur, urna orci bibendum ex, vel pretium mi neque et libero. Duis sit amet erat convallis, tempor sem id, tempor felis. Quisque luctus viverra sem ut sagittis.';
            $blog->image = 'default-blog.jpg';
            $blog->user_id = rand(1, 2);
            $blog->tag_id = rand(1, 3);
            $blog->save();
            $i++;
        }
    }
}
