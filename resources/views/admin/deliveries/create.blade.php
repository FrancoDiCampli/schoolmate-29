@extends('layouts.dashboard')

@section('content')


{{-- nuevo --}}
<div class="card mt-6 md:w-10/12 bg-white shadow-lg p-3 rounded-sm mx-auto flex items-center justify-between">
    <div>
        <p class="text-md text-primary-500 font-semibold">{{$job->subject->name}}</p>
        <p class="text-sm text-primary-400">{{$job->subject->course->name}}</p>
    </div>
    <div>
        <a href="{{URL::previous()}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>
          </a>
    </div>
</div>

{{-- card --}}
<div class="flex justify-center mt-2 mb-8">
    <div class="card bg-white rounded-sm w-full md:w-10/12 p-4 shadow-lg">
        <div class=" w-full flex relative items-center border-b mb-2 pb-3">
            <div class="p-2 w-10 h-10 rounded-full object-cover mr-4 shadow bg-primary-400 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6"><path d="M4 6.75A4.756 4.756 0 018.75 2h9.133a2.745 2.745 0 00-2.633-2H3.75A2.752 2.752 0 001 2.75v15.5A2.752 2.752 0 003.75 21H4z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/><path d="M20.25 4H8.75A2.752 2.752 0 006 6.75v14.5A2.752 2.752 0 008.75 24h11.5A2.752 2.752 0 0023 21.25V6.75A2.752 2.752 0 0020.25 4zm-2 17h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-4h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-3.5h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5zm0-4h-7.5a.75.75 0 010-1.5h7.5a.75.75 0 010 1.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/></svg>
            </div>
            <div class="flex w-9/12">
                <div class="">
                    <h1 class="font-semibold text-gray-800 text-lg">
                        Entregar: {{$job->title}}
                    </h1>
                    <div class="text-sm text-gray-700">
                        Fecha de Inicio: {{$job->start->format('d-m-Y')}}
                    </div>
                </div>
            </div>

            <div class="w-3/12">
                @if ($delivery)
                    @if ($delivery->state($delivery->state) === "Aprobado")
                    <span class="bg-green-200 text-green-800 float-right rounded-full px-2 py-1 text-xs font-medium hidden md:block">{{$delivery->state($delivery->state)}}</span>
                    @endif
                    @if ($delivery->state($delivery->state) === "En corrección")
                    <span class="bg-gray-200 text-gray-800 float-right rounded-full px-2 py-1 text-xs font-medium hidden md:block">{{$delivery->state($delivery->state)}}</span>
                    @endif
                    {{-- @if ($delivery->state($delivery->state) === "Por Corregir")
                    <span class="bg-orange-200 text-orange-800 float-right rounded-full px-2 py-1 text-xs font-medium hidden md:block">{{$delivery->state($delivery->state)}}</span>
                    @endif --}}
                    @if ($delivery->state($delivery->state) === "Rehacer")
                    <span class="bg-red-200 text-red-800 float-right rounded-full px-2 py-1 text-xs font-medium hidden md:block">{{$delivery->state($delivery->state)}}</span>
                @endif

                @else
                    <p class="bg-purple-200 text-purple-800 float-right rounded-full px-2 py-1 text-xs font-medium hidden md:block">Sin entrega</p>
                @endif
            </div>

        </div>

        {{-- estados responsive --}}
        <div class="text-right">
        @if ($delivery)
            @if ($delivery->state($delivery->state) === "Aprobado")
            <span class="rounded-full text-green-800 bg-green-200 px-2 py-1 text-xs font-medium md:hidden">{{$delivery->state($delivery->state)}}</span>
            @endif
            @if ($delivery->state($delivery->state) === "En corrección")
            <span class="rounded-full text-gray-800 bg-gray-200 px-2 py-1 text-xs font-medium md:hidden">{{$delivery->state($delivery->state)}}</span>
            @endif
            {{-- @if ($delivery->state($delivery->state) === "Por Corregir")
            <span class="rounded-full text-orange-800 bg-orange-200 px-2 py-1 text-xs font-medium md:hidden">{{$delivery->state($delivery->state)}}</span>
            @endif --}}
            @if ($delivery->state($delivery->state) === "Rehacer")
            <span class="rounded-full text-red-800 bg-red-200 px-2 py-1 text-xs font-medium md:hidden">{{$delivery->state($delivery->state)}}</span>
            @endif

        @else
        <span class="rounded-full text-purple-800 bg-purple-200 px-2 py-1 text-xs font-medium md:hidden">Sin entrega</span>
        @endif
        </div>




        <div class="text-sm text-gray-700 text-right">
            Fecha de Entrega: {{$job->end->format('d-m-Y')}}
        </div>

        {{-- Mensaje una vez que entrega --}}
        @if ($delivery)
        <div class="alert flex flex-row items-center bg-green-100 p-5 rounded border-b-2 border-blue-300 mt-6 mb-6">
            <div class="alert-icon flex items-center bg-green-100 border-2 border-blue-300 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text-blue-500">
                    <svg aria-hidden="true" data-prefix="far" data-icon="laugh-beam" class="svg-inline--fa fa-laugh-beam fa-w-16 w-8 h-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm141.4 389.4c-37.8 37.8-88 58.6-141.4 58.6s-103.6-20.8-141.4-58.6S48 309.4 48 256s20.8-103.6 58.6-141.4S194.6 56 248 56s103.6 20.8 141.4 58.6S448 202.6 448 256s-20.8 103.6-58.6 141.4zM328 152c-23.8 0-52.7 29.3-56 71.4-.7 8.6 10.8 11.9 14.9 4.5l9.5-17c7.7-13.7 19.2-21.6 31.5-21.6s23.8 7.9 31.5 21.6l9.5 17c4.1 7.4 15.6 4 14.9-4.5-3.1-42.1-32-71.4-55.8-71.4zm-201 75.9l9.5-17c7.7-13.7 19.2-21.6 31.5-21.6s23.8 7.9 31.5 21.6l9.5 17c4.1 7.4 15.6 4 14.9-4.5-3.3-42.1-32.2-71.4-56-71.4s-52.7 29.3-56 71.4c-.6 8.5 10.9 11.9 15.1 4.5zM362.4 288H133.6c-8.2 0-14.5 7-13.5 15 7.5 59.2 58.9 105 121.1 105h13.6c62.2 0 113.6-45.8 121.1-105 1-8-5.3-15-13.5-15z"/></svg>
				</span>
			</div>

			<div class="alert-content ml-4 w-full">
				<div class="alert-title font-semibold text-lg text-blue-800">
                    Tu tarea fue entregada!
                </div>

                @if ($delivery->file_path)
				<div class="alert-description text-sm text-blue-600 flex py-1 items-center">
                    <a id="descargarFile" target="_blank" href="{{asset($delivery->file_path)}}" class="flex hover:text-blue-800 items-center">
                    Ver mi entrega
                    <svg aria-hidden="true" data-prefix="fas" data-icon="file-import" class="ml-2 svg-inline--fa fa-file-import fa-w-16 fa-w-16 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M16 288c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h112v-64zm489-183L407.1 7c-4.5-4.5-10.6-7-17-7H384v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H152c-13.3 0-24 10.7-24 24v264h128v-65.2c0-14.3 17.3-21.4 27.4-11.3L379 308c6.6 6.7 6.6 17.4 0 24l-95.7 96.4c-10.1 10.1-27.4 3-27.4-11.3V352H128v136c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H376c-13.2 0-24-10.8-24-24z"/></svg>
                    </a>
                </div>
                @else
                <p class="text-sm text-blue-600 flex py-1 items-center">Sin archivo
                    <svg aria-hidden="true" data-prefix="fas" data-icon="exclamation-circle" class="svg-inline--fa fa-exclamation-circle fa-w-16 w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"/></svg>
                </p>
                @endif
            </div>
        </div>
        @endif
        {{-- Fin Mensaje una vez que entrega --}}

        <div class=" w-full flex relative items-center border-b mb-2 py-3">
            <div class="">
                <img class="w-8 h-8 rounded-full object-cover mr-4 shadow" src="{{asset('img/avatar/user.png')}}" alt="avatar">
            </div>
            <div class="flex w-full pt-1">
                <div class="w-full">
                    <div class="w-9/12">
                        <h2 class="text-sm font-medium text-gray-900 -mt-1">{{$job->subject->teacher->name}} </h2>
                        <p class="text-gray-700 font-light text-xs">Publicada el {{$job->created_at->format('d-m-Y')}} </p>
                    </div>
                </div>
                @if ($job->file_path)
                <a id="descargarFile" href="{{route('descargarJob', $job)}}" class="btn btn-default mr-3 py-1 px-2 rounded-md hidden md:flex">
                    <svg aria-hidden="true" data-prefix="fas" data-icon="download" class="svg-inline--fa fa-download fa-w-16 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"/></svg>
                </a>
                @endif
            </div>
        </div>

        <div class="py-3 text-md text-gray-800 mt-3 mb-3 break-words">
            {{$job->description}}
        </div>

        {{-- Youtube --}}
        <div class="flex justify-center p-2">
            @if ($job->link)
            <iframe id="player" type="text/html" width="600" height="400"
                src="http://www.youtube.com/embed/{{$vid}}" frameborder="0" allowfullscreen></iframe>
            @endif
        </div>

        {{-- @if ($delivery)
            @if ($delivery->file_path)
                <div class="flex justify-center p-2 mt-2">
                    <a id="descargarFile" target="_blank" href="{{asset($delivery->file_path)}}" class="btn btn-secondary flex" >Ver Mi Entrega
                        <svg aria-hidden="true" data-prefix="fas" data-icon="file-import" class="svg-inline--fa fa-file-import fa-w-16 ml-2 fa-w-16 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M16 288c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h112v-64zm489-183L407.1 7c-4.5-4.5-10.6-7-17-7H384v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H152c-13.3 0-24 10.7-24 24v264h128v-65.2c0-14.3 17.3-21.4 27.4-11.3L379 308c6.6 6.7 6.6 17.4 0 24l-95.7 96.4c-10.1 10.1-27.4 3-27.4-11.3V352H128v136c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H376c-13.2 0-24-10.8-24-24z"/></svg>
                    </a>
                </div>
            @endif
        @endif --}}

        @if ($job->file_path)
            <div class="flex justify-center p-2 mt-2 md:hidden">
                <a id="descargarFile" href="{{route('descargarJob', $job)}}" class="btn btn-default flex">Descargar Tarea
                    <svg aria-hidden="true" data-prefix="fas" data-icon="download" class="svg-inline--fa fa-download ml-2 fa-w-16 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"/></svg>
                </a>
            </div>
            <div class="flex justify-center p-2">
                <iframe id="viewerFile" height="600" width="800" frameborder="0" class="w-full h-64 md:h-screen"></iframe>
            </div>
        @endif

        {{-- Movimientos de la tarea --}}
        <div class="border rounded-sm mt-6 py-4 text-gray-700 text-sm w-full px-3 mb-6 md:mb-0">
            <div class="border-b">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Historial de Entregas
                </label>
            </div>

            <div>
            @if ($activities)
            <div class="card-body py-2 my-2">
                <div class="overflow-x-auto">
                    <table class="table-auto border-collapse w-full">
                        <thead>
                            <tr class="px-5 py-3 border-b border-primary-400 text-left font-semibold text-gray-800">
                                <th class="px-1 py-2">Fecha</th>
                                <th class="px-1 py-2">Actividad</th>
                                <th class="px-1 py-2" >Actor</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                            @foreach ($activities as $activity)
                                <tr class="hover:bg-gray-100 border-b border-gray-200 bg-white text-sm">
                                    <td class="px-1 py-2">{{$activity->created_at->format('d-m-Y')}}</td>
                                    <td class="px-1 py-2">{{$activity->description}}</td>
                                    <td class="px-1 py-2 mt-1">{{$activity->causer->name}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

                @else
                <div class="card w-full rounded-sm bg-gray-100 mx-auto mt-6 mb-4">
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
                                Aún no hay ningún movimiento!
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>



        {{-- file entrega --}}
        <div class="flex flex-wrap my-5 border">
            <div class="w-full md:w-full px-6 md:mb-0 mb-1 py-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Subir Archivo Adjunto
                </label>

                {{-- inicio formulario enviar tarea y/o comentario --}}
                @if ($delivery)
                <form method="POST" action="{{route('delivery.update', $delivery->id)}}" class="mx-auto" id="delivery"
                enctype="multipart/form-data" onsubmit="return disableButton();">
                @method('PUT')
                @csrf
                @else

                <form method="POST" action="{{route('deliver.store')}}" class="mx-auto" id="delivery"
                enctype="multipart/form-data" onsubmit="return disableButton();">
                @csrf
                @endif

                <input type="text" name="job" value="{{$job->id}}" hidden>

                {{-- link de youtube --}}
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full md:mb-0 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Link de Youtube (Opcional)
                        </label>
                        <input type="text" name="link" id="link" value="{{ old('link') }}" class="form-input w-full block" id="grid-last-name" type="text" placeholder="Link del video" onchange="setLink()">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('link')}}
                        </span>
                    </div>
                </div>

                {{-- Agregando Video a Youtube  --}}
                {{-- <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full md:mb-0 mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Video
                        </label>
                        <div class="relative">
                            <div class="overflow-hidden relative w-auto mt-4 mb-4">
                                <div class="flex items-center justify-center bg-grey-lighter">
                                    <label
                                        class="w-full flex flex-col items-center px-4 py-4 bg-gray-200 text-gray-700 border-b-2 border-gray-400 tracking-wide uppercase cursor-pointer hover:text-primary-300 hover:bg-gray-300">
                                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                        </svg>
                                        <span class="mt-2 text-sm leading-normal" id="selectedVideo">Seleccione un video</span>
                                        <input type='file' class="hidden" name="video" id="fileVideoName"
                                            onchange="setNameVideo()" />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('video')}}
                        </span>
                    </div>
                </div> --}}
                {{-- End video upload  --}}



                <div class="relative">
                    <div class="overflow-hidden relative w-auto mt-4 mb-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Archivo
                          </label>
                        <div class="flex items-center justify-center bg-grey-lighter">
                            <label
                                class="w-full flex flex-col items-center px-4 py-4 bg-gray-200 text-gray-700 border-b-2 border-gray-400 tracking-wide uppercase cursor-pointer hover:text-primary-300 hover:bg-gray-300">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-sm leading-normal" id="selected">Seleccione un archivo</span>
                                <input type='file' class="hidden" name="file" id="fileName"
                                    onchange="setName()" />
                            </label>
                        </div>
                    </div>
                </div>
                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('file')}}
                </span>
            </div>
        </div>



        @if ($comments)

        @else
        <div class="border-t mt-3 mb-6 pt-6 text-gray-700 text-sm w-full">
            <div
                class="border border-gray-400 bg-white h-10 rounded-sm py-1 content-center flex items-center">
                <input name="comment"  type="text" class="bg-transparent focus:outline-none w-full text-sm p-2 text-gray-800" placeholder="Agregar un comentario" value="{{old('comment')}}">
            </div>
            <span class="flex italic text-red-600  text-sm" role="alert" id="commentError">
                {{$errors->first('comment')}}
            </span>
        {{-- end form enviar taarea y/o comentario --}}
        </div>
        @endif

        <button type="submit" class="flex mx-auto btn btn-primary mb-10" id="entregaDisabled" onclick="return confirm('¿Desea confirmar la entrega?')">Entregar Tarea</button>
        </form>

         {{-- Comentarios --}}
        <div class="border-t mt-3 flex pt-6 text-gray-700 text-sm">
            <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
            </svg>
            <span> Comentarios de la entrega</span>
        </div>

        <div class="flex justify-start mt-2 mb-8">
            <div class="w-full">
                @foreach ($comments ?? [] as $item)
                <div class=" w-full flex relative items-center mt-3">
                    <div class="p-2">
                        <img class="w-8 h-8 rounded-full object-cover mr-1 shadow" src="{{asset('img/avatar/user.png')}}" alt="avatar">
                    </div>

                    <div class="w-full">
                        <h2 class="text-sm font-medium text-gray-900">{{$item->user->name}} </h2>
                        <p class="text-gray-700 font-light text-xs">{{$item->created_at->diffForHumans()}} </p>
                    </div>
                </div>

                <div class="text-sm text-gray-700 w-full px-2">
                    <p class="text-sm font-medium text-gray-900 ml-10">{{$item->comment}}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- inptut enviar comentario individual --}}
        @if($comments)
        <div class="border-t mt-3 mb-6 pt-6 text-gray-700 text-sm w-full">
        <form action="{{route('comments.store')}}" method="POST" id="form">
                @csrf
                <input type="text" name="delivery" value="{{$delivery->id}}" hidden>
                <div
                    class="border border-gray-400 bg-white h-10 rounded-sm py-1 content-center flex items-center">
        <input name="comment" onkeyup="setComment()" type="text" class="bg-transparent focus:outline-none w-full text-sm p-2 text-gray-800" placeholder="Agregar un comentario" id="comment" maxlength="2001" value="{{old('comment')}}">
                    <button type="submit" class="text-teal-600 font-semibold p-2 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none" id="entregaDisabledComments">
                        {{-- <svg aria-hidden="true" data-prefix="fas" data-icon="info" class="h-4 w-4 svg-inline--fa fa-info fa-w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"/></svg> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 485.725 485.725"  class="h-5 w-5 svg-inline--fa fa-info fa-w-6"><path d="M459.835 196.758L73.531 9.826C48.085-2.507 17.46 8.123 5.126 33.569a51.198 51.198 0 00-1.449 41.384l60.348 150.818h421.7a50.787 50.787 0 00-25.89-29.013zM64.025 259.904L3.677 410.756c-10.472 26.337 2.389 56.177 28.726 66.65a51.318 51.318 0 0018.736 3.631c7.754 0 15.408-1.75 22.391-5.12l386.304-187a50.79 50.79 0 0025.89-29.013H64.025z" data-original="#000000" class="hovered-path active-path" data-old_color="#000000" fill="#374957"/></svg>
                    </button>
                </div>
                <span class="flex italic text-red-600  text-sm" role="alert" id="commentError">
                    {{$errors->first('comment')}}
                </span>
            </form>
        </div>
        @endif

    </div>
</div>



<!--Modal-->
<div
    class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-end items-center pb-3">
                {{-- <p class="text-2xl font-bold">Simple Modal!</p> --}}
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                        height="18" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <div class="flex justify-center">
                <iframe id="viewer" height="600" width="800" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
{{-- end modal --}}




@push('js')
{{-- script archivos --}}
<script>

    function deshabilitar(){
        let btn = document.getElementById('entregar')
        btn.disabled = true
        console.log('des')

    }


    let aux = @json($file);
    let ancho = screen.width;
    let descFile = document.getElementById('descargarFile');

    if (aux) {
        let tipos = ['png', 'jpg', 'pdf'];

        let aux1 = 0;

        tipos.forEach(element => {
            if (aux.search(element) > 0) {
                aux1 = aux.search(element);
            }
        });

        if (aux1 == 0) {
            document.getElementById('viewerFile').setAttribute('src', 'https://view.officeapps.live.com/op/embed.aspx?src='+aux);
        } else if (ancho <= 640) {
            document.getElementById('viewerFile').classList.toggle('hidden');
            descFile.removeAttribute('hidden');
        } else {
            document.getElementById('viewerFile').setAttribute('src', aux);
        }
    }

    if (ancho <= 640) {
        let marco = document.getElementById('viewerFile');
        marco.setAttribute('height',500);
        marco.setAttribute('width',270);

        let marco2 = document.getElementById('player');
        marco2.setAttribute('height',200);
        marco2.setAttribute('width',270);

        let marco1 = document.getElementById('viewer');
        marco1.setAttribute('height',200);
        marco1.setAttribute('width',270);
    }
</script>

{{-- script clear inputs file and video --}}
<script>
    function limpiarVideo(){
        let video = document.getElementById('fileVideoName');
        let link = document.getElementById('link');
        video.value = '';
        let selectedVideo = document.getElementById('selectedVideo');
        selectedVideo.innerHTML = 'Seleccione un video';
        link.removeAttribute('disabled');
    }

    function limpiarFile(){
        let video = document.getElementById('fileName');
        video.value = '';
        let selectedVideo = document.getElementById('selected');
        selectedVideo.innerHTML = 'Seleccione un archivo';
    }
</script>

{{-- script set inputs file and video --}}
<script>
    function setName(){
        let fileName = document.getElementById('fileName');
        var cad = fileName.value;
        cad = cad.split('\\');
        let extension = cad[2].split('.');
        let selected = document.getElementById('selected');

        selected.innerHTML = cad[2] + ' ' +"<button id='boton' type='button' onclick='limpiarFile()' class='btn-delete'>X</button>";
        let botoncito = document.getElementById('boton');

        fileDocument = document.getElementById("fileName").files[0];
        fileDocument_url = URL.createObjectURL(fileDocument);
        if (extension[1] == 'png' || extension[1] == 'jpg' || extension[1] == 'txt') {
            document.getElementById('viewer').setAttribute('src', fileDocument_url);
            let ancho = screen.width;
            if (ancho <= 640) {
                let marco = document.getElementById('viewer');
                marco.setAttribute('height',200);
                marco.setAttribute('width',270);
            }
            toggleModal();
        }

    }
    function setNameVideo(){
        let fileVideoName = document.getElementById('fileVideoName');
        let link = document.getElementById('link');

        var cad = fileVideoName.value;
        cad = cad.split('\\');
        let extension = cad[2].split('.');
        let selectedVideo = document.getElementById('selectedVideo');

        selectedVideo.innerHTML = cad[2] + ' ' +"<button id='botonVideo' type='button' onclick='limpiarVideo()' class='btn-delete'>X</button>";
        let botoncito = document.getElementById('botonVideo');

        fileDocumentVideo = document.getElementById("fileVideoName").files[0];
        fileDocumentVideo_url = URL.createObjectURL(fileDocumentVideo);

        let tipos = ['mov','mpeg4','mp4','avi','wmv','mpegps','flv','3gpp','webm','dnxhr','hevc'];
        let aux = true;
        tipos.forEach(element => {
            if (extension[1].search(element) == 0) {
                aux = false;
            }
        });
        if (aux) {
            limpiarVideo();
        } else{
            link.setAttribute('disabled', true);
        }
    }

    function setLink(){
        let video = document.getElementById('fileVideoName');
        let link = document.getElementById('link');
        if (link.value.length > 0) {
            if (video.value.length == 0) {
                video.setAttribute('disabled', true);
            }
        } else {
            video.removeAttribute('disabled');
        }
    }
</script>

<script>
    let comment = `<div class="">
                        <label for="">Comment</label>
                        <textarea name="comment" id="" cols="60" rows="5" class=""></textarea>
                        </div> `
        let delivery = document.getElementById('delivery')
        delivery.addEventListener('submit',function(e){
            e.preventDefault();
           delivery.submit();

        })

        let com = document.getElementById('comment')

        function addComment(event){
            event.preventDefault()

            com.innerHTML = comment
        }

        var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };


    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    //Validación input comentario
    const comentario = document.getElementById("comment")
    const comentarioError = document.getElementById("commentError")
    const form = document.getElementById("form")

    function setComment(){
        document.getElementById("entregaDisabledComments").disabled = false;
        if (comentario.value.length > 3000){
            document.getElementById("descriptionError").innerHTML = "No puede tener más de 3000 caracteres"
            description.classList.add("form-input-error")
        }
        if (comentario.value.length > 2){
            document.getElementById("commentError").innerHTML = ""
            comentario.classList.remove("form-input-error")
            comentario.className = ' bg-transparent focus:outline-none w-full text-sm p-3 text-gray-800 placeholder-gray-500'
        }
    }

    form.addEventListener('submit', e=>{

        comentarioError.innerHTML = ""

        if (comentario.value.length < 3){
            e.preventDefault()
            document.getElementById("commentError").innerHTML = "Debe tener al menos 3 caracteres"
            comentario.className = ' bg-transparent focus:outline-none w-full text-sm p-3 text-gray-800 placeholder-red-400'
        }

        document.getElementById("entregaDisabledComments").disabled = true;

    })

    //button disable entrega
    function disableButton(){
        document.getElementById("entregaDisabled").disabled = true;
        loadingSubmit()
    }

</script>
@endpush
@endsection
