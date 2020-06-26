<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Portfolio;
use Validator;

class PortfolioEditController extends Controller
{
    //
    /*
        $portfolio - модель элемента портфолио объекта бд (строки) получаемый по id в Route
        $input - передаваемые в запросе данные кроме строки '_token'
        $validator - объект проведенной валидации
        $file - объект передаваемого реквестом изображения
        $old - массив $portfolio
        $data - передаваемые данные в вид 'admin.portfolios_edit'
        'name' - поле имени редактируемой формы
        'filter' - поле фильтра
        'admin' - страница админки
    */

    /*public function execute($id){
        $page = Page::find($id);
        dd($page);

    // или так, ларавель сам выберает объект из бд передаваемый в url: 

        public function execute (Page $page, request $request){
        //dd($page);
    }*/

    public function execute(Portfolio $portfolio, Request $request){

        // удаление элемента портфолио. С записью статуса в сессию
        if($request-> isMethod('delete')){
            $portfolio -> delete();
            return redirect('admin')->with('status', 'страница удалена');
        }

        // update элемента портфолио
        if($request-> isMethod('post')){
            $input = $request -> except('_token');

            // сообщение для валидации
            $message = [
                'requiered' => 'Поле :attribute обязательно для заполнения',
                'max' => 'Поле :attribute имеет максимальную длинну 255 символов',
                'unique' => 'Поле :attribute обязательно для заполнения'
            ];

            // валидация
            $validator = Validator::make($input, [
                'name' => 'required|max:255|unique:portfolios,name,'.$input['id'],
                'filter' => 'required|max:255',
            ], $message);
            
            if($validator -> fails()){
                return redirect()
                    ->route('portfoliosEdit',['portfolio' => $input['id']])
                    ->withErrors($validator);
            };
              
            // проверка наличия обновления картинки. В отсутствии используется старая картинка.  
            if($request-> hasFile('images')){
                $file = $request-> File('images');
                $file->move(public_path().'/assets/img',$file->getClientOriginalName());
                $input['images'] = $file-> getClientOriginalName();
            } else $input['images'] = $input['old_images'];
            
            unset($input['old_images']);

            // обновление информации в бд редактируемой модели
            $portfolio-> fill($input);
            if($portfolio->update()){
                return redirect('admin')-> with('status', 'Обновление произошло');
            }
        }

        // инициализация страницы редактирования элемента портфолио
        $old = $portfolio-> toArray();
        if(view()-> exists('admin.portfolios_edit')){
            $data = [
                'title' => 'Редактирование портфолио ' . $old['name'],
                'data' => $old
            ];
            return view('admin.portfolios_edit', $data);
        }

    }
}

