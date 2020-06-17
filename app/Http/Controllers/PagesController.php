<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
/*use App\Page;*/

class PagesController extends Controller
{
    //
    public function execute () {

    	if(view()->exists('admin.pages')){
    		$pages = \App\Page::all();  // вмсто: use App\Page , в самом начале

    		$data = [
    			'title' => 'Страницы',
    			'pages' => $pages
    		];

    		return view('admin.pages', $data);
    	} abort(404);

    }
}
