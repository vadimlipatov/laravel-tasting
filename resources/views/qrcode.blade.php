@extends('layouts')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header text-center mb-4">
      <h2>PHP QR Code</h2>
    </div>
    <div class="card-body text-center">
      {!!QrCode::size(250)
      ->style('dot')
      ->eye('circle')
      ->color(166, 48, 57)
      ->generate($message) !!}
    </div>
  </div>
  <div class="card">
    <div class="card-header text-center">
      <h2>JS QR Code</h2>
    </div>
    <div class="card-body text-center">
      <div id="qrcode"></div>
    </div>
  </div>

  <script src="{{asset('plugins/qrcode/qrcode.js')}}">
  </script>
  <script>
    const qrcode = new QRCode("qrcode", {
      text: "http://jindo.dev.naver.com/collie",
      width: 250,
      height: 250,
      colorDark: "#000000",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H
    });
  </script>
</div>

@endsection