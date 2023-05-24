@extends('layouts')

@section('content')
<div class="row tasting-show">
  <div class="col-12">
    <h1 class="header text-center">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->format('d.m.Y') }}</h1>

    <div class="products-list">
      @if(count($products))
      @foreach($products as $product)
      <div class="admin-card">
        <div class="d-flex">
          <div class="image">
            @if($product->images->where('tasting_id', $tasting->id)->count())
            <img src="{{ asset('storage/' . $product->images->where('tasting_id', $tasting->id)->first()->image) }}" alt="food">
            @else
            <img src="{{ asset('img/no-food.jpg')}}" alt="no-food">
            @endif
          </div>
          <div class="description">
            <p>Продукция:</p>
            <p>
              @if($tasting->status)
              <a href="{{route('tastor.tasting.show', [$tasting->id,$product['id']])}}" class="">{{$product['title']}} {{$product['description']}}</a>
              @else
              {{$product['title']}} {{$product['description']}}
              @endif
            </p>
          </div>
        </div>
        <div class="footer d-flex justify-content-between">
          @if( $product->ratings->where('tasting_id', $tasting->id)->avg('average') )
          <p>Средний бал: <span>{{round($product->ratings->where('tasting_id', $tasting->id)->avg('average'),2)}}</span></p>
          @else
          <p><span>Нет оценки</span></p>
          @endif
          <p>Дата голосования: <span>{{ Carbon\Carbon::parse($product['created_at'])->tz(my_local())->format('d.m.Y H:i') }}</span></p>
        </div>
      </div>
      @endforeach
      @else
      <p class="text-center mt-3">Товары для дегустации отсутствуют</p>
      @endif
    </div>

  </div>
</div>

@endsection
