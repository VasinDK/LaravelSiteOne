<div style="margin:0px 50px 0px 50px;">   
{{-- форма вывода всех страниц в админке --}}
	@if($pages)

		<table class="table table-hover table-striped">
	        <thead>
	            <tr>
	                <th>№ п/п</th>
	                <th>Имя</th>
	                <th>Псевдоним</th>
	                <th>Текст</th>
	                <th>Дата создания</th>
	              {{--   <th>Ссылка</th> --}}
	                <th>Удалить</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@foreach($pages as $k => $page)
	        		<tr>
	        			<td>{{ $page-> id }}</td>
	        			<td>{!! Html::link(route('pagesEdit',['page'=>$page-> id]), $page-> name,['alt'=>$page->name]) !!} </td>
	        			<td>{{ $page-> alias }}</td>
	        			<td>{{ $page-> text }}</td>
	        			<td>{{ $page-> created_at }}</td>
	        			<td>
	        			{{-- Fomt фасад так же из подключенного в начале Html --}}
						{{-- указываем action. 'class' => 'form-horizontal это класс бутстрапа --}}
						{!! Form::open(['url' => route('pagesEdit',['page'=> $page-> id]), 'class' => 'form-horizontal', 'metod' => 'POST'])  !!}
							{{ method_field('DELETE') }}  {{-- формирует следующую строку: <input type='hidden' name='_method value='delete'> --}}
							{!! Form::button('Удалить', ['class'=> 'btn btn-danger', 'type'=> 'submit']) !!}
						{!! Form::close() !!}
						</td>

	        		</tr>
	        	@endforeach
			</tbody>
	    </table>
	    {{-- добавление новой страницы --}}
	    {!! Html::link(route('pagesAdd'), 'Новая страница') !!}
	@endif    

</div>            	