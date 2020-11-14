<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class DropzoneController extends Controller
{
   	public function index(){
   		return view('dropzone');
   	}

  	public function store(Request $request){
  		$image = $request->file;
 		$fileName = $image->getClientOriginalName();
 		Image::make($image->getRealPath())->resize(300, null, function ($constraint){
 			$constraint->aspectRatio();
 		})->save(public_path('images/'. $image->hashName()));
   	}
}
