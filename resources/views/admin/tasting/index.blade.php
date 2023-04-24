@extends('layouts')

@section('content')
<div class="row show-tasting">
  <div class="col-12">

    <div class="active">
      <p class="form-header text-capitalize">Активные дегустации</p>
      @foreach($activeTastings as $tasting)
      <div class="col-12 admin-card d-flex justify-content-between">
        <div class="align-self-center">
          <h3><a href="{{route('admin.tasting.show', $tasting->id)}}">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->format('d.m.Y') }}</a></h3>
          <p class="activity mb-0">Опрос активен</p>
        </div>

        @if (!$tasting->ratings->count())
        <div class="delete d-flex">
          <form method="post" action="{{route('admin.tasting.delete', $tasting->id)}}">
            @csrf
            @method('delete')
            <button type="submit" class="border-0 bg-transparent p-0 m-0">
              <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
            </button>
          </form>
        </div>
        @else
        <div class="delete d-flex">
          <a data-fancybox href="#hidden">
            <button type="submit" class="border-0 bg-transparent p-0 m-0">
              <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
            </button>
          </a>
        </div>
        @endif

      </div>
      @endforeach
    </div>

    <div class="history">
      <p class="form-header text-capitalize">История дегустаций</p>
      @foreach($finishTastings as $tasting)
      <div class="admin-card col-12 d-flex justify-content-between">
        <div class="align-self-center">
          <h3><a href="{{route('admin.tasting.show', $tasting->id)}}">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->format('d.m.Y') }}</a></h3>
          <p class="activity mb-0">Итоги подведены</p>
        </div>
        @if (!$tasting->ratings->count())
        <div class="delete">
          <form method="post" action="{{route('admin.tasting.delete', $tasting->id)}}">
            @csrf
            @method('delete')
            <button type="submit" class="border-0 bg-transparent p-0 m-0">
              <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
            </button>
          </form>
        </div>
        @else
        <div class="delete d-flex">
          <a data-fancybox href="#hidden">
            <button type="submit" class="border-0 bg-transparent p-0 m-0">
              <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
            </button>
          </a>
        </div>
        @endif
      </div>
      @endforeach
    </div>

  </div>
  <div class="col-12 add">
    <a href="{{route('admin.tasting.create')}}">
      <button class="form-btn form-btn-red ">
        ДОБАВИТЬ Дегустацию
      </button>
    </a>
  </div>

</div>

<div style="display: none; width: 500px;" id="hidden">
  <h2>Дегустацию нельзя удалить тк есть оценки</h2>
</div>
@endsection
