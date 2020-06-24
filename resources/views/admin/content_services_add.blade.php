<div class = "wrapper container-fluid">
    {{-- форма добавления услуги --}}
{!! Form::open(['url' => route('servicesAdd'), 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class = "form-group">
        {!! Form::label('name', 'Название', ['class' => 'col-xs-2 control-label']) !!}
        <div class = "col-xs-8">
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'введите название ']) !!}
        </div>
    </div>

    <div class="form-group">
         {!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
         <div class="col-xs-8">
            {!! Form::textarea('text', old('text'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст страницы']) !!}
         </div>
    </div>

    <div class="form-group">
         {!! Form::label('images', 'Изображение:',['class'=>'col-xs-2 control-label']) !!}
         <div class="col-xs-8">
            {!! Form::file('images', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"])!!}
         </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>
    </div>


{{ Form::close() }}

{{-- подключение редактора к полю с 'alias' 'editor' --}}
    <script>
        CKEDITOR.replace('editor'); /*editor - передаваемое id поля в котором будет работать CKEDITOR */
    </script>


</div>