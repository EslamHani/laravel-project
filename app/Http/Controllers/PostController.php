<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Store;
use App\Http\Requests\Post\Update;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PostImport;
use  App\Exports\PostExport;
use PDF;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', ['posts' => $posts, 'trash' => false]);
    }

    public function trashindex(){
        $posts = Post::onlyTrashed()->latest()->get();
        return view('posts.index', ['posts' => $posts, 'trash' => true]);
    }

    public function show(){
        //
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Store $request)
    {

        $validatedData = $request->validated();
    
        // excution doesn't reach here if data is fails

        Post::create($validatedData);

        return redirect()->route('posts.index')
                        ->with('success', 'One Record Added Successfully!');

    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, Update $request){

        $validatedData = $request->validated();

        $post->update($validatedData);

        return redirect()->route('posts.index')
                        ->with('success', 'One Record Updated Successfully');
    }

    public function destroy(Post $post){
        
        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success', 'One Record Deleted Successfully');

    }

    public function forceDelete($post){
        Post::onlyTrashed()->where('id', $post)->forceDelete();
        return redirect()->route('posts.trashindex')
                        ->with('success', 'One Record Deleted Successfully');
    }

    public function restore($post){
        Post::onlyTrashed()->where('id', $post)->restore();
        return redirect()->route('posts.trashindex')
                        ->with('success', 'One Record Restore Successfully');
    }

    public function exportIntoExcel(){
        return Excel::download(new PostExport, 'posts.xlsx');
        
    }

    public function exportIntoCsv(){
        return Excel::download(new PostExport, 'posts.csv');
        
    }

    public function getAllPosts(){
        $posts = Post::all();
        return view('posts.test', ['posts' => $posts]);
    }

    public function downloadPDF(){
        $posts = Post::all();
        $pdf = PDF::loadView('posts.test', compact('posts'));
        return $pdf->download('posts-list.pdf');
    }

    public function importForm(){
        return view('posts.import-form');
    }

    public function import(Request $request){
        Excel::import(new PostImport, $request->file);
        return redirect()->route('posts.index');
    }

    public function DeleteAll(Request $request){
        $ids = $request->ids;
        Post::whereIn('id', $ids)->delete();
        return response()->json(['success' => 'Posts has been deleted successfully']);
    }

}
