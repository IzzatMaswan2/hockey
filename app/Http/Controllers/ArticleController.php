<?php

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index()
    {        
        $recentArticles = Article::all();
        
        // Return the view with the recent articles
        return view('article', compact('recentArticles'));
    }

    public function create()
    {
        $recentArticles = Article::all(); // Fetch all articles
        return view('article', compact('recentArticles')); // Pass to the view
    }

    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'place' => 'required|string|max:10000',
            'summary' => 'required|string|max:10000000',
            'content' => 'required|string',
        ]);
        
//        dd($request);
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
    public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'place' => 'required|string|max:255',
        'summary' => 'nullable|string',
        'content' => 'required|string',
    ]);

    if ($request->hasFile('image')) {
        // Delete the old image if exists
        if ($article->image) {
            Storage::delete($article->image);
        }
        $imagePath = $request->file('image')->store('images', 'public');
        $article->image = $imagePath;
    }

    $article->title = $request->input('title');
    $article->place = $request->input('place');
    $article->summary = $request->input('summary');
    $article->content = $request->input('content');
    
    $article->save();

    return redirect()->route('article.create')->with('success', 'Article updated successfully');
}
public function indexArticle()
{
    $users = Article::where('archived', 1)->get();
    return view('article', compact('articles'));
}

    public function show($id)
{
    $article = Article::findOrFail($id);
    $recentArticles = Article::latest()->take(5)->get();
    
    return view('user.forum', compact('article', 'recentArticles'));
}

public function unarchive($id)
{
    $article = Article::findOrFail($id);
    $article->archived = 1; // Set to unarchived (active)
    $article->save();

    return redirect()->back()->with('success', 'Manager unarchived successfully.');
}

public function archiveArticle($id)
{
    $article = Article::findOrFail($id);
    $article->archived = 0; // Set to archived
    $article->save();

    return redirect()->back()->with('success', 'Article archived successfully.');
}
}
