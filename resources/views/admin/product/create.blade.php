@extends('layouts')

@section('content')
<div class="register">
  <div class="row">
    <div class="col-12">
      <h1 class="form-header mb-3 text-center">ДОБАВИТЬ Продукцию</h1>
      <form method="POST" action="{{ route('admin.product.store') }}">
        @csrf

        <div class="mb-3">
          <input type="text" class="form-input @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="Название" class="form-input">
          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-3">
          <input type="text" class="form-input @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus placeholder="Описание" class="form-input">
        </div>

        <div class="mb-3">
          <input type="text" onfocus="(this.type='date')" class="form-input @error('manufacturing_at') is-invalid @enderror" name="manufacturing_at" value="{{ old('manufacturing_at') }}" autocomplete="manufacturing_at" autofocus placeholder="Дата производства" class="form-input">
          @error('manufacturing_at')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-3">
          <input type="text" class="form-input @error('technologist') is-invalid @enderror" name="technologist" value="{{ old('technologist') }}" autocomplete="technologist" autofocus placeholder="ФИО технолога" class="form-input">
        </div>

        <div class="mb-3">
          <input type="text" class="form-input @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" autocomplete="company" autofocus placeholder="Компания" class="form-input">
        </div>

        <div class="">
          <button type="submit" class="form-btn form-btn-red">
            Создать
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
