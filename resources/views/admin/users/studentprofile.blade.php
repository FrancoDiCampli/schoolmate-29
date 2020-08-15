@extends('layouts.dashboard')

@section('content')

<div class="container font-montserrat text-sm">
    <div class="card  rounded-sm bg-gray-100 mx-auto mt-6 shadow-lg">
        <div class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between">
           <h1 class="text-teal-600 font-semibold md:m-0 m-2 text-lg">Editar Usuario </h1>
        <a href="{{route('user.reset',$user)}}" class="flex mx-auto btn btn-primary">Cambiar Contrasenia</a>
            <a href="" class="flex hover:shadow-lg md:m-0 m-2 px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>
            </a>
        </div>
        <div class="card-body py-5">
            <form method="POST" action="{{ route('update.student',$user->student)}}" enctype="multipart/form-data" class="mx-auto" >
                @method('PUT')
                @csrf


                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/3 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Nombre
                        </label>
                        <input type="text" id="name" name="name" class="form-input w-full block"
                             placeholder="Nombre" value="{{$user->name}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('name')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          DNI
                        </label>
                        <input id="dni" type="text"  name="dni" class="form-input w-full block"
                            type="text" placeholder="Ej: 22212222" value="{{$user->student->dni}}">
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
                             placeholder="CUIL" value="{{$user->student->cuil}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('cuil')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Fecha de Nacimiento
                        </label>
                        <input type="date" id="start" name="fnac" class="form-input w-full block" id="grid-last-name" type="text"
                        value="{{$user->student->fnac}}">

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
                             placeholder="Telefono" value="{{$user->student->phone}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('phone')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                         Email
                        </label>
                        <input type="email" id="name" name="email" class="form-input w-full block"
                        placeholder="Email" value="{{$user->student->email}}">
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
                             placeholder="Telefono" value="{{$user->student->address}}">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('address')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                         Legajo
                        </label>
                        <input type="text" id="name" name="docket" class="form-input w-full block"
                        placeholder="Legajo" value="{{$user->student->docket}}">
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
                        <img class="w-32 h-32 object-cover object-center  visible group-hover:hidden"
                                src="{{asset($user->photo)}}" alt="">

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
                <button type="submit" class="flex mx-auto btn btn-primary">Actualizar Informacion</button>

            </form>

        </div>
    </div>
</div>
@push('js')
    <script>
        function setName(){
        let fileName = document.getElementById('fileName');
        var cad = fileName.value;
        cad = cad.split('\\');
        let selected = document.getElementById('selected');
        selected.innerHTML = cad[2];

    }
    </script>
@endpush
@endsection
