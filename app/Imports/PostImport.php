<?php

namespace App\Imports;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = \DB::table('users')->where('name', $row['auther'])->first();
        return new Post([
            'title' => $row['title'],
            'body'  => $row['body'],
            'user_id' => $user->id,
        ]);
    }
}
