@extends('layouts.dashboard')

@section('content')

{{-- Nuevo --}}
{{-- card tarea --}}
<div class="container font-montserrat text-sm mb-8">
    <div class="card  rounded-sm bg-gray-100 mx-auto mt-6 shadow-lg md:w-10/12">
        <div class="card-title bg-white w-full p-5 border-b flex items-center justify-between md:justify-between">
            <div>
                <p class="sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold placeholder-gray-700">Editar
                    Tarea: {{$job->title}}</p>
                <p class="md:text-md text-sm text-primary-500 font-semibold">{{$job->subject->name}}</p>
                <p class="md:text-sm text-xs text-primary-400">{{$job->subject->course->name}}</p>
            </div>
            <a href="{{route('jobs.showJob', $job->id)}}"
                class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306">
                    <path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0"
                        d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z" /></svg>
            </a>
        </div>
        <div class="card-body py-4">
            <form method="POST" action="{{route('jobs.update', $job->id)}}" enctype="multipart/form-data"
                class="mx-auto" id="form">
                @csrf
                @method('PUT')

                <input hidden type="text" name="subject" id="" value="{{$job->subject->id}}">

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Título
                        </label>
                        <input type="text" id="title" name="title" class="form-input w-full block" id="grid-last-name"
                            type="text" placeholder="Título de la tarea" onchange="setTitle()" value="{{$job->title}}">
                        <span class="flex italic text-red-600  text-sm" id="titleError" role="alert">
                            {{$errors->first('title')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Descripción/Instrucciones
                        </label>
                        <textarea name="description" id="description" cols="30" rows="10"
                            class="form-input w-full block" id="grid-last-name" type="text"
                            placeholder="Descripción o instrucciones de la tarea" onchange="setDescription()"
                            value="">{{$job->description}}</textarea>
                        <span class="flex italic text-red-600  text-sm" id="descriptionError" role="alert">
                            {{$errors->first('description')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Fecha de Inicio
                        </label>
                        <input type="date" id="start" name="start" class="form-input w-full block" id="grid-last-name"
                            type="text" placeholder="Título de la tarea" onchange="setDateStart()"
                            value="{{$job->start->format('Y-m-d')}}">
                        <span class="flex italic text-red-600 text-sm" id="startError" role="alert">
                            {{$errors->first('start')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Fecha Límite de Entrega
                        </label>
                        <input type="date" id="end" name="end" class="form-input w-full block" id="grid-last-name"
                            type="text" placeholder="Título de la tarea" onchange="setDateStart()"
                            value="{{$job->end->format('Y-m-d')}}">
                        <span class="flex italic text-red-600  text-sm" id="endError" role="alert">
                            {{$errors->first('end')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Link de Youtube (Opcional)
                        </label>
                        <input type="text" name="link" id="link" value="{{$job->link}}" class="form-input w-full block"
                            id="grid-last-name" type="text" placeholder="Link del video" onchange="setLink()">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('link')}}
                        </span>
                    </div>
                </div>

                {{-- Agregando Video a Youtube  --}}
                {{-- <div class="flex flex-wrap my-5">
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
                                        <span class="mt-2 text-sm leading-normal" id="selectedVideo">Seleccione un video</span>
                                        <input type='file'  value="" class="hidden" name="video" id="fileVideoName"
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

    <div class="flex flex-wrap my-5">
        <div class="w-full md:w-full px-6 md:mb-0 mb-1">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Archivo
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
                            <span class="mt-2 text-sm leading-normal" id="selected">Seleccione un archivo</span>
                            <input type='file' value="{{$job->file_path}}" class="hidden" name="file" id="fileName"
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


    <button type="submit" class="flex mx-auto btn btn-primary" id="entregaDisabled">Guardar</button>

    </form>
</div>
</div>
</div>

{{-- star modal --}}
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-20">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end items-center pb-3">
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="flex justify-center">
                <iframe id="viewer" height="600" width="800" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
{{-- end modal --}}

@endsection

@push('js')
{{-- script inputs set --}}
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
        if (extension[1] == 'png' || extension[1] == 'jpg' || extension[1] == 'pdf') {
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

        if (fileVideoName.value.length > 0) {
            if (link.value.length == 0) {
                link.setAttribute('disabled', true);
            }
        } else {
            link.removeAttribute('disabled');
        }

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

    function disableButton(){
        document.getElementById("entregaDisabled").disabled = true;
        loadingSubmit()
    }
</script>

<script>
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
</script>

<script>
    //Validaciones const
    const form = document.getElementById("form")
    const titleError = document.getElementById("titleError")
    const descriptionError = document.getElementById("descriptionError")
    const startError = document.getElementById("startError")
    const endError = document.getElementById("endError")

    // formulario validation
    form.addEventListener("submit", e=>{
        document.getElementById("entregaDisabled").disabled = true;
        loadingSubmit();
    })
    //end  formulario validation


    // set title validation
    function setTitle(){
        document.getElementById("entregaDisabled").disabled = false;
        if (title.value.length > 40){
            document.getElementById("titleError").innerHTML = "No puede tener más de 40 caracteres"
            title.classList.add("form-input-error")
        }
        if (title.value.length < 41){
            document.getElementById("titleError").innerHTML = ""
            title.classList.remove("form-input-error")
        }
        if (title.value.length <= 4){
            document.getElementById("titleError").innerHTML = "Debe tener al menos 5 caracteres"
            title.classList.add("form-input-error")
        }
    }

    // set description validation
    function setDescription(){
        document.getElementById("entregaDisabled").disabled = false;
        if (description.value.length > 3000){
            document.getElementById("descriptionError").innerHTML = "No puede tener más de 3000 caracteres"
            description.classList.add("form-input-error")
        }
        if (description.value.length <= 3000){
            document.getElementById("descriptionError").innerHTML = ""
            description.classList.remove("form-input-error")
        }
        if (description.value.length < 20){
            document.getElementById("descriptionError").innerHTML = "Debe tener al menos 20 caracteres"
            description.classList.add("form-input-error")
        }

    }

    function setDateStart(){
        document.getElementById("entregaDisabled").disabled = false;
    }

    //end validate
</script>
@endpush