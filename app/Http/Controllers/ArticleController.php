<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; 

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all(); 
        return view('forum', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::find($id);
        
        if (!$article) {
            return abort(404);
        }

        return response()->json($article);
    }
    public function latestPublished()
    {
        $latestArticle = Article::where('status', 'published')
            ->latest('date_news') 
            ->first(); 
            

        if (!$latestArticle) {
            return response()->json(['message' => 'No published articles found.'], 404);
        }

        return view('forum', [
            'latestArticle' => $latestArticle
        ]);
    }
}
