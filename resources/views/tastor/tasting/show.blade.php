@extends('layouts')

@section('content')
<tastor-show></tastor-show>
<input type="hidden" id="userId" value="{{auth()->user()->id}}">
@endsection