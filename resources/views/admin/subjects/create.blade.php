@extends('layouts.dashboard')

@section('content')

<div class="container font-montserrat text-sm ">
    <div class="card  rounded-sm bg-gray-100 mx-auto md:mt-10 shadow-lg">
        <div
            class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between ">
            <h1 class="text-teal-600 font-semibold">Subject</h1>
        </div>
        <div class="card-body py-5">
            <form method="POST" action="{{ route('subjects.store') }}" class="mx-auto">
                @csrf
                <div class="md:flex">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Curso
                        </label>
                        <div class="relative">
                            <select id="course" onchange="setName()" name="course_id"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option disabled selected value> -- seleccione un curso -- </option>
                                @if (count($courses)>0)
                                @foreach ($courses as $course)
                                <option value="{{$course->code}}">{{$course->name . ' - ' . $course->cicle}}</option>
                                @endforeach
                                @else
                                <option disabled selected value> -- No posee cursos registrados -- </option>
                                @endif
                            </select>
                            <span class="flex italic text-red-600  text-sm" role="alert">
                                {{$errors->first('course_id')}}
                            </span>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Profesor
                        </label>
                        <div class="relative">
                            <select id="teacher" onchange="setName()" id="" name="teacher_id"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option disabled selected value> -- seleccione un profesor -- </option>
                                @if (count($teachers)>0)
                                @foreach ($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                                @else
                                <option disabled selected value> -- no posee profesores registrados -- </option>
                                @endif
                            </select>
                            <span class="flex italic text-red-600  text-sm" role="alert">
                                {{$errors->first('teacher_id')}}
                            </span>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Activa
                        </label>
                        <div class="w-full md:w-1/2 px-3">
                            <input type="checkbox" name="active" id="">
                        </div>
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('active')}}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Materia
                        </label>
                        <input type="text" id="subjectname" onkeyup="setName()" name="name" value=""
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="text" placeholder="Escriba el nombre de la materia">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('name')}}
                        </span>
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Codigo
                        </label>
                        <input id="code" type="text" name="code"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="text" placeholder="ex: M1A2020">
                        <span class="flex italic text-red-600  text-sm" role="alert">
                            {{$errors->first('code')}}
                        </span>
                        <small class="text-xs italic text-gray-500">Se genera cod. sugerido automaticamente </small>
                    </div>
                </div>

                <button type="submit"
                    class="w-8/12 mb-5 font-semibold md:w-5/12 py-2 flex mx-auto  justify-center bg-teal-600 text-gray-200 ">Save</button>

            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    let y = new Date();
        let n = y.getFullYear();

        let nombre = document.querySelector('#subjectname')

        function setName(){
            if(nombre.value.length >1){
                let letter = nombre.value.substr(0,1)
                let val = document.querySelector('#code')
                let curso = document.querySelector('#course')
                val.value = letter + curso.value.substr(0,2) + n
            }

        }

    function setCode(){

    }
</script>
@endpush
@endsection