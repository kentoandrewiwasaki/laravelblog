<?php

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => Hash::make('password')
        ]);

        $author2 = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@doe.com',
            'password' => Hash::make('password')
        ]);

        $category1 = Category::create([
            'name' => 'News',
        ]);
        $category2 = Category::create([
            'name' => 'Marketing',
        ]);
        $category3 = Category::create([
            'name' => 'Partnership',
        ]);

        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $author1->id,
            'published_at' => Carbon::create('2019', '10', '16')
        ]);
        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg',
            'published_at' => Carbon::create('2019', '10', '16')
        ]);
        $post3 = $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg',
            'published_at' => Carbon::create('2019', '10', '16')
        ]);
        $post4 = $author2->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'category_id' => $category2->id,
            'image' => 'posts/4.jpg',
            'published_at' => Carbon::create('2019', '10', '16')
        ]);
        $post5 = $author2->posts()->create([
            'title' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            'category_id' => $category1->id,
            'image' => 'posts/2.jpg',
            'published_at' => Carbon::create('2019', '10', '16')
        ]);

        $tag1 = Tag::create([
            'name' => 'Job',
        ]);
        $tag2 = Tag::create([
            'name' => 'Customers',
        ]);
        $tag3 = Tag::create([
            'name' => 'Record',
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag1->id, $tag2->id, $tag3->id]);
        $post5->tags()->attach([$tag1->id, $tag2->id, $tag3->id]);
    }
}
