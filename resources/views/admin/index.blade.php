@extends('layouts')

@section('content')

<div class="row justify-content-center mt-5">
  <div class="col-md-8">
    <div class="admin-home">
      <a href="{{route('admin.tasting.index')}}">
        <button class="form-btn form-btn-grey ">
          Дегустации
        </button>
      </a>
    </div>
    <div class="mt-3">
      <a href="{{route('admin.user.index')}}">
        <button class="form-btn form-btn-grey ">
          Пользователи
        </button>
      </a>
    </div>
    <div class="mt-3">
      <a href="{{route('admin.product.index')}}">
        <button class="form-btn form-btn-grey ">
          Продукция
        </button>
      </a>
    </div>
  </div>
</div>

@endsection