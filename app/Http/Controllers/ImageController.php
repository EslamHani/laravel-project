<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
 	public function ImageForm(){
 		return view('image');
 	}

 	public function ImageStore(Request $request){
 		$image = $request->image;
 		$fileName = $image->getClientOriginalName();
 		Image::make($image->getRealPath())->resize(100, null, function ($constraint){
 			$constraint->aspectRatio();
 		})->save(public_path('images/'. $image->hashName()));
 		return "Image has been resized successfully!";
 	}

}
