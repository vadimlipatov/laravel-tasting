@extends('layouts')

@section('content')

<div class="row show-tasting">
  <div class="col-12">
    <div class="active">
      <p class="form-header text-capitalize">Активные дегустации</p>
      @foreach($activeTastings as $tasting)
      <div class="admin-card d-flex justify-content-between">
        <div class="col-12 align-self-center">
          <h3><a href="{{route('tastor.tasting.index', $tasting->id)}}">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->format('d.m.Y') }}</a></h3>
          <p class="activity mb-0">Опрос активен</p>
        </div>
      </div>
      @endforeach
    </div>

    <div class="history">
      <p class="form-header text-capitalize">История дегустаций</p>
      @foreach($closeTastings as $tasting)
      <div class="admin-card d-flex justify-content-between">
        <div class="col-12 align-self-center">
          <h3><a href="{{route('tastor.tasting.index', $tasting->id)}}">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->format('d.m.Y') }}</a></h3>
          <p class="activity mb-0">Итоги подведены</p>
        </div>
      </div>
      @endforeach

    </div>

  </div>


</div>

@endsection