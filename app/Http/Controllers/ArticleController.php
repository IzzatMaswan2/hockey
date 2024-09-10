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

    public function create()
    {
        return view('article');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'place' => 'required|string|max:10000',
            'summary' => 'required|string|max:10000000',
            'content' => 'required|string',
        ]);

        // Handle the file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create a new article
        Article::create([
            'title' => $request->input('title'),
            'image' => $imagePath,
            'place' => $request->input('place'),
            'summary' => $request->input('summary'),
            'content' => $request->input('content'),
        ]);
        return redirect()->route('article.create')->with('success', 'Article created successfully!');
    }
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $recentArticles = Article::latest()->take(5)->get();
        
        return view('forum', compact('article', 'recentArticles'));
    }
    public function latestPublished()
    {
        $latestArticle = Article::where('status', 'published')
            ->latest('date_news') 
            ->first(); 
            

        if (!$latestArticle) {
            return response()->json(['message' => 'No published articles found.'], 404);
        }

        return view('user.forum', [
            'latestArticle' => $latestArticle
        ]);
    }
}
