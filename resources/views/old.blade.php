<!-- <div class="row admin-user-show">
  <div class="col-12">
    <p class="header text-capitalize">{{$user->name}}</h>
    <p class="activity">Последняя активность: {{$lastActivityDate}}</p>

    <p class="header">Поиск</p>

    <div class="filter">
      <div class="search">
        <input placeholder="Название продукции / дегустации" type="text" class="w-100" name="search" id="search">
      </div>
      <input class="data" placeholder="Дата “от”" type="text" name="date_from">
      <input class="data" placeholder="Дата “до”" type="text" name="date_to">
    </div>

    <p class="header-story">История дегустаций</p>
    @foreach($products as $product)
    <div class="admin-card">
      <div class="header d-flex justify-content-between">
        <p class="title">{{$product->title}} ({{$product->description}})</p>
        <p class="rate">{{$product->average}}</p>
      </div>
      <div class="rating d-flex justify-content-between">
        <div class="rating-item">
          <p class="rating-header">Тов. вид</p>
          <p class="rate">{{$product->commercial}}</p>
        </div>
        <div class="rating-item">
          <p class="rating-header">Внеш. вид</p>
          <p class="rate">{{$product->appearance}}</p>
        </div>
        <div class="rating-item">
          <p class="rating-header">Разрез</p>
          <p class="rate">{{$product->cut}}</p>
        </div>
        <div class="rating-item">
          <p class="rating-header">Цвет</p>
          <p class="rate">{{$product->color}}</p>
        </div>
        <div class="rating-item">
          <p class="rating-header">Вкус</p>
          <p class="rate">{{$product->taste}}</p>
        </div>
        <div class="rating-item">
          <p class="rating-header">Запах</p>
          <p class="rate">{{$product->smell}}</p>
        </div>
        <div class="rating-item">
          <p class="rating-header">Консист.</p>
          <p class="rate">{{$product->consistency}}</p>
        </div>
      </div>
      <div class="comment">
        <p class=""><b>Комментарий:</b> {{$product->comment}}</p>
        <p class=""><b>Примечание:</b> {{$product->note}}</p>
      </div>
      <div class="date">
        <p class=""><b>Дата голосования:</b> {{ Carbon\Carbon::parse($product->created_at)->format('d.m.Y H:i') }}</p>
        <p class=""><b>Дегустация:</b><span> Дегустация от {{ Carbon\Carbon::parse($product->date)->format('d.m.Y') }}</span></p>
      </div>
    </div>
    @endforeach
    <!-- <div class="admin-card admin-card-short d-flex justify-content-between">
      <div class="admin-card-short-body">
        <p class="admin-card-short-header">Котлеты №1. Сытные (Эксперимент)</p>
        <div class="date">
          <p class="">Дата голосования: 08.11.2022 16:42</p>
          <p class="">Дегустация:<span> Дегустация от 07.11.2022</span></p>
        </div>
      </div>
      <div class="rate">
        4.69
      </div>
    </div> -->

</div>
</div> -->

