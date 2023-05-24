@extends('layouts')

@section('content')
<div class="row show-tasting">
  <div class="col-12">

    <div class="active">
      <p class="form-header text-capitalize">Активные дегустации</p>
      @if(count($activeTastings))
      @foreach($activeTastings as $tasting)
      <div class="col-12 admin-card d-flex justify-content-between">
        <div class="align-self-center">
          <h3><a href="{{route('admin.tasting.show', $tasting->id)}}">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->tz(my_local())->format('d.m.Y') }}</a></h3>
          <p class="activity mb-0">Опрос активен</p>
        </div>

        <div class="delete d-flex">
          <a data-fancybox href="#hidden">
            <button type="submit" class="border-0 bg-transparent p-0 m-0">
              <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
            </button>
          </a>
        </div>

      </div>
      @endforeach
      @else
      <p>Дегустации не проводились</p>
      @endif
    </div>

    <div class="history">
      <p class="form-header text-capitalize">История дегустаций</p>
      @if(count($finishTastings))
      @foreach($finishTastings as $tasting)
      <div class="admin-card col-12 d-flex justify-content-between">
        <div class="align-self-center">
          <h3><a href="{{route('admin.tasting.show', $tasting->id)}}">{{$tasting->title}} от {{ Carbon\Carbon::parse($tasting->date)->tz(my_local())->format('d.m.Y') }}</a></h3>
          <p class="activity mb-0">Итоги подведены</p>
        </div>

        <div class="delete d-flex">
          <a data-fancybox href="#hidden">
            <button type="submit" class="border-0 bg-transparent p-0 m-0">
              <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
            </button>
          </a>
        </div>
      </div>
      @endforeach
      @else
      <p>Дегустации не проводились</p>
      @endif
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
@if(count($activeTastings) || count($finishTastings))
<div style="display: none; width: 500px;" id="hidden">
  <h2>Вы действительно хотите удалить дегустацию?</h2>
  <div class="flex justify-content-evenly mt-4" style="display: flex">
    <form method="post" class="w-25" action="{{route('admin.tasting.delete', $tasting->id)}}">
      @csrf
      @method('delete')
      <button type="submit" class="form-btn text-red">
        Да
      </button>
    </form>
    <button data-fancybox-close class="form-btn w-25 red">НЕТ</button>
  </div>
</div>
@endif
@endsection
