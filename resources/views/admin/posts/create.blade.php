@extends('layouts.dashboard')

@section('content')


{{-- card post --}}
<div class="container font-montserrat text-sm mb-8">
    <div class="card  rounded-sm bg-gray-100 mx-auto mt-6 shadow-lg md:w-10/12">
        <div class="card-title bg-white w-full p-5 border-b flex items-center justify-between md:justify-between">
            <div>
                <p class="sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold placeholder-gray-700">Nueva Publicación</p>
                <p class="md:text-md text-sm text-primary-500 font-semibold">{{$subject->name}}</p>
                <p class="md:text-sm text-xs text-primary-400">{{$subject->course->name}}</p>
            </div>
            <a href="{{route('posts.index', $subject->id)}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>
              </a>
        </div>
        <div class="card-body py-4">
            <form method="POST" action="{{ route('posts.store') }}" class="mx-auto" id="formPostCreate">
                @csrf
                <input hidden type="text" value="{{$subject->id}}" name="subject_id" >
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Título
                        </label>
                        <input type="text" id="tituloPost" onkeyup="setPost()" name="title" class="form-input w-full block" id="grid-last-name" type="text" placeholder="Título de la publicación" maxlength="41" required value="{{ old('title') }}">
                        <span class="flex italic text-red-600  text-sm" role="alert" id="postTituloError">
                            {{$errors->first('title')}}
                        </span>
                    </div>
                </div>
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Descripción
                        </label>
                        <input type="text" id="description" onkeyup="setDescription()" name="description" class="form-input w-full block" id="grid-last-name" type="text" placeholder="Breve descripción de la publicación" maxlength="91" required value="{{ old('description') }}">
                        <span class="flex italic text-red-600  text-sm" role="alert" id="descriptionError">
                            {{$errors->first('description')}}
                        </span>
                    </div>
                </div>
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-full px-6 md:mb-0 mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Contenido
                        </label>
                        <textarea name="content" id="content" onkeyup="contenido()" cols="30" rows="10" class="form-input w-full block" id="grid-last-name" type="text" placeholder="Contenido de la publicación">{{ old('content') }}</textarea>
                        <span class="flex italic text-red-600  text-sm" role="alert" id="contentPostError">
                            {{$errors->first('content')}}
                        </span>
                    </div>
                </div>

                <button type="submit" class="flex mx-auto btn btn-primary" id="entregaDisabledComments">Publicar</button>

            </form>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>

    const postTitulo = document.getElementById('tituloPost');
    const description = document.getElementById('description');
    const contentPost = document.getElementById('content');
    const formPostCreate = document.getElementById('formPostCreate');


    // seteos validatios
    function setPost(){
        if (postTitulo.value.length > 40){
            document.getElementById("postTituloError").innerHTML = "No puede tener más de 40 caracteres";
            postTitulo.classList.add("form-input-error")
        }
        if (postTitulo.value.length < 41){
            document.getElementById("postTituloError").innerHTML = ""
            postTitulo.classList.remove("form-input-error")
        }
        if (postTitulo.value.length <= 4){
            document.getElementById("postTituloError").innerHTML = "Debe tener al menos 5 caracteres"
            postTitulo.classList.add("form-input-error")
        }
    }

    function setDescription(){
        if (description.value.length > 90){
            document.getElementById("descriptionError").innerHTML = "No puede tener más de 90 caracteres";
            description.classList.add("form-input-error")
        }
        if (description.value.length < 91){
            document.getElementById("descriptionError").innerHTML = ""
            description.classList.remove("form-input-error")
        }
        if (description.value.length <= 19){
            document.getElementById("descriptionError").innerHTML = "Debe tener al menos 20 caracteres"
            description.classList.add("form-input-error")
        }
    }

    function contenido(){
        if (contentPost.value.length > 3000){
            document.getElementById("contentPostError").innerHTML = "No puede tener más de 3000 caracteres";
            contentPost.classList.add("form-input-error")
        }
        if (contentPost.value.length <= 3000){
            document.getElementById("contentPostError").innerHTML = ""
            contentPost.classList.remove("form-input-error")
        }
        if (contentPost.value.length <= 20){
            document.getElementById("contentPostError").innerHTML = "Debe tener al menos 20 caracteres"
            contentPost.classList.add("form-input-error")
        }
    }

    formPostCreate.addEventListener("submit", e=>{

    document.getElementById("entregaDisabledComments").disabled = true;

    })


</script>

@endpush

