<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;

use Validator;

class PagesEditController extends Controller
{
    //
    
    public function execute(Page $page,Request $request) {
    //
    	if($request->isMethod('delete')){
    		$page->delete();
    		return redirect ('admin')->with('status', 'страница уделаена');
    	}

    /*public function execute($id){
    	$page = Page::find($id);
    	dd($page);

    // или так, ларавель сам выберает объект из бд передаваемый в url: 

    	public function execute (Page $page, request $request){
    	//dd($page);
    }*/


 		if($request->isMethod('post')) {
			
			
			$input = $request->except('_token');
			
			$validator = Validator::make($input,[
			
				'name'=>'required|max:255',
				'alias' => 'required|max:255|unique:pages,alias,'. $input['id'], /* игнорируем строку с соответствующим идентификатором. pages - название таблицы, alias - поле для поиска, $input['id'] - игнорируемый идентификатор. Между "pages,alias" пробел не ставить. А то косяк появляется */
				'text' => 'required'
			
			]);
			
			if($validator->fails()) {
				return redirect()
						->route('pagesEdit',['page'=>$input['id']])
						->withErrors($validator);
			}
			

			/*if($request-> hasFile('images')){ // images поле используемое для загрузки файла
				$file = $request-> file('images');
				$file -> move(public_path().'/assets/img/',$file->getClientOriginalName()); // move - перемещение файла из временной директории в постоянное хранилище
				$input['images'] = $file->getClientOriginalName();
			} 
			else {
				$input['images'] = $input['old_images'];
			}

			unset($input['old_images']);  // удаляет ячейку

			$page-> fill($input); // заполняем новыми данными модель (объект модел / строку бд)

			if($page-> update()){  // перезаписывает запись в бд
				return redirect('admin') ->with('status', 'страница обнавлена'); 
			}*/


			if($request->hasFile('images')) {
				$file = $request->file('images');
				$file->move(public_path().'/assets/img',$file->getClientOriginalName());
				$input['images'] = $file->getClientOriginalName();
			}
			else {
				$input['images'] = $input['old_images'];
			}
			
			unset($input['old_images']);
			
			$page->fill($input);
			
			if($page->update()) {
				return redirect('admin')->with('status','Страница обновлена');
			} 
			
		}

		
		$old = $page->toArray();
		if(view()->exists('admin.pages_edit')) {
			
			$data = [
					'title' => 'Редактирование страницы - '.$old['name'],
					'data' => $old
					];
			return view('admin.pages_edit',$data);		
			
		}
		
	}
}



