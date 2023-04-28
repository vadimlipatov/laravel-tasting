@extends('layouts')

@section('content')
<div class="row tasting-show">
  <div class="col-12">
    <h1 class="header text-center">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->created_at)->format('d.m.Y') }}</h1>

    <div class="products-list">

      @foreach($products as $product)
      <div class="admin-card">
        <div class="d-flex">
          <div class="image">
            <a data-fancybox href="#hidden_{{$product->id}}">
              @if($product->image)
              <img src="{{ asset('storage/' . $product->image) }}" alt="food_image">
              @else
              <img src="{{asset('/img/no-food.jpg')}}" alt="food">
              @endif
            </a>
          </div>
          <div class="description">
            <p>Продукция:</p>
            <p><a href="{{route('admin.tasting.product.show', [$tasting->id, $product->id])}}" class="">{{$product->title}} ({{$product->description}})</a></p>
          </div>
        </div>
        <div class="footer d-flex justify-content-between">
          @if(round($product->ratings->where('tasting_id', $tasting->id)->avg('average'),2))
          <p>Средний бал: <span>{{round($product->ratings->where('tasting_id', $tasting->id)->avg('average'),2)}}</span></p>
          @else
          <p><span>Нет оценки</span></p>
          @endif
          <p>Дата голосования:
            @if($product->ratings->last())
            <span>{{ Carbon\Carbon::parse($product->ratings->last()->created_at)->format('d.m.Y H:i') }}</span>
            @else
            <span>отсутсвует</span>
            @endif
          </p>
        </div>
      </div>

      <div style="display: none; width: 500px;" id="hidden_{{$product->id}}">
        <h2>Выберите изображение</h2>
        <form action="{{route('admin.image.store', [$tasting->id, $product->id])}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Выберите изображение</label>
          </div>
          <button class="form-btn btn-send form-btn-red w-50 mt-3" type="submit">Добавить</button>
        </form>
        @error('image')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      @endforeach

    </div>
    <div class="add d-flex align-content-center">
      <a data-fancybox href="#hidden">+ Добавить продукцию</a>
    </div>

    <div style="display: none; width: 500px;" id="hidden">
      <h2 class="mb-3">Добавить продукцию</h2>
      <form method="post" action="{{route('admin.product-tasting.store', $tasting->id)}}">
        @csrf
        <div class="form-group">
          <select class="select2" multiple="multiple" data-placeholder="Выберите продукцию" name="products[]" style="width: 100%;">
            @foreach($allProducts as $product)
            <option value="{{$product->id}}">{{$product->title}} ({{$product->description}})</option>
            @endforeach
          </select>
        </div>
        <button class="form-btn form-btn-red w-50" type="submit">Добавить</button>
      </form>
    </div>
  </div>

  @if($tasting->status)
  <div class="">
    <form method="post" action="{{route('admin.tasting.close', $tasting->id)}}">
      @csrf
      @method('patch')
      <button type="submit" class="form-btn form-btn-red">
        Завершить дегустацию
      </button>
    </form>
  </div>
  @endif
</div>


@endsection