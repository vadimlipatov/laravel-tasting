@extends('layouts')

@section('content')
<div class="container mt-4">
  <!-- <div class="card"> -->
  <div class="card-header text-center mb-4">
    <h2>Ваш QR Code</h2>
  </div>
  <div class="card-body text-center">
    {!!QrCode::size(250)
    ->style('dot')
    ->eye('circle')
    ->color(166, 48, 57)
    ->margin(1)
    ->generate($message) !!}
  </div>
  <!-- </div> -->
  <!-- <div class="card">
  <div class="card-header">
    <h2>Color QR Code</h2>
  </div>
  <div class="card-body">
    {!! QrCode::size(300)->backgroundColor(255,90,0)->generate('RemoteStack') !!}
  </div>
  </div> -->
</div>

@endsection