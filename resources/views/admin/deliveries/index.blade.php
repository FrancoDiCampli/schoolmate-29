@extends('layouts.dashboard')

@section('content')


<div class="card md:w-10/12 rounded-sm bg-gray-100 mx-auto mt-6 mb-4 shadow-lg">
    <div class="card-title bg-white w-full p-5 border-b flex items-center justify-between">
        <div>
            <p class="sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold placeholder-gray-700">Tareas de la Clase</p>
            <p class="md:text-md text-sm text-primary-500 font-semibold">{{$subject->name}}</p>
            <p class="md:text-sm text-xs text-primary-400">{{$subject->course->name}}</p>
        </div>
        <div>
        @role('teacher')
        <a href="{{route('teacher')}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>
              </a>
        @else
        <a href="{{route('student')}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>
          </a>
        @endrole
        </div>
    </div>

    <div class="w-auto mx-auto flex items-center justify-between p-5">
        <form action="#" method="POST">
        @csrf
        <div
            class="border border-gray-400 bg-white h-10 rounded-sm py-1 content-center flex items-center">
            <input name="annotation" type="text" class="bg-transparent focus:outline-none w-full text-sm p-2 text-gray-800" placeholder="Buscar...">
            <button type="submit" class="text-teal-600 font-semibold p-2 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 0 136 136.219"  class="h-5 w-5 svg-inline--fa fa-info fa-w-6"><path d="M93.148 80.832c16.352-23.09 10.883-55.062-12.207-71.41S25.88-1.461 9.531 21.632C-6.816 44.723-1.352 76.693 21.742 93.04a51.226 51.226 0 0055.653 2.3l37.77 37.544c4.077 4.293 10.862 4.465 15.155.387 4.293-4.075 4.465-10.86.39-15.153a9.21 9.21 0 00-.39-.39zm-41.84 3.5c-18.245.004-33.038-14.777-33.05-33.023-.004-18.246 14.777-33.04 33.027-33.047 18.223-.008 33.008 14.75 33.043 32.972.031 18.25-14.742 33.067-32.996 33.098h-.023zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#374957"/></svg>
            </button>
        </div>
    </form>

    @role('teacher')
    <a href="{{route('jobs.create', $subject->id)}}" class="hidden md:block btn btn-primary md:m-0 m-3">Nueva Tarea</a>
        <a href="{{route('jobs.create', $subject->id)}}" class="flex md:hidden btn-primary md:m-0 m-3 p-1">
            <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
            </svg>
        </a>
    @endrole
    </div>
</div>


<div class="mb-8">
@if(count($deliveries) > 0)
@foreach ($deliveries as $delivery)
    <div class="card my-2 md:w-10/12 bg-white shadow-lg p-3 rounded-sm mx-auto border-l-2 border-primary-400">
        <div class=" w-full flex relative items-center ">
            <div class="p-2 w-10 h-10 rounded-full object-cover mr-4 shadow bg-primary-400 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6"><path d="M4 6.75A4.756 4.756 0 018.75 2h9.133a2.745 2.745 0 00-2.633-2H3.75A2.752 2.752 0 001 2.75v15.5A2.752 2.752 0 003.75 21H4z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/><path d="M20.25 4H8.75A2.752 2.752 0 006 6.75v14.5A2.752 2.752 0 008.75 24h11.5A2.752 2.752 0 0023 21.25V6.75A2.752 2.752 0 0020.25 4zm-2 17h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-4h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-3.5h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-4h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/></svg>
            </div>

            @role('student')
            <div class="w-auto md:w-6/12">
                <a href="{{route('deliver', $delivery->job->id)}}">
                    <p class="md:text-md text-sm font-semibold text-gray-900 -mt-1 md:pt-0 pt-2 hover:text-primary-400">{{$delivery->job->title}} </p>
                </a>
                <p class="text-gray-700 font-light text-xs">Fecha limite: {{$delivery->job->end->format('d-m-Y')}} </p>
            </div>
            @else
            <div class="w-auto md:w-6/12">
                <a href="{{route('jobs.showJob', $job->id)}}">
                    <p class="md:text-md text-sm font-semibold text-gray-900 -mt-1 md:pt-0 pt-2 hover:text-primary-400">{{$delivery->job->title}} </p>
                </a>
                <p class="text-gray-700 font-light text-xs">Fecha limite: {{$delivery->job->end->format('d-m-Y')}} </p>
            </div>
            @endrole

            <div class="md:w-6/12 text-right mr-3 text-xs md:text-base">

                    @switch($delivery->state($delivery->state))
                        @case("En corrección")
                        <span class="bg-gray-200 py-1 px-2 rounded-full text-gray-800">{{$delivery->state($delivery->state)}}</span>
                            @break

                        @case("Aprobado")
                        <span class="bg-green-200 py-1 px-2 rounded-full text-green-800">{{$delivery->state($delivery->state)}}</span>
                            @break

                        @case("Aprobado")
                        <span class="bg-orange-200 py-1 px-2 rounded-full text-orange-800">{{$delivery->state($delivery->state)}}</span>
                            @break

                        @case("Rehacer")
                        <span class="bg-red-200 py-1 px-2 rounded-full text-red-800">{{$delivery->state($delivery->state)}}</span>
                            @break

                        @default
                    @endswitch
            </div>

        </div>
    </div>
@endforeach

@else
<div class="card md:w-10/12 rounded-sm bg-gray-100 mx-auto mt-6 mb-4 shadow-lg">
    <div class="alert flex flex-row items-center bg-blue-100 p-5 rounded border-b-2 border-blue-300">
        <div class="alert-icon flex items-center bg-blue-100 border-2 border-blue-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
            <span class="text-blue-500">
                <svg fill="currentColor"
                    viewBox="0 0 20 20"
                    class="h-6 w-6">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        </div>
        <div class="alert-content ml-4">
            <div class="alert-title font-semibold text-lg text-blue-800">
                Información
            </div>
            <div class="alert-description text-sm text-blue-600">
                Aún no hay tareas asignadas!
            </div>
        </div>
    </div>
</div>
@endif
</div>





@push('js')
<script>
    let fm = document.getElementById('float-menu')
    let oo = document.getElementById('orderOption')

    let bt = document.getElementsByClassName('btn')

    Array.from(bt).forEach(function(element) {
    element.addEventListener('click', setOrder);
    });

    function setOrder(){
        let attribute = this.getAttribute("data-order");

        document.getElementById('topic').innerHTML = attribute

    }

    function toogleFm(){
        fm.classList.toggle('hidden')

    }
    function toogleOrder(){
        oo.classList.toggle('hidden')

    }


</script>
@endpush


@endsection
