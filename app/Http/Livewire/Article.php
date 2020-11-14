<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Article extends Component
{

	public $title;
	public $author;
	public $body;

	protected $rules = [
		'title' => ['required', 'max:20'],
   		'body'  => ['required', 'max:50', 'min:10'],
   		'author' => ['required', 'max:10'],
	];

	public function updated($propertyName){
		$this->validateOnly($propertyName);
	}

    public function render()
    {
        return view('livewire.article');
    }
}
