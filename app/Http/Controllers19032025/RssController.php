<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class RssController extends Controller
{
    public function generateRssFeed(){

        $posts = Post::where('published','=',2)->latest()->get();
        // dd(count($posts));
        return response()->view('rss', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
        
        
        // $posts = Post::where('published','=',2)->latest()->get();
        // $rss = new \SimpleXMLElement('<rss/>');
        // $rss->addAttribute('version', '2.0');
        // $channel = $rss->addChild('channel');
        // $channel->addChild('title', 'Your Blog Title');
        // $channel->addChild('link', url('/'));
        // $channel->addChild('description', 'Latest posts');
        
        // foreach ($posts as $post) {
        //     $item = $channel->addChild('item');
        //     $item->addChild('title', $post->title);
        //     $item->addChild('link', url('/posts/' . $post->id));
        //     $item->addChild('description', $post->excerpt);
        //     $item->addChild('pubDate', $post->created_at->toRssString());
        // }
        // return response($rss->asXML(), 200)
        //     ->header('Content-Type', 'text/xml');        
            // ->header('Content-Type', 'application/rss+xml');
    }
}
