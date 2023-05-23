@extends('layouts')

@section('content')
<div class="register">
  <div class="row">
    <div class="col-12">
      <h1 class="form-header mb-3 text-center">ДОБАВИТЬ Дегустацию</h1>
      <form method="POST" action="{{ route('admin.tasting.store') }}">
        @csrf

        <div class="mb-3">
          <input type="text" class="form-input @error('title') is-invalid @enderror" name="title" value="Дегустация" required autocomplete="title" autofocus placeholder="Название" class="form-input">
          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mb-3">
          <input type="date" class="form-input @error('date') is-invalid @enderror" name="date" value="<?php echo date('Y-m-d'); ?>" required autocomplete="date" autofocus placeholder="Дата проведения" class="form-input">
          @error('date')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-3">
          <select class="form-select" name="status" required>
            <option value="" disabled selected>Статус дегустации</option>
            <option value="0">Не активная</option>
            <option value="1">Активная</option>
          </select>
          @error('status')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
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
