@extends('layouts')

@section('content')
<div class="row admin-tasting-product-show">
  <div class="col-12 d-flex flex-column justify-content-between">
    <div>
      <div class="d-flex justify-content-between">
        <div class="product-show-title">
          <h1 class="">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->format('d.m.Y') }}</h1>
          <p class="activity">Продукция:</p>
          <p class="product">{{$product->title}} ({{$product->description}})</p>
        </div>
        <div class="product-rate-score align-self-center">{{$average}}</div>
      </div>
      <div class="images">
        @foreach($images as $image)
        <div class="image">
          <a href="{{ asset('storage/' . $image->image) }}" data-fancybox="gallery">
            <img src=" {{ asset('storage/' . $image->image) }}" alt="food">
          </a>
        </div>
        @endforeach
      </div>
      <div class="voted">
        @if(count($rates))
        <p class="voted-title">Проголосовали</p>
        @foreach($rates as $rate)
        <div class="admin-card">
          <div class="header d-flex mb-0 justify-content-between">
            <p class="title">{{$rate->name}}</p>
            <p class="rate mb-0">{{$rate->average}}</p>
          </div>
          <div class="rating d-flex justify-content-between">
            <div class="rating-item">
              <p class="rating-header">Тов. вид</p>
              <p class="rate">{{number_format(round($rate->commercial, 1), 1, '.', '')}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Внеш. вид</p>
              <p class="rate">{{number_format(round($rate->appearance, 1), 1, '.', '')}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Разрез</p>
              <p class="rate">{{number_format(round($rate->cut, 1), 1, '.', '')}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Цвет</p>
              <p class="rate">{{number_format(round($rate->color, 1), 1, '.', '')}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Вкус</p>
              <p class="rate">{{number_format(round($rate->taste, 1), 1, '.', '')}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Запах</p>
              <p class="rate">{{number_format(round($rate->smell, 1), 1, '.', '')}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Консист.</p>
              <p class="rate">{{number_format(round($rate->consistency, 1), 1, '.', '')}}</p>
            </div>
          </div>
          <p class="comment"><b>Комментарий: </b>{{$rate->comment}}</p>
          <p class="note"><b>Примечание: </b>{{$rate->note}}</p>
          <p class="date"><b>Дата голосования: </b>{{ Carbon\Carbon::parse($rate->created_at)->format('d.m.Y H:i') }}</p>
        </div>
        @endforeach
        @else
        <p class="voted-title">Нет голосов...</p>
        @endif
      </div>
    </div>

    <a class="share data-share" href="#" data-title="{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->format('d.m.Y') }}" data-text="{{$product->title}} ({{$product->description}}) - {{$average}} {{$persons}}" data-url="{{url()->current()}}">Поделиться результатами</a>

  </div>
</div>

@endsection