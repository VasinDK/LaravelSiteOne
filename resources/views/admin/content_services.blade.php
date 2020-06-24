<div style="margin:0px 50px 0px 50px;"> 

    {{-- форма вывода услуг --}}

    @if($services)
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Имя</th>
                    <th>text</th>
                    <th>Дата создания</th>
                  {{--   <th>Ссылка</th> --}}
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service -> id }}</td>
                        <td>{!! Html::link(route('servicesEdit', ['service' => $service -> id]), $service -> name, ['alt' => $service -> name]) !!}</td>
                        <td>{!! $service -> text !!}</td>
                        <td>{{ $service -> created_at }}</td>
                        <td>
                            {!! Form::open(['url' => route('servicesEdit', ['service' => $service-> id]), 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Удалить', ['class'=> 'btn btn-danger', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    

                @endforeach
            </tbody>
        </table>
        
        {{-- создание новой услуги --}}    
        {!! Html::link(route('servicesAdd'), 'Новая услуга') !!}

    @endif

</div>    