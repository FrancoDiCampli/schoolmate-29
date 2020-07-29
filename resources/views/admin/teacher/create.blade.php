@extends('layouts.dashboard')

@section('content')

<div class="container font-montserrat text-sm">
    <div class="card  rounded-sm bg-gray-100 mx-auto mt-6 shadow-lg">
        <div class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between">
           <h1 class="text-teal-600 font-semibold md:m-0 m-2 text-lg">Profesores</h1>
            <a href="{{route('teachers.index')}}" class="flex hover:shadow-lg md:m-0 m-2 px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>

              </a>
        </div>
        <div class="card-body py-5">
            <form method="POST" action="{{ route('teachers.store') }}" enctype="multipart/form-data" class="mx-auto" >
                @csrf


                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Nombre
                        </label>
                        <input type="text" id="name" name="name" class="form-input w-full block"
                             placeholder="Nombre" value="{{old('name')}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('name')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          DNI
                        </label>
                        <input id="dni" type="text"  name="dni" class="form-input w-full block"
                            type="text" placeholder="Ej: 22212222" value="{{old('dni')}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('dni')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Cuil
                        </label>
                        <input type="text" id="name" name="cuil" class="form-input w-full block"
                             placeholder="CUIL" value="{{old('cuil')}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('cuil')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Fecha de Nacimiento
                        </label>
                        <input type="date" id="start" name="fnac" class="form-input w-full block" id="grid-last-name" type="text"  value="{{ old('fnac') }}">

                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('fnac')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Telefono
                        </label>
                        <input type="text" id="name" name="phone" class="form-input w-full block"
                             placeholder="Telefono" value="{{old('phone')}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('phone')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                         Email
                        </label>
                        <input type="email" id="name" name="email" class="form-input w-full block"
                        placeholder="Email" value="{{old('email')}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('email')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Domicilio
                        </label>
                        <input type="text" id="name" name="address" class="form-input w-full block"
                             placeholder="Telefono" value="{{old('address')}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('address')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                         Legajo
                        </label>
                        <input type="text" id="name" name="docket" class="form-input w-full block"
                        placeholder="Legajo" value="{{old('docket')}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('docket')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Foto
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
                                        <span class="mt-2 text-sm leading-normal" id="selected">Seleccione una foto de perfil</span>
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

                <button type="submit" class="flex mx-auto btn btn-primary">Save</button>

            </form>
        </div>
    </div>
</div>

@push('js')
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

    function setName(){
        let fileName = document.getElementById('fileName');
        var cad = fileName.value;
        cad = cad.split('\\');
        let selected = document.getElementById('selected');
        selected.innerHTML = cad[2];
        fileDocument = document.getElementById("fileName").files[0];
        fileDocument_url = URL.createObjectURL(fileDocument);
        document.getElementById('viewer').setAttribute('src', fileDocument_url);
        let ancho = screen.width;
        if (ancho <= 640) {
            let marco = document.getElementById('viewer');
            marco.setAttribute('height',200);
            marco.setAttribute('width',270);
        }
        toggleModal();
    }
</script>
@endpush

@endsection
