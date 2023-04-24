@extends('layouts')

@section('content')
<div class="row admin-product-tasting-show">
  <div class="col-12 d-flex flex-column justify-content-between">
    <div>
      <div class="d-flex justify-content-between">
        <div class="product-show-title">
          <h1 class="text-capitalize">Дегустация от 28.10.2022 (Mock)</h1>
          <p class="activity">Продукция:</p>
          <p class="product">Котлеты №1. Сытные (Эксперимент)</p>
        </div>
        <div class="product-rate-score align-self-center"> 4.69</div>
      </div>
      <div class="image">
        <img src="{{asset('/img/food1.jpg')}}" alt="food">
      </div>
      <div class="voted">
        <p class="voted-title">Проголосовали</p>
        <div class="admin-card">
          <div class="header d-flex mb-0 justify-content-between">
            <p class="title">Иванов Иван Иванович</p>
            <p class="rate mb-0">4.63</p>
          </div>
          <div class="rating d-flex justify-content-between">
            <div class="rating-item">
              <p class="rating-header">Тов. вид</p>
              <p class="rate">4.63</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Внеш. вид</p>
              <p class="rate">4.63</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Разрез</p>
              <p class="rate">4.63</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Цвет</p>
              <p class="rate">4.63</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Вкус</p>
              <p class="rate">4.63</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Запах</p>
              <p class="rate">4.63</p>
            </div>
            <div class="rating-item">
              <p class="rating-header">Консист.</p>
              <p class="rate">4.63</p>
            </div>
          </div>
          <p class="comment"><b>Комментарий:</b> Какой-то комментарий</p>
          <p class="note"><b>Примечание:</b> Чуть суховатые</p>
          <p class="date"><b>Дата голосования:</b> 08.11.2022 16:42</p>
        </div>

      </div>
    </div>

    <a class="share" href="#">Поделиться результатами</a>
  </div>
</div>

@endsection