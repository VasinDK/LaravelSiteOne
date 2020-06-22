{{-- форма добавления портфолио --}}
<div class = "wrapper container-fluid">

	{!! Form::open(['url' => route('portfoliosAdd'), 'class' => 'form-horizontal' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

	<div class = "form-group">
		{!! Form::label('name', 'Название', ['class' => 'col-xs-2 control-label']) !!}
		{{-- для элемента name , заголовок: Название. И в виде массива доп. атрибуты --}}
		<div class = "col-xs-8">
			{!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'введите название страницы']) !!}
			 {{-- значение для атребута name. Заполняем value: old('name'). И доп атребуты --}}
		</div>
	</div>

	<div class="form-group">
	     {!! Form::label('filter', 'Фильтр:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('filter', old('filter'), ['class' => 'form-control','placeholder'=>'фильтр портфолио']) !!}
		 </div>
    </div>
    
    <div class="form-group">
	     {!! Form::label('images', 'Изображение:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::file('images', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
		 </div>
    </div>
    
    
	<div class="form-group">
		<div class="col-xs-offset-2 col-xs-10">
			{!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
		</div>
	</div>

	{!! Form::close() !!}

</div>