@extends('layouts.dashboard')

@section('content')

{{-- Encabezado --}}
<div class="card md:w-10/12 rounded-sm bg-gray-100 mx-auto mt-6 mb-4 shadow-lg">
    <div class="card-title bg-white w-full p-5 border-b items-center justify-between">
        {{-- header --}}
        <div class="flex justify-between items-center">
            <div>
                <p class="sm:text-lg md:text-xl lg:text-2xl xl:text-2xl font-semibold placeholder-gray-700">Mi Perfil
                </p>
            </div>
            <div>
                @role('admin')
                <a href="{{URL::previous()}}"
                    class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306">
                        <path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0"
                            d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z" /></svg>
                </a>
            </div>
            @elserole('teacher')
            <a href="{{route('teacher')}}"
                class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306">
                    <path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0"
                        d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z" /></svg>
            </a>
        </div>
        @else
        <a href="{{route('student')}}"
            class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306">
                <path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0"
                    d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z" /></svg>
        </a>
    </div>
    @endrole
</div>
{{-- end header --}}

<div class="md:flex w-full mt-4">
    <div class="z-50">
        @if ($user->student->photo)
        <img class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 mx-auto md:mr-4"
            src="{{asset($user->student->photo)}}" alt="avatar">
        @else
        <img class="w-24 h-24 rounded-full object-cover mr-4 shadow hidden md:block"
            src="{{asset('img/avatar/user.png')}}" alt="avatar">
        @endif
    </div>
    <div class="pt-3 text-center md:text-left">
        <p class="mx-2 font-semibold text-gray-800 text-lg">{{$user->name}}</p>
        <p class="mx-2 text-gray-700 text-base">DNI: {{$user->student->dni}}</p>
        <p class="mx-2 text-gray-600 text-sm">Legajo: @if($user->student->docket) {{$user->student->docket}} @else S/L
            @endif</p>
    </div>

</div>
</div>

{{-- cuerpo --}}
<div class="card-body py-5 px-4">
    <p class="mx-2 mt-2 mb-6 font-semibold text-gray-800 text-lg">Datos Personales</p>
    <form method="POST" action="{{ route('update.student',$user->student)}}" enctype="multipart/form-data"
        class="mx-auto">
        @method('PUT')
        @csrf
        <input type="text" name="user_id" value="{{$user->id}}" hidden>


        <div class="flex flex-wrap my-5">
            <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Nombre
                </label>
                <input type="text" id="name" name="name" class="form-input w-full block" placeholder="Nombre"
                    value="{{$user->name}}" @role('teacher|student') readonly @endrole>
                <span class="flex italic text-gray-600  text-xs" role="alert">
                    @role('teacher|student')Solicitar a la instituci??n el cambio de nombre. @endrole
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    DNI
                </label>
                <input id="dni" type="text" name="dni" class="form-input w-full block" type="text"
                    placeholder="Ej: 22212222" value="{{$user->student->dni}}" @role('teacher|student') readonly
                    @endrole>
                <span class="flex italic text-gray-600  text-xs" role="alert">
                    @role('teacher|student') Solicitar a la instituci??n el cambio de DNI. @endrole
                </span>
            </div>

        </div>

        @role('admin|student')
        <div class="flex flex-wrap my-5">
            <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Contrase??a
                </label>

                <input id="password" type="password" minlength="8" name="password" class="form-input w-full block"
                    value="" placeholder="Ingresar nueva contrase??a">

                <div class="flex items-center text-gray-700 pt-1" id="mostrarpass" style="display: flex">
                    <p class="mr-2">Contrase??a oculta</p>
                    <button class="" type="button" onclick="mostrarContrasena()">
                        <svg class="w-6 h-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center text-gray-700 pt-1" style="display: none" id="ocultarpass">
                    <p class="mr-2">Contrase??a visible</p>
                    <button class="" type="button" onclick="mostrarContrasena()">
                        <svg class="w-6 h-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('password')}}
                </span>
            </div>

            <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
                    Confirmar Contrase??a
                </label>

                <input id="password_confirmation" type="password" minlength="8" name="password_confirmation"
                    class="form-input w-full block" value="" placeholder="Confirmar nueva contrase??a">

                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('password_confirmation')}}
                </span>
            </div>
        </div>
        @endrole

        <div class="flex flex-wrap my-5">
            <div class="w-full md:w-1/2 px-3 md:mb-0 mb-6 ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Cuil
                </label>
                <input type="text" id="name" name="cuil" class="form-input w-full block" placeholder="CUIL"
                    value="{{$user->student->cuil}}">
                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('cuil')}}
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Fecha de Nacimiento
                </label>
                <input type="date" max="{{now()->subYear(3)->format('Y-m-d')}}" id="start" name="fnac"
                    class="form-input w-full block" id="grid-last-name" type="text" value="{{$user->student->fnac}}">

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
                <input type="text" id="name" name="phone" class="form-input w-full block" placeholder="Telefono"
                    value="{{$user->student->phone}}">
                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('phone')}}
                </span>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Email
                </label>
                <input type="email" id="name" name="email" class="form-input w-full block" placeholder="Email"
                    value="{{$user->student->email}}">
                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('email')}}
                </span>
            </div>
        </div>

        <div class="flex flex-wrap my-5">
            <div class="w-full md:w-2/2 px-3 md:mb-0 mb-6 ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Domicilio
                </label>
                <input type="text" id="name" name="address" class="form-input w-full block" placeholder="Telefono"
                    value="{{$user->student->address}}">
                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('address')}}
                </span>
            </div>
        </div>

        @role('admin')
        <div class="flex flex-wrap my-5">
            <div class="w-full md:w-2/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Legajo
                </label>
                <input type="text" id="name" name="docket" class="form-input w-full block" placeholder="Legajo"
                    value="{{$user->student->docket}}">
                <span class="flex italic text-red-600  text-sm" role="alert">
                    {{$errors->first('docket')}}
                </span>
            </div>
        </div>
        @endrole


        <div class="flex flex-wrap my-5">
            <div class="w-full md:w-full px-3 md:mb-0 mb-1">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Subir Foto
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
                                <span class="mt-2 text-sm leading-normal text-center" id="selected">Seleccione una foto
                                    de perfil</span>
                                <input type='file' accept="image/*" class="hidden" name="file" id="fileName"
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
        <button type="submit" class="flex mx-auto btn btn-primary mb-5"
            onclick="return confirm('??Confirma la actualizaci??n de los datos?')">Actualizar Informacion</button>

    </form>
</div>

</div>


@endsection

@push('js')
<script>
    function setName(){
        let fileName = document.getElementById('fileName');
        var cad = fileName.value;
        cad = cad.split('\\');
        let selected = document.getElementById('selected');
        selected.innerHTML = cad[2];
    }

    function mostrarContrasena(){
      var tipo = document.getElementById("password");
      var confirm = document.getElementById("password_confirmation");
      var mostrarpass = document.getElementById("mostrarpass");
      var ocultarpass = document.getElementById("ocultarpass");

      if(tipo.type == "password"){
          tipo.type = "text"; 
          confirm.type = "text"; 
          mostrarpass.style.display = 'none';     
          ocultarpass.style.display = 'flex';     
          
      }else{
          tipo.type = "password";
          confirm.type = "password";
          mostrarpass.style.display = 'flex';
          ocultarpass.style.display = 'none';
      }
    }
</script>
@endpush