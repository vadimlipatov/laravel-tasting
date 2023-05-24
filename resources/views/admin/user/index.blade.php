@extends('layouts')

@section('content')
<div class="row admin-users-index d-flex flex-column justify-content-between">
  <div class="col-12">
    <h1 class="text-center">СПИСОК ПОЛЬЗОВАТЕЛЕЙ</h1>

    <div class="link text-center">
      <a href="#">Настройка прав доступа</a>
    </div>
    @foreach($users as $user)
    <div class="admin-card d-flex justify-content-between">
      <div class="">
        <h3><a href="{{route('admin.user.show', $user['id'])}}">{{$user->name}}</a></h3>
        <p class="activity">Последняя активность:
          @if($user->lastActivityDate)
          {{$user->lastActivityDate}}
          @else
          нет
          @endif
        </p>
        <p class="access mb-0">Доступ: <span>{{$user->getRoles()[$user->role]}}</span></p>
      </div>
      <div class="delete d-flex">
        <form method="post" action="{{route('admin.user.delete', $user->id)}}">
          @csrf
          @method('delete')
          <button type="submit" class="border-0 bg-transparent p-0 m-0">
            <img src="{{asset('/img/close.svg')}}" alt="delete_btn">
          </button>
        </form>
      </div>
    </div>
    @endforeach
  </div>


  <div class="col-12">
    <a href="{{route('admin.user.add')}}">
      <button class="form-btn form-btn-red ">
        ДОБАВИТЬ ПОЛЬЗОВАТЕЛЯ
      </button>
    </a>
  </div>
</div>

@endsection
