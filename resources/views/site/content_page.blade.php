<section>
  <div class="inner_wrapper">
    <div class="container">
      {{-- вывод страницы. Заголовок, текст, ссылку назад --}}
      <h2>{{ $page-> name }}</h2>
      <div class="inner_section">
    <div class="row">
        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">{!! Html::image('assets/img/'.$page->images,'',['class'=>'img-circle delay-03s animated wow zoomIn']) !!}<!-- <img src="{{ asset('assets/img/about-img.jpg') }}" class="img-circle delay-03s animated wow zoomIn" alt=""> --></div>
          <div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
            <div class=" delay-01s animated fadeInDown wow animated">
              {!! $page->text !!}
            </div>
                  
       </div>
          
        </div>
      
        {!! link_to(route('home'), 'Back') !!} {{-- создаем ссылку --}}
      </div>
    </div> 
  </div>
</section>