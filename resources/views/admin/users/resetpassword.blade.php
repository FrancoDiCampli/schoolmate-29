@extends('layouts.dashboard')

@section('content')
<div class="container font-montserrat text-sm">
    <div class="card  rounded-sm bg-gray-100 mx-auto mt-6 shadow-lg">
        <div class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between">
           <h1 class="text-teal-600 font-semibold md:m-0 m-2 text-lg">Actalizar Contrasenia </h1>

        </div>
        <div class="card-body py-5">
        <form method="POST" action="{{route('reset')}}" enctype="multipart/form-data" class="mx-auto" id="userForm">
                @method('PUT')
                @csrf
        <input type="text" name="id" value="{{$user->id}}" hidden>
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/3 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Contrasenia Actual
                        </label>
                        <input type="password" id="password" name="current_password" class="form-input w-full block"
                             value="">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('current_password')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/3 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Nueva Contrasenia
                        </label>
                        <input type="password" id="newpass" name="password" class="form-input w-full block"
                             value="">
                        <span id="errorMsg" class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('password')}}
                        </span>
                    </div>
                    <div class="w-full md:w-1/3 px-3 md:mb-0 mb-6 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Repetir Nueva Contrasenia
                        </label>
                        <input onchange="testPassword()" type="password" id="renewpass" name="password_confirmation" class="form-input w-full block"
                             value="">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('password_confirmation')}}
                        </span>
                    </div>
                </div>

                <button  type="submit" class="flex mx-auto btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    {{-- <script>
      let form = document.getElementById("userForm").addEventListener("submit", function(e){
        e.preventDefault()

        if( testPassword()){
              document.forms["userForm"].submit();
        }

        });

        function testPassword(){
            let  newpassword = document.getElementById('newpass')
            let renewpassword = document.getElementById('renewpass')
            let msg = document.getElementById('errorMsg')
            if(newpassword.value == renewpassword.value){
                msg.innerHTML = ''
                return true
            }else{
                msg.innerHTML = 'Las contrasenias no coinciden'
                return false
            }
        }
    </script> --}}
@endpush