<div class="row admin-show-products">
  <div class="col-12">
    <h1 class="form-header text-center">СПИСОК ПРОДУКЦИИ</h1>

    <p class="header">Поиск</p>

    <div class="filter search">
      <input placeholder="Название продукции" type="text" class="w-100" name="search" id="search">
    </div>
    @foreach($products as $product)
    <div class="admin-card d-flex justify-content-between">
      <div class="align-self-center">
        <h3><a href="{{route('admin.product.show', $product['id'])}}">{{$product['title']}} ({{$product['description']}})</a></h3>
        <p class="activity mb-0">Последняя дегустация: {{$product['lastActivityDate']}}</p>
      </div>
      <div class="delete align-self-center">
        <form method="post" action="{{route('admin.product.delete', $product['id'])}}">
          @csrf
          @method('delete')
          <button type="submit" class="border-0 bg-transparent delete-btn">
            <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
          </button>
        </form>
      </div>
    </div>

    <div class="row admin-product-show">
      <div class="col-12">
        <div class="product-show-title d-flex justify-content-between">
          <div class="product-rate-description">
            <h1 class="text-capitalize">{{$product->title}} ({{$product->description}})</h1>
            <p class="activity">Последняя дегустация: {{ Carbon\Carbon::parse($lastTastingDate)->format('d.m.Y') }}</p>
          </div>
          <div class="product-rate-score align-self-center">
            {{$average}}
          </div>
        </div>
        <div>
        </div>

        <div class="filter">
          <p class="header">Поиск</p>
          <input class="" placeholder="Дата “от”" type="text" name="search" id="search">
          <input class="" placeholder="Дата “до”" type="text" name="search" id="search">
        </div>

        <div class="history">
          <p class="header">История дегустаций</p>
          @foreach($tastings as $tasting)
          <div class="admin-card">
            <div class="header d-flex mb-0 justify-content-between">
              <p class="title">
                <a href="#">{{$tasting['title']}} от {{ Carbon\Carbon::parse($tasting['date'])->format('d.m.Y') }}</a>
              </p>
              <p class="rate mb-0">{{$tasting['average']}}</p>
            </div>
            <div class="rating d-flex justify-content-between">
              <div class="rating-item">
                <p class="rating-header">Тов. вид</p>
                <p class="rate">{{$tasting['commercial']}}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Внеш. вид</p>
                <p class="rate">{{$tasting['appearance']}}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Разрез</p>
                <p class="rate">{{$tasting['cut']}}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Цвет</p>
                <p class="rate">{{$tasting['color']}}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Вкус</p>
                <p class="rate">{{$tasting['taste']}}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Запах</p>
                <p class="rate">{{$tasting['smell']}}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Консист.</p>
                <p class="rate">{{$tasting['consistency']}}</p>
              </div>
            </div>
            <p class="persons">
              Участников дегустации: {{$tasting['peopleCount']}}
            </p>
          </div>
          @endforeach
        </div>

      </div>
    </div>

    <!-- <div class="row">
  <div class="col-12 tasting-product-show">
    <p class="">Продукция:</p>
    <p class="">{{$product->title}}</p>
    <div class="images">
      @foreach($images as $image)
      <a href="{{ asset('storage/' . $image->image) }}" data-fancybox="gallery">
        <img src=" {{ asset('storage/' . $image->image) }}" alt="food">
      </a>
      @endforeach
    </div>

    <form method="POST" action="{{route('tastor.tasting.create', [$tasting->id, $product->id])}}">
      @csrf
      <div class="rating">
        <p class="rating-title">Товарный вид</p>
        <div class="rating-input">
          <input type="range" step="0.1" min="0" max="5" id="commercial" oninput="commercialHandler()" value="4.6" name="commercial">
          <span id="commercialSpan">4.6</span>
        </div>
      </div>
      <div class="rating">
        <p class="rating-title">Внешний вид</p>
        <div class="rating-input">
          <input type="range" step="0.1" min="0" max="5" id="appearance" oninput="appearanceHandler()" value="4.6" name="appearance">
          <span id="appearanceSpan">4.6</span>
        </div>
      </div>
      <div class="rating">
        <p class="rating-title">На разрезе</p>
        <div class="rating-input">
          <input type="range" step="0.1" min="0" max="5" id="cut" oninput="cutHandler()" value="4.6" name="cut">
          <span id="cutSpan">4.6</span>
        </div>
      </div>
      <div class="rating">
        <p class="rating-title">Цвет</p>
        <div class="rating-input">
          <input type="range" step="0.1" min="0" max="5" id="color" oninput="colorHandler()" value="4.6" name="color">
          <span id="colorSpan">4.6</span>
        </div>
      </div>
      <div class="rating">
        <p class="rating-title">Вкус</p>
        <div class="rating-input">
          <input type="range" step="0.1" min="0" max="5" id="taste" oninput="tasteHandler()" value="4.6" name="taste">
          <span id="tasteSpan">4.6</span>
        </div>
      </div>
      <div class="rating">
        <p class="rating-title">Запах</p>
        <div class="rating-input">
          <input type="range" step="0.1" min="0" max="5" id="smell" oninput="smellHandler()" value="4.6" name="smell">
          <span id="smellSpan">4.6</span>
        </div>
      </div>
      <div class="rating">
        <p class="rating-title">Консистенция</p>
        <div class="rating-input">
          <input type="range" step="0.1" min="0" max="5" id="consistency" oninput="consistencyHandler()" value="4.6" name="consistency">
          <span id="consistencySpan">4.6</span>
        </div>
      </div>

      <div class="comment-form">
        <label for="product-comment">Комментарий:</label>
        <div class="comment">
          <input type="text" class="form-input" name="comment" placeholder="" id="product-comment">
        </div>

        <label for="product-note">Примечание:</label>
        <div class="note">
          <input type="text" class="form-input" name="note" placeholder="" id="product-note">
        </div>

        <button type="submit" class="form-btn form-btn-red">
          Отправить
        </button>
      </div>
    </form>

  </div> -->