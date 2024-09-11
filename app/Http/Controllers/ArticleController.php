<?php

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function create()
    {
        return view('admin.article');
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
    
    return view('user.forum', compact('article', 'recentArticles'));
}
}
