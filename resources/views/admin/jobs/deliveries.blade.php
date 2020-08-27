@extends('layouts.dashboard')

@section('content')

{{-- Nuevo --}}
{{-- nuevo --}}
<div class="card mt-6 w-full md:w-10/12 bg-white shadow-lg p-3 rounded-sm mx-auto flex items-center justify-between">
    <div>
        <p class="text-md text-primary-500 font-semibold">{{$job->subject->name}}</p>
        <p class="text-sm text-primary-400">{{$job->subject->course->name}}</p>
    </div>
    <div>
          <a href="{{route('jobs.index', $job->subject->id)}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
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
            <div class="flex w-full">
                <div class="w-2/3">
                    <h1 class="font-semibold text-gray-800 text-lg">
                        ENTREGAS {{$job->title}}
                    </h1>
                    <div class="text-sm text-gray-700">
                        Fecha de Inicio: {{$job->start->format('d-m-Y')}}
                    </div>
                </div>
            </div>

            @if ($job->state($job->state) === "Borrador")
            <span class="float-right rounded-full text-gray-100 bg-gray-600 px-2 py-1 text-xs font-medium hidden md:block">{{$job->state($job->state)}}</span>
            @endif
            @if ($job->state($job->state) === "Rechazado")
                <span class="float-right rounded-full text-red-100 bg-red-600 px-2 py-1 text-xs font-medium hidden md:block">{{$job->state($job->state)}}</span>
            @endif
            @if ($job->state($job->state) === "Activa")
                <span class="float-right rounded-full text-green-100 bg-green-600 px-2 py-1 text-xs font-medium hidden md:block">{{$job->state($job->state)}}</span>
            @endif
        </div>

        <div class="text-right">
            @if ($job->state($job->state) === "Borrador")
            <span class="rounded-full text-gray-100 bg-gray-600 px-2 py-1 text-xs font-medium md:hidden">{{$job->state($job->state)}}</span>
            @endif
            @if ($job->state($job->state) === "Rechazado")
                <span class="rounded-full text-red-100 bg-red-600 px-2 py-1 text-xs font-medium md:hidden">{{$job->state($job->state)}}</span>
            @endif
            @if ($job->state($job->state) === "Activa")
                <span class="rounded-full text-green-100 bg-green-600 px-2 py-1 text-xs font-medium md:hidden">{{$job->state($job->state)}}</span>
            @endif
        </div>
        <div class="text-sm text-gray-700 text-right my-2">
            Fecha de Entrega: {{$job->end->format('d-m-Y')}}
        </div>

        {{-- Exportar planillas de entregas --}}
        <div class="flex w-auto">
            <a target="_blank" href="{{route('entregasPDF', $job->id)}}" class="flex items-center btn btn-primary">Exportar
                <svg aria-hidden="true" data-prefix="far" data-icon="file-pdf" class="ml-2 h-6 w-6 svg-inline--fa fa-file-pdf fa-w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm250.2-143.7c-12.2-12-47-8.7-64.4-6.5-17.2-10.5-28.7-25-36.8-46.3 3.9-16.1 10.1-40.6 5.4-56-4.2-26.2-37.8-23.6-42.6-5.9-4.4 16.1-.4 38.5 7 67.1-10 23.9-24.9 56-35.4 74.4-20 10.3-47 26.2-51 46.2-3.3 15.8 26 55.2 76.1-31.2 22.4-7.4 46.8-16.5 68.4-20.1 18.9 10.2 41 17 55.8 17 25.5 0 28-28.2 17.5-38.7zm-198.1 77.8c5.1-13.7 24.5-29.5 30.4-35-19 30.3-30.4 35.7-30.4 35zm81.6-190.6c7.4 0 6.7 32.1 1.8 40.8-4.4-13.9-4.3-40.8-1.8-40.8zm-24.4 136.6c9.7-16.9 18-37 24.7-54.7 8.3 15.1 18.9 27.2 30.1 35.5-20.8 4.3-38.9 13.1-54.8 19.2zm131.6-5s-5 6-37.3-7.8c35.1-2.6 40.9 5.4 37.3 7.8z"/></svg>
            </a>
        </div>


        {{-- prueba --}}
        <div class="card-body py-2 my-2">
            <div class="overflow-x-auto">
                <table class="table-auto border-collapse w-full">
                    <thead>
                        <tr class="px-5 py-3 border-b border-primary-400 text-left font-semibold text-gray-800">
                            <th class="px-4 py-2">Alumno</th>
                            <th class="px-4 py-2" >Entrega</th>
                            <th class="px-4 py-2" >Estado</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-normal text-gray-700">
                        @foreach ($entregas ?? [] as $entrega)
                            <tr class="hover:bg-gray-100 border-b border-gray-200 bg-white text-sm">
                                <td class="px-4 py-2">{{$entrega->student->name}}</td>
                                <td class="px-4 py-2 mt-1">{{$entrega->created_at->format('d-m-Y')}}</td>
                                <td class="px-4 py-2">
                                    @if ($entrega->state($entrega->state) === "Aprobado")
                                    <span class="bg-green-200 py-1 px-2 rounded-full text-green-800">{{$entrega->state($entrega->state)}}</span>
                                    @endif
                                    @if ($entrega->state($entrega->state) === "En corrección")
                                    <span class="bg-gray-200 py-1 px-2 rounded-full text-gray-800">{{$entrega->state($entrega->state)}}</span>
                                    @endif
                                    {{-- @if ($entrega->state($entrega->state) === "Rehacer")
                                    <span class="bg-orange-200 py-1 px-2 rounded-full text-orange-800">{{$entrega->state($entrega->state)}}</span>
                                    @endif --}}
                                    @if ($entrega->state($entrega->state) === "Rehacer")
                                    <span class="bg-red-200 py-1 px-2 rounded-full text-red-800">{{$entrega->state($entrega->state)}}</span>
                                    @endif

                                    </td>
                                <td class="px-4 py-2">
                                    <div class="flex">
                                        <a href="{{route('job.delivery', $entrega->id)}}" class="mx-1 text-blue-400 hover:bg-gray-200 rounded-full p-2 focus:bg-gray-300">
                                            <svg aria-hidden="true" data-prefix="fas" data-icon="info" class="h-4 w-4 svg-inline--fa fa-info fa-w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($alumnos ?? [] as $alumno)
                            <tr class="hover:bg-gray-100 border-b border-gray-200 bg-white text-sm">
                                <td class="px-4 py-2">{{$alumno->name}}</td>
                                <td class="px-4 py-2 ">S/E</td>
                                <td class="px-4 py-2">
                                    <span class="">S/E</span>
                                    </td>
                                <td class="px-4 py-2">
                                    <span class="">S/E</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
