@extends ('layout')
@section('content')
<h1>Users</h1>
<div class="container">
  <div class="card mb-3 w-75 mx-auto">
    <img src="{{url('uploads/'.$user->image)}}" class="card-img-top" alt="...">
    <hr>
    <div class="card-body">
      <h5 class="card-title">name: {{$user->name}}</h5>
      <p class="card-text">email: {{$user->email}}</p>
      <p class="card-text">phone: 0{{$user->phone}}</p>
      @if ($user->identification_verified_at != null)
      <p class="card-text">identification: yes</p>
      @else
      <p class="card-text">identification: no</p>
      @endif
      <p class="card-text"><small class="text-body-secondary">the date of join: {{$user->created_at->formatLocalized('%d %B %Y')}}</small></p>
    </div>
  </div>
</div>
@endsection