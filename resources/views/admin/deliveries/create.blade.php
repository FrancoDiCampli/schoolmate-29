@extends('layouts.dashboard')

@section('content')


{{-- nuevo --}}
<div class="card mt-6 md:w-10/12 bg-white shadow-lg p-3 rounded-sm mx-auto flex items-center justify-between">
    <div>
        <p class="text-md text-primary-500 font-semibold">{{$job->subject->name}}</p>
        <p class="text-sm text-primary-400">{{$job->subject->course->name}}</p>
    </div>
    <div>
        <a href="{{ URL::previous() }}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
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
                    @if ($delivery->state($delivery->state) === "Por Corregir")
                    <span class="bg-orange-200 text-orange-800 float-right rounded-full px-2 py-1 text-xs font-medium hidden md:block">{{$delivery->state($delivery->state)}}</span>
                    @endif
                    @if ($delivery->state($delivery->state) === "Desaprobado")
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
            @if ($delivery->state($delivery->state) === "Por Corregir")
            <span class="rounded-full text-orange-800 bg-orange-200 px-2 py-1 text-xs font-medium md:hidden">{{$delivery->state($delivery->state)}}</span>
            @endif
            @if ($delivery->state($delivery->state) === "Desaprobado")
            <span class="rounded-full text-red-800 bg-red-200 px-2 py-1 text-xs font-medium md:hidden">{{$delivery->state($delivery->state)}}</span>
            @endif

        @else
        <span class="rounded-full text-purple-800 bg-purple-200 px-2 py-1 text-xs font-medium md:hidden">Sin entrega</span>
        @endif
        </div>




        <div class="text-sm text-gray-700 text-right">
            Fecha de Entrega: {{$job->end->format('d-m-Y')}}
        </div>

        <div class=" w-full flex relative items-center border-b mb-2 py-3">
            <div class="">
                <img class="w-8 h-8 rounded-full object-cover mr-4 shadow" src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="avatar">
            </div>
            <div class="flex w-full pt-1">
                <div class="w-full">
                    <div class="w-9/12">
                        <h2 class="text-sm font-medium text-gray-900 -mt-1">{{$job->subject->teacher->name}} </h2>
                        <p class="text-gray-700 font-light text-xs">Publicada el {{$job->created_at->format('d-m-Y')}} </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="py-3 text-md text-gray-800 mt-3 mb-3">
            {{$job->description}}
        </div>



        <div class="flex justify-center p-2">
            {{-- Youtube --}}
            {{-- <iframe height="600" width="800" src="{{$job->link}}"></iframe> --}}
            {{-- <iframe id="viewer" height="600" width="800" src="{{asset($job->file_path)}}" frameborder="0"></iframe> --}}
            <iframe id="" src="{{asset($job->file_path)}}" frameborder="0" class="w-full h-64 md:h-screen"></iframe>
        </div>

        {{-- Movimientos de la tarea --}}
        <div class="border-t mt-6 flex py-6 text-gray-700 text-sm w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Historial de Entregas
            </label>
        </div>



        {{-- file entrega --}}
        <div class="flex flex-wrap my-5">
            <div class="w-full md:w-full px-6 md:mb-0 mb-1">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Subir Archivo Adjunto
                </label>

                {{-- inicio formulario enviar tarea y/o comentario --}}
                @if ($delivery)
                <form method="POST" action="{{route('delivery.update', $delivery->id)}}" class="mx-auto" id="delivery"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @else

                <form method="POST" action="{{route('deliver.store')}}" class="mx-auto" id="delivery"
                enctype="multipart/form-data">
                @csrf
                @endif

                <input type="text" name="job" value="{{$job->id}}" hidden>

                {{-- link de youtube --}}
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Link de Youtube (Opcional)
                        </label>
                        <input type="text" name="link" id="link" value="{{ old('link') }}" class="form-input w-full block" id="grid-last-name" type="text" placeholder="Link del video">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('link')}}
                        </span>
                    </div>
                </div>

                {{-- Agregando Video a Youtube  --}}
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-1">
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
                                        <span class="mt-2 text-sm leading-normal" id="selectedVideo">Select a file</span>
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
                </div>
                {{-- End video upload  --}}



                <div class="relative">
                    <div class="overflow-hidden relative w-auto mt-4 mb-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            File
                          </label>
                        <div class="flex items-center justify-center bg-grey-lighter">
                            <label
                                class="w-full flex flex-col items-center px-4 py-4 bg-gray-200 text-gray-700 border-b-2 border-gray-400 tracking-wide uppercase cursor-pointer hover:text-primary-300 hover:bg-gray-300">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-sm leading-normal" id="selected">Select a file</span>
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
        {{-- <form action="{{route('comments.store')}}" method="POST">
                @csrf
                <input type="text" name="delivery" value="{{$job->id}}" hidden> --}}
                <div
                    class="border border-gray-400 bg-white h-10 rounded-sm py-1 content-center flex items-center">
                    <input name="comment" type="text" class="bg-transparent focus:outline-none w-full text-sm p-2 text-gray-800" placeholder="Agregar un comentario">
                    {{-- <button type="submit" class="text-teal-600 font-semibold p-2 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 485.725 485.725"  class="h-5 w-5 svg-inline--fa fa-info fa-w-6"><path d="M459.835 196.758L73.531 9.826C48.085-2.507 17.46 8.123 5.126 33.569a51.198 51.198 0 00-1.449 41.384l60.348 150.818h421.7a50.787 50.787 0 00-25.89-29.013zM64.025 259.904L3.677 410.756c-10.472 26.337 2.389 56.177 28.726 66.65a51.318 51.318 0 0018.736 3.631c7.754 0 15.408-1.75 22.391-5.12l386.304-187a50.79 50.79 0 0025.89-29.013H64.025z" data-original="#000000" class="hovered-path active-path" data-old_color="#000000" fill="#374957"/></svg>
                    </button> --}}
                </div>
            {{-- </form> --}}

        {{-- end form enviar taarea y/o comentario --}}
        </div>
        @endif

        <button type="submit" class="flex mx-auto btn btn-primary">Entregar</button>
        </form>

         {{-- Comentarios --}}
        <div class="border-t mt-3 flex pt-3 text-gray-700 text-sm">
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
                        <img class="w-8 h-8 rounded-full object-cover mr-1 shadow" src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="avatar">
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
                    <input name="comment" onkeyup="setComment()" type="text" class="bg-transparent focus:outline-none w-full text-sm p-2 text-gray-800" placeholder="Agregar un comentario" id="comment">
                    <button type="submit" class="text-teal-600 font-semibold p-2 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                        {{-- <svg aria-hidden="true" data-prefix="fas" data-icon="info" class="h-4 w-4 svg-inline--fa fa-info fa-w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"/></svg> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 485.725 485.725"  class="h-5 w-5 svg-inline--fa fa-info fa-w-6"><path d="M459.835 196.758L73.531 9.826C48.085-2.507 17.46 8.123 5.126 33.569a51.198 51.198 0 00-1.449 41.384l60.348 150.818h421.7a50.787 50.787 0 00-25.89-29.013zM64.025 259.904L3.677 410.756c-10.472 26.337 2.389 56.177 28.726 66.65a51.318 51.318 0 0018.736 3.631c7.754 0 15.408-1.75 22.391-5.12l386.304-187a50.79 50.79 0 0025.89-29.013H64.025z" data-original="#000000" class="hovered-path active-path" data-old_color="#000000" fill="#374957"/></svg>
                    </button>
                </div>
                <span class="flex italic text-red-600  text-sm" role="alert" id="commentError">
                    {{$errors->first('title')}}
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



