@extends('layouts.dashboard')

@section('content')

{{-- Vista nueva --}}
<div class="card md:w-10/12 rounded-sm bg-gray-100 mx-auto mt-6 mb-4 shadow-lg">
    <div class="card-title bg-white w-full p-5 border-b flex items-center justify-between">
        <div>
            <p class="sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold placeholder-gray-700">Tareas Pendientes</p>
            <p class="md:text-md text-sm text-primary-500 font-semibold">{{$jobs->name}}</p>
            <p class="md:text-sm text-xs text-primary-400">{{$jobs->course->name}}</p>
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
        <form action="{{route('searchJobs')}}" method="POST">
        @csrf
        <div
            class="border border-gray-400 bg-white h-10 rounded-sm py-1 content-center flex items-center">
            <input type="text" hidden name="subjectID" id="" value="{{$jobs->id}}">
            <input name="search" type="text" class="bg-transparent focus:outline-none w-full text-sm p-2 text-gray-800" placeholder="Buscar...">
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
    @if(count($jobs->pendientes())>0)
    @foreach ($jobs->pendientes() ?? [] as $job)
        <div class="card my-2 md:w-10/12 bg-white shadow-lg p-3 rounded-sm mx-auto border-l-2 border-primary-400">
            <div class=" w-full flex relative items-center ">
                <div class="p-2 w-10 h-10 rounded-full object-cover mr-4 shadow bg-primary-400 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6"><path d="M4 6.75A4.756 4.756 0 018.75 2h9.133a2.745 2.745 0 00-2.633-2H3.75A2.752 2.752 0 001 2.75v15.5A2.752 2.752 0 003.75 21H4z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/><path d="M20.25 4H8.75A2.752 2.752 0 006 6.75v14.5A2.752 2.752 0 008.75 24h11.5A2.752 2.752 0 0023 21.25V6.75A2.752 2.752 0 0020.25 4zm-2 17h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-4h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-3.5h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-4h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/></svg>
                </div>


                <div class="w-auto md:w-6/12">
                    <a href="{{route('deliver', $job->id)}}">
                        <p class="md:text-md text-sm font-semibold text-gray-900 -mt-1 md:pt-0 pt-2 hover:text-primary-400">{{$job->title}} </p>
                    </a>
                    <p class="text-gray-700 font-light text-xs">Fecha limite: {{$job->end->format('d-m-Y')}} </p>
                </div>

                @php
                    $diff = \Carbon\Carbon::parse($job->end)->diffInDays($now, false)
                @endphp
                <div class="w-auto md:w-6/12 text-right mr-2 flex items-center justify-end">
                    @if ($diff == 0)
                    <svg aria-hidden="true" data-prefix="fas" data-icon="exclamation-circle" class="w-5 h-5 ml-4 md:ml-none text-orange-600 svg-inline--fa fa-exclamation-circle fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"/></svg>
                    <p class="hidden md:block text-orange-600 font-light text-md ml-2">Vence hoy </p>
                    @elseif($diff > 0)
                    <svg aria-hidden="true" data-prefix="far" data-icon="clock" class="w-5 h-5 ml-4 md:ml-none text-red-600 svg-inline--fa fa-clock fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg>
                    <p class="hidden md:block text-red-600 font-light text-md ml-2">Atrasada </p>
                    @endif
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



    {{-- cards viejo --}}
    {{-- <div class="flex flex-wrap">

        @foreach ($jobs->pendientes() ?? [] as $job)
             <div class="mx-2 text-white card bg-gradient-green rounded-sm font-montserrat w-5/12 flex p-5 justify-between mt-5 items-center">
                <div>
                    <a href="{{route('jobs.descargar', $job->file_path)}}">
                        <svg aria-hidden="true" data-prefix="fas" data-icon="file-download"
                            class="h-12 w-12 svg-inline--fa fa-file-download fa-w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm76.45 211.36l-96.42 95.7c-6.65 6.61-17.39 6.61-24.04 0l-96.42-95.7C73.42 337.29 80.54 320 94.82 320H160v-80c0-8.84 7.16-16 16-16h32c8.84 0 16 7.16 16 16v80h65.18c14.28 0 21.4 17.29 11.27 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z"/></svg>

                    </a>
                </div>
                <div>
                    <h1 class="text-sm">{{$job->title}}</h1>
                    <a href="{{route('deliver', $job->id)}}">
                        <span>Entregar</span>
                    </a>
                </div>

            </div>
        @endforeach

    </div> --}}
@endsection
