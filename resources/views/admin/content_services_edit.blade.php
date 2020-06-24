{{-- форма редактирования портфолио --}}
<div class="wrapper container-fluid">
    {!! Form::open(['url' = route('servicesEdit', ['service' => $data['id']]),'class'=>'form-horizontal', 'method' = 'POST', ,'enctype'=>'multipart/form-data']) !!}

    <div class="form-group">
        {!! Form::hidden('id', $data['id']) !!}
         {!! Form::label('name', 'Название:',['class'=>'col-xs-2 control-label']) !!}
         <div class="col-xs-8">
            {!! Form::text('name', $data['name'], ['class' => 'form-control','placeholder'=>'Введите название услуги']) !!}
         </div>
    </div>

    <div class="form-group">
         {!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
         <div class="col-xs-8">
            {!! Form::textarea('text', $data['text'], ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст ']) !!}
         </div>
    </div>

    <div class="form-group">
        {!! Form::label('old_images', 'Изображение:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-offset-2 col-xs-10">
            {!! Html::image('assets/img/'.$data['images'],'',['class'=>'img-circle img-responsive','width'=>'150px']) !!}
            {!! Form::hidden('old_images', $data['images']) !!}
        </div>
    </div>

    <div class="form-group">
         {!! Form::label('images', 'Изображение:',['class'=>'col-xs-2 control-label']) !!}
         <div class="col-xs-8">
            {!! Form::file('images', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
         </div>
    </div>


    {!! Form::close() !!}
</div>