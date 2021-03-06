@extends('layouts.dashboard')

@section('content')

{{-- card header ciclo --}}
<div class="card md:w-auto rounded-sm bg-gray-100 mt-6 md:m-4 my-4 shadow-md">
    <div class="card-title bg-white w-full p-4 border-b md:flex items-center justify-between">
        <div class="flex items-center">
            <div class="p-2">
                @php
                $anio = session('selectedAnio');
                @endphp

                <form method="POST" action="{{route('setAnio')}}" enctype="multipart/form-data"
                    class="flex items-center" onsubmit="btnSpinCicle.disabled = true;">
                    @csrf
                    <div class="sm:text-lg md:text-md lg:text-md xl:text-md font-semibold flex items-center">
                        <p>Actualizar Ciclo a
                            <select name="selectAnio" id="selectAnio"
                                class="sm:text-lg md:text-md lg:text-md xl:text-md font-semibold focus:border-primary-400 border-b-2 appearance-none focus:outline-none">
                                <option selected value="{{$anio}}">{{$anio}}
                                </option>
                                @foreach ($ciclos ?? [] as $key => $value)
                                @if ($key!=$anio)
                                <option value="{{$key}}">{{$key}}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </p>
                    </div>

                    <button
                        class="btn btn-default rounded hover:bg-gray-200 hover:text-gray-700 mx-1 py-1 px-2 shadow-none border-none"
                        id="btnSpinCicle" onclick="spinCicle()" type="submit">
                        <span>
                            <svg class="h-5 w-6" id="spinCicle" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Nuevo index alumnos --}}
