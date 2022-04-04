<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        $files = File::files(resource_path("posts"));
        $posts = [];

        //  // First way to get posts files
        // foreach ($files as $file) {
        //     // $document[] is declared with a sepecific index in each iteration of the loop
        //     // for exmaple. in the first iteration it will be $document[0], and $document[1] in second iteration
        //     $document =  YamlFrontMatter::parseFile(
        //         $file
        //     );
        //     $posts[] = new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
        // }

        // // Second way
        // $posts = array_map(function ($file) {
        //     $document =  YamlFrontMatter::parseFile(
        //         $file
        //     );
        //     return new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
        // }, $files);

        // Third way using collections in Laravel, and you should stick with using collections
        $posts = cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts")))
                ->map(fn ($file) => YamlFrontMatter::parseFile($file))
                ->map(
                    fn ($document) => new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug
                    )
                )->sortByDesc('date');
        });



        return $posts;
    }

    public static function find($slug)
    {
        // the optimizes way using collections
        return static::all()->firstWhere('slug', $slug);

        // Below is the old way

        $path = resource_path("posts/{$slug}.html");
        // You have also app_path()

        if (!file_exists($path)) {

            throw new ModelNotFoundException();

            // Show not found page
            // abort(404);

            // This used help in debuging
            // dd('file does not exist');
        }

        // You need to cache the file your read it upon large amount of requests
        // Because file_get_contents($path); take from performance
        return cache()->remember("posts.{$slug}", 5, fn () => file_get_contents($path));
    }

    public static function findOrFail($slug)
    {
        $post = static::find($slug);

        if(! $slug) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
