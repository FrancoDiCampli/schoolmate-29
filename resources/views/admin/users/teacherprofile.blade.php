@extends('layouts.dashboard')

@section('content')

{{-- Encabezado --}}
<div class="card md:w-10/12 rounded-sm bg-gray-100 mx-auto mt-6 mb-4 shadow-lg">
    <div class="card-title bg-white w-full p-5 border-b items-center justify-between">
        {{-- header --}}
        <div class="flex justify-between">
            <div>
                <p class="sm:text-lg md:text-xl lg:text-2xl xl:text-2xl font-semibold placeholder-gray-700">Mi Perfil</p>
            </div>
            <div>
            @role('teacher')
            <a href="{{route('teacher')}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>
                  </a>
            </div>
            @else
            <a href="{{route('student')}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306"><path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0" d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z"/></svg>
              </a>
            </div>
            @endrole
        </div>
        {{-- end header --}}

        <div class="flex">
            <p>foto</p>
            <p class="mx-4">nombre apelldio</p>
        </div>
    </div>

    {{-- cuerpo --}}
    <div class="w-auto mx-auto flex items-center justify-between p-5">
        <p>kajjsdh</p>
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
    </script>
@endpush
