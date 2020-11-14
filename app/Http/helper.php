<?php

if(!function_exists('lang')){
	function lang(){
		if(session()->has('lang')){
			return session('lang');
		}else{
			return 'en';
		}
	}
}