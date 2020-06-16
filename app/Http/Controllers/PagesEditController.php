<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;

class PagesEditController extends Controller
{
    //
    public function execute($id){
    	$page = Page::find($id);
    	dd($page);
    }
}
