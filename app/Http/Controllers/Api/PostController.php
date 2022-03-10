<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Post;

class PostController extends Controller
{
    public function index()
    {
        $products = Post::paginate(20);

        return response()->json([
            'response' => true,
            'results' =>  $products,
        ]);
    }

    public function inRandomOrder()
    {
        $products = Post::inRandomOrder()->limit(4)->get();
        return response()->json([
            'response' => true,
            'results' => [
                'data' => $products
            ],
        ]);
    }
}