<div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-3">

    @if(count($subjects)>0)
    @foreach ($subjects ??[] as $subject)

    {{-- nuevo card --}}

    <div
        class="w-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl bg-white md:m-4 my-3 font-montserrat border-b-4 border-bluedark-300">
        <div class="flex flex-col min-h-full">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <div class="pb-2 pt-2">
                    <a href="{{route('posts.index', $subject->id)}}">

                        <svg xmlns="http://www.w3.org/2000/svg" height="62" viewBox="0 0 511.997 511.997" width="62">
                            <path
                                d="M226.554 166.843v48.838c0 11.685 12.791 18.746 22.659 12.804l40.542-24.42c9.657-5.819 9.634-19.802-.001-25.606l-40.541-24.419c-9.937-5.986-22.659 1.188-22.659 12.803zm55.384 24.419l-40.385 24.323.002-48.647z"
                                data-original="#000000" class="active-path" data-old_color="#000000" fill="#0E2A3F" />
                            <path
                                d="M275.351 114.867c-4.017-1.022-8.097 1.401-9.119 5.416s1.402 8.097 5.416 9.119c28.363 7.225 48.172 32.662 48.172 61.86 0 35.19-28.63 63.82-63.82 63.82s-63.82-28.63-63.82-63.82c0-29.198 19.809-54.636 48.172-61.86 4.014-1.022 6.438-5.104 5.416-9.119s-5.11-6.438-9.119-5.416c-35.015 8.918-59.469 40.333-59.469 76.396 0 43.462 35.358 78.82 78.82 78.82s78.82-35.358 78.82-78.82c-.001-36.063-24.455-67.478-59.469-76.396z"
                                data-original="#000000" class="active-path" data-old_color="#000000" fill="#0E2A3F" />
                            <path
                                d="M477.692 28.32H34.305C15.389 28.32 0 43.708 0 62.625V319.9c0 18.916 15.389 34.305 34.305 34.305h32.868c-.807 13.721 4.223 26.389 13.008 35.678h-.499c-23.601 0-42.801 19.2-42.801 42.801v34.138c0 9.295 7.562 16.856 16.856 16.856h122.366a16.75 16.75 0 009.355-2.845 16.755 16.755 0 009.356 2.845H317.18c3.46 0 6.677-1.05 9.356-2.845a16.755 16.755 0 009.356 2.845h122.366c9.295 0 16.856-7.562 16.856-16.856v-34.138c0-23.601-19.2-42.801-42.801-42.801h-.5c8.764-9.266 13.816-21.923 13.009-35.678h32.867c18.916 0 34.305-15.389 34.305-34.305V208.762c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5V319.9c0 10.645-8.66 19.305-19.305 19.305h-36.218a47.888 47.888 0 00-9.612-15h42.635c4.143 0 7.5-3.357 7.5-7.5V65.82c0-4.143-3.357-7.5-7.5-7.5H37.5a7.499 7.499 0 00-7.5 7.5v250.885c0 4.143 3.357 7.5 7.5 7.5h42.635a47.645 47.645 0 00-9.612 15H34.305C23.66 339.205 15 330.544 15 319.9V62.625C15 51.98 23.66 43.32 34.305 43.32h443.388c10.645 0 19.305 8.66 19.305 19.305v111.138c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5V62.625c-.001-18.917-15.39-34.305-34.306-34.305zM177.959 466.821a1.858 1.858 0 01-1.855 1.856H53.737a1.859 1.859 0 01-1.856-1.856v-34.138c0-15.329 12.472-27.801 27.801-27.801h70.478c15.329 0 27.8 12.472 27.8 27.801v34.138zM82.081 357.043c0-18.032 14.645-32.839 32.839-32.839 18.138 0 32.839 14.76 32.839 32.839 0 18.107-14.731 32.839-32.839 32.839s-32.839-14.731-32.839-32.839zm103.378 51.473c-7.721-11.242-20.661-18.634-35.3-18.634h-.5c8.764-9.266 13.816-21.923 13.009-35.678h45.583c-.807 13.746 4.239 26.405 13.009 35.678h-.5c-14.639 0-27.58 7.391-35.301 18.634zm-35.754-84.311h71.509a47.897 47.897 0 00-9.612 15h-52.284a47.642 47.642 0 00-9.613-15zm169.333 142.616a1.859 1.859 0 01-1.856 1.856H194.815a1.859 1.859 0 01-1.856-1.856v-34.138c0-15.329 12.472-27.801 27.801-27.801h70.478c15.329 0 27.801 12.472 27.801 27.801v34.138zm-95.879-109.778c0-18.145 14.77-32.839 32.84-32.839 18.075 0 32.839 14.697 32.839 32.839 0 18.107-14.731 32.839-32.839 32.839s-32.84-14.731-32.84-32.839zm103.379 51.473c-7.721-11.242-20.662-18.634-35.301-18.634h-.499c8.764-9.266 13.816-21.923 13.009-35.678h45.583c-.807 13.747 4.239 26.406 13.009 35.678h-.499c-14.64 0-27.581 7.391-35.302 18.634zm-35.754-84.311h71.509a47.916 47.916 0 00-9.613 15h-52.284a47.605 47.605 0 00-9.612-15zm141.532 80.677c15.329 0 27.801 12.472 27.801 27.801v34.138a1.859 1.859 0 01-1.856 1.856H335.895a1.859 1.859 0 01-1.856-1.856v-34.138c0-15.329 12.472-27.801 27.801-27.801zm-68.078-47.839c0-18.098 14.72-32.839 32.839-32.839 18.11 0 32.84 14.733 32.84 32.839 0 18.107-14.731 32.839-32.84 32.839-18.107 0-32.839-14.731-32.839-32.839zM45 309.205V73.32h421.997v235.885z"
                                data-original="#000000" class="active-path" data-old_color="#000000" fill="#0E2A3F" />
                        </svg>
                    </a>
                </div>
                <div>
                    <a href="{{route('posts.index', $subject->id)}}">
                        <h1 class="font-montserrat font-semibold text-lg text-right text-bluedark-500">
                            {{$subject->name}}</h1>
                    </a>
                    <h1 class="text-sm font-montserrat font-medium text-right text-gray-700">{{$subject->course->name}}
                    </h1>
                </div>
            </div>
            <div class="px-6 py-4 font-montserrat w-auto flex  items-center">
                <div class="w-9/12 flex">
                    @if (count($subject->pendientes()) === 0)
                    <svg aria-hidden="true" data-prefix="fas" data-icon="calendar-check"
                        class="w-5 h-5 text-gray-600 inline-block svg-inline--fa fa-calendar-check fa-w-14"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M436 160H12c-6.627 0-12-5.373-12-12v-36c0-26.51 21.49-48 48-48h48V12c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v52h128V12c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v52h48c26.51 0 48 21.49 48 48v36c0 6.627-5.373 12-12 12zM12 192h424c6.627 0 12 5.373 12 12v260c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V204c0-6.627 5.373-12 12-12zm333.296 95.947l-28.169-28.398c-4.667-4.705-12.265-4.736-16.97-.068L194.12 364.665l-45.98-46.352c-4.667-4.705-12.266-4.736-16.971-.068l-28.397 28.17c-4.705 4.667-4.736 12.265-.068 16.97l82.601 83.269c4.667 4.705 12.265 4.736 16.97.068l142.953-141.805c4.705-4.667 4.736-12.265.068-16.97z" />
                    </svg>
                    <p class="text-gray-700 text-sm  text-left ml-2">
                        No tienes tareas
                    </p>
                    @else
                    <svg aria-hidden="true" data-prefix="fas" data-icon="business-time"
                        class="w-5 h-5 text-gray-600 inline-block svg-inline--fa fa-business-time fa-w-20"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                        <path fill="currentColor"
                            d="M496 224c-79.59 0-144 64.41-144 144s64.41 144 144 144 144-64.41 144-144-64.41-144-144-144zm64 150.29c0 5.34-4.37 9.71-9.71 9.71h-60.57c-5.34 0-9.71-4.37-9.71-9.71v-76.57c0-5.34 4.37-9.71 9.71-9.71h12.57c5.34 0 9.71 4.37 9.71 9.71V352h38.29c5.34 0 9.71 4.37 9.71 9.71v12.58zM496 192c5.4 0 10.72.33 16 .81V144c0-25.6-22.4-48-48-48h-80V48c0-25.6-22.4-48-48-48H176c-25.6 0-48 22.4-48 48v48H48c-25.6 0-48 22.4-48 48v80h395.12c28.6-20.09 63.35-32 100.88-32zM320 96H192V64h128v32zm6.82 224H208c-8.84 0-16-7.16-16-16v-48H0v144c0 25.6 22.4 48 48 48h291.43C327.1 423.96 320 396.82 320 368c0-16.66 2.48-32.72 6.82-48z" />
                    </svg>
                    <a href="{{route('deliveries.pendings',$subject)}}"
                        class="text-gray-700 text-sm  text-left ml-2">{{count($subject->pendientes())}} Tareas
                        Pendientes</a>
                    @endif
                    </p>
                </div>

                {{-- <p class="text-gray-700 text-sm">
                        <a href="{{route('deliveries.subject',$subject)}}">Entregadas</a>
                </p> --}}

                <div class="w-3/12 flex justify-end">
                    <a href="{{route('deliveries.subject',$subject)}}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 0 36 36" width="32px">
                            <path
                                d="M8.377 31.833c6.917 0 11.667 3.583 15 3.583S33.71 33.5 33.71 18.167 24.293.583 20.627.583c-17.167 0-24.5 31.25-12.25 31.25z"
                                fill="#efefef" data-original="#EFEFEF" />
                            <path
                                d="M20.25 9.75h-2v1a1 1 0 01-1 1h-5.5a1 1 0 01-1-1v-1h-2c-1.1 0-2 .9-2 2v12.5c0 1.1.9 2 2 2h11.5c1.1 0 2-.9 2-2v-12.5c0-1.1-.9-2-2-2z"
                                fill="#f3f3f1" data-original="#F3F3F1" />
                            <path
                                d="M18.25 8.75v2a1 1 0 01-1 1h-5.5a1 1 0 01-1-1v-2h1.75c0-1.1.9-2 2-2s2 .9 2 2zM21.532 28.72l-3.005.53.53-3.005 7.425-7.425c.391-.391.847-.567 1.237-.177l1.237 1.237a.999.999 0 010 1.414z"
                                fill="#2c84c7" data-original="#2FDF84" data-old_color="#2fdf84" />
                            <path
                                d="M20.5 10.75v-.975c-.083-.011-.164-.025-.25-.025h-2v1a1 1 0 01-1 1h2.25a1 1 0 001-1zM9 24.25v-12.5c0-1.014.768-1.849 1.75-1.975V9.75h-2c-1.1 0-2 .9-2 2v12.5c0 1.1.9 2 2 2H11c-1.1 0-2-.9-2-2z"
                                fill="#d5dbe1" data-original="#D5DBE1" />
                            <path
                                d="M13 10.75v-2h1.75c0-.683.348-1.289.875-1.65a1.984 1.984 0 00-1.125-.35c-1.1 0-2 .9-2 2h-1.75v2a1 1 0 001 1H14a1 1 0 01-1-1zM21.308 26.245l7.007-7.007-.595-.595c-.391-.391-.847-.214-1.237.177l-7.425 7.425-.53 3.005 2.322-.41z"
                                fill="#216294" data-original="#00B871" class="active-path" data-old_color="#00b871" />
                            <path
                                d="M18.527 30a.748.748 0 01-.738-.88l.53-3.005a.746.746 0 01.208-.4l7.425-7.425c.913-.913 1.808-.668 2.298-.177l1.237 1.237a1.75 1.75 0 010 2.475l-7.425 7.425a.746.746 0 01-.4.208l-3.005.53a.715.715 0 01-.13.012zm1.228-3.392l-.303 1.717 1.717-.303 7.258-7.258a.25.25 0 000-.354l-1.228-1.228c-.01.019-.086.066-.187.167zM16.01 27H8.75A2.752 2.752 0 016 24.25v-12.5A2.752 2.752 0 018.75 9h1.88v1.5H8.75c-.689 0-1.25.561-1.25 1.25v12.5c0 .689.561 1.25 1.25 1.25h7.26zM23 18.81h-1.5v-7.06c0-.689-.561-1.25-1.25-1.25h-1.87V9h1.87A2.752 2.752 0 0123 11.75z"
                                data-original="#000000" />
                            <path
                                d="M17.25 12.5h-5.5c-.965 0-1.75-.785-1.75-1.75v-2a.75.75 0 01.75-.75h1.104c.328-1.153 1.39-2 2.646-2s2.318.847 2.646 2h1.104a.75.75 0 01.75.75v2c0 .965-.785 1.75-1.75 1.75zm-5.75-3v1.25c0 .138.112.25.25.25h5.5a.25.25 0 00.25-.25V9.5h-1a.75.75 0 01-.75-.75c0-.689-.561-1.25-1.25-1.25s-1.25.561-1.25 1.25a.75.75 0 01-.75.75zM9.75 14h9.5v1.5h-9.5zM9.75 17h9.5v1.5h-9.5zM9.75 20h9.5v1.5h-9.5z"
                                data-original="#000000" />
                            <path
                                d="M28.314 14.78c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5 1.5.673 1.5 1.5-.672 1.5-1.5 1.5zm0-2c-.275 0-.5.225-.5.5s.225.5.5.5.5-.225.5-.5-.224-.5-.5-.5zM16.375 3.25h2v1h-2zM10.625 3.25h2v1h-2zM14.125 0h1v2h-1z"
                                fill="#a4afc1" data-original="#A4AFC1" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    @else
    <div class="card md:w-10/12 rounded-sm bg-gray-100 mx-auto mt-6 mb-4 shadow-lg">
        <div class="alert flex flex-row items-center bg-blue-100 p-5 rounded border-b-2 border-blue-300">
            <div
                class="alert-icon flex items-center bg-blue-100 border-2 border-blue-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                <span class="text-blue-500">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            </div>
            <div class="alert-content ml-4">
                <div class="alert-title font-semibold text-lg text-blue-800">
                    Informaci??n
                </div>
                <div class="alert-description text-sm text-blue-600">
                    A??n no hay materias asignadas!
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


@endsection