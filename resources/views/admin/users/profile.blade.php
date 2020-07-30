@extends('layouts.dashboard')

@section('content')

<div class="container font-montserrat text-sm ">
   <div class="w-1/2 mx-auto mt-10 flex justify-center">

    <img src="{{asset('$data->photo')}}" class="w-32  h-32 rounded-full mr-4" alt="">
    <div>
        <h1>{{$data->name}}</h1>
        <p>{{$data->role}}</p>
        <p>Tel: {{$data->phone}}</p>
        <p>Dir:{{$data->address}}</p>
        <p>email: {{$data->email}}</p>
    </div>
   </div>
</div>
@endsection
