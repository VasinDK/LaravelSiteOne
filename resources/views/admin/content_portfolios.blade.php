<div style="margin:0px 50px 0px 50px;">   

{{-- форма вывода всех портфолио --}}
	@if($portfolios)

		<table class="table table-hover table-striped">
	        <thead>
	            <tr>
	                <th>№</th>
	                <th>Имя</th>
	                {{-- <th>Псевдоним</th> --}}
	                <th>Фильтр</th>
	                <th>Дата создания</th>
	              {{--   <th>Ссылка</th> --}}
	                <th>Удалить</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@foreach($portfolios as $k => $portfolio)
	        		<tr>
	        			<td>{{ $portfolio-> id }}</td>
	        			<td>{!! Html::link(route('portfoliosEdit',['portfolio'=>$portfolio-> id]), $portfolio-> name,['alt'=>$portfolio->name]) !!} </td>
	        			{{-- <td>{{ $page-> alias }}</td> --}}
	        			<td>{{ $portfolio-> filter }}</td>
	        			<td>{{ $portfolio-> created_at }}</td>
	        			<td>
	        			{{-- Form фасад так же из подключенного в начале Html --}}
						{{-- указываем action. 'class' => 'form-horizontal это класс бутстрапа --}}
						{{-- вывод кнопки удаления --}}
						{!! Form::open(['url' => route('portfoliosEdit',['portfolio'=> $portfolio-> id]), 'class' => 'form-horizontal', 'metod' => 'POST'])  !!}
							{{ method_field('DELETE') }}  {{-- формирует следующую строку: <input type='hidden' name='method value='delete'> --}}
							{!! Form::button('Удалить', ['class'=> 'btn btn-danger', 'type'=> 'submit']) !!}
						{!! Form::close() !!}
						</td>

	        		</tr>
	        	@endforeach
			</tbody>
	    </table>
	    
	    {{-- создание нового портфолио --}}
	    {!! Html::link(route('portfoliosAdd'), 'Новое портфолио') !!}
	@endif    

</div>            	