{{-- file entrega --}}
{{-- <div class="container font-montserrat text-sm w-11/12">
    <div class="card  rounded-sm bg-gray-100 mx-auto md:mt-10 shadow-lg">
        <div
            class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between ">
            <h1 class="text-teal-600 font-semibold">{{$job->title}}</h1>
        </div>
        <div class="card-body py-5">
            <form method="POST" action="{{route('deliver.store')}}" class="mx-auto" id="delivery"
                enctype="multipart/form-data">
                @csrf
                <input type="text" name="job" value="{{$job->id}}" hidden>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Deliver
                    </label>
                    <div class="relative">
                        <div class="overflow-hidden relative w-64 mt-4 mb-4">
                            <div class="flex items-center justify-center bg-grey-lighter">
                                <label
                                    class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-teal-600 hover:text-white">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal" id="selected">Select a file</span>
                                    <input type='file' class="hidden" name="file" id="fileName" onchange="setName()" />
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="">
                        <label for="">Leave a comment</label>
                        <button onclick="addComment(event)" class="bg-teal-600 text-white text-2xl p-2  ">+</button>
                    </div>
                    <div id="comment">

                    </div>

                </div>

                <button type="submit"
                    class="w-8/12 mb-5 font-semibold md:w-5/12 py-2 flex mx-auto  justify-center bg-teal-600 text-gray-200 ">Save</button>
            </form>


        </div>
    </div>
</div> --}}

@push('js')
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

    function setName(){
        let fileName = document.getElementById('fileName');
        var cad = fileName.value;
        cad = cad.split('\\');
        let extension = cad[2].split('.');
        let selected = document.getElementById('selected');
        selected.innerHTML = cad[2];
        fileDocument = document.getElementById("fileName").files[0];
        fileDocument_url = URL.createObjectURL(fileDocument);
        if (extension[1] == 'pdf' || extension[1] == 'png' || extension[1] == 'jpg' || extension[1] == 'txt') {
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
        var cad = fileVideoName.value;
        cad = cad.split('\\');
        let extension = cad[2].split('.');
        let selectedVideo = document.getElementById('selectedVideo');
        selectedVideo.innerHTML = cad[2];
        fileDocumentVideo = document.getElementById("fileVideoName").files[0];
        fileDocumentVideo_url = URL.createObjectURL(fileDocumentVideo);
        if (extension[1] == 'mp4') {
            document.getElementById('viewer').setAttribute('src', fileDocumentVideo_url);
            let ancho = screen.width;
            if (ancho <= 640) {
                let marco = document.getElementById('viewer');
                marco.setAttribute('height',200);
                marco.setAttribute('width',270);
            }
            toggleModal();
        }

    }

    //Validación input comentario
    const comentario = document.getElementById("comment")
    const comentarioError = document.getElementById("commentError")
    const form = document.getElementById("form")

    function setComment(){
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

    form.addEventListener("submit", e=>{

        comentarioError.innerHTML = ""

        if (comentario.value.length < 3){
            e.preventDefault()
            document.getElementById("commentError").innerHTML = "Debe tener al menos 2 caracteres"
            comentario.className = ' bg-transparent focus:outline-none w-full text-sm p-3 text-gray-800 placeholder-red-400'
        }

    })

</script>
@endpush
@endsection
