<?php

namespace App\Exports;

use App\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PostExport implements FromCollection,WithHeadings
{
	public function headings():array
	{
		return [
			'Id',
			'Title',
			'Body',
			'Auther'
		];
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	return collect(Post::getPosts());
        //return Post::all();
    }
}
