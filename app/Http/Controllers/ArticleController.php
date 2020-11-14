<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
   	public function index(Request $request)
   	{
   		$articles = Article::paginate(5);
         if($request->ajax())
         {
            $view = view('articles.data', compact('articles'))->render();
            return response()->json(['html' => $view]);
         }
         return view('articles.index', compact('articles'));
   	}

   	public function create()
   	{
   		return view('articles.create');
   	}

   	public function store(Request $request)
   	{
   		$request->validate([
   			'title' => ['required', 'max:20'],
   			'body'  => ['required', 'max:50', 'min:10'],
   			'author' => ['required', 'max:10'],
   		]);

   		return "good";
   	}
}
