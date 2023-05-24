@extends('layouts')

@section('content')
<div class="row admin-tasting-product-show">
  <div class="col-12 d-flex flex-column justify-content-between">
    <div>
      <div class="d-flex justify-content-between">
        <div class="product-show-title">
          <h1 class="">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->tz(my_local())->format('d.m.Y') }}</h1>
          <p class="activity">Продукция:</p>
          @if($product->description)
          <p class="product">{{$product->title}} ({{$product->description}})</p>
          @else
          <p class="product">{{$product->title}}</p>
          @endif
        </div>
        <div class="product-rate-score align-self-center">{{number_format($average,1)}}</div>
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
        @if($rates->count())
        <p class="voted-title">Проголосовали</p>
        @foreach($rates as $rate)
        <div class="admin-card">
          <div class="header d-flex mb-0 justify-content-between">
            <p class="title">{{$rate->user()->name}}</p>
            <p class="rate mb-0">{{number_format($rate->average, 1)}}</p>
          </div>
          <div class="rating d-flex justify-content-between">
            <div class="rating-item">
              <p class="rating-header">Тов. вид</p>
              <p class="rate">{{number_format($rate->commercial, 1)}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Внеш. вид</p>
              <p class="rate">{{number_format($rate->appearance, 1)}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Разрез</p>
              <p class="rate">{{number_format($rate->cut, 1)}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Цвет</p>
              <p class="rate">{{number_format($rate->color, 1)}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Вкус</p>
              <p class="rate">{{number_format($rate->taste, 1)}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Запах</p>
              <p class="rate">{{number_format($rate->smell, 1)}}</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Консист.</p>
              <p class="rate">{{number_format($rate->consistency, 1)}}</p>
            </div>
          </div>
          <p class="comment"><b>Комментарий: </b>{{$rate->comment}}</p>
          <p class="note"><b>Примечание: </b>{{$rate->note}}</p>
          <p class="date"><b>Дата голосования: </b>{{ Carbon\Carbon::parse($rate->created_at)->tz(my_local())->format('d.m.Y H:i') }}</p>
        </div>
        @endforeach
        @else
        <p class="voted-title">Нет голосов...</p>
        @endif
      </div>
      @if($tasting->status)
      <div class="rates-btn">
        <a href="{{route('tastor.tasting.show', [$tasting->id, $product->id])}}">Голосовать</a>
      </div>
      @endif
    </div>

    <a class="share form-btn-red data-share" href="#" data-title="{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->tz(my_local())->format('d.m.Y') }}" data-text="{{$product->title}} ({{$product->description}}) - {{$average}} {{$persons}}" data-url="{{url()->current()}}">Поделиться результатами</a>

  </div>
</div>

@endsection
