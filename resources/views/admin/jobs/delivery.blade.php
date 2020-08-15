@extends('layouts.dashboard')

@section('content')


{{-- nuevo --}}
<div class="card mt-6 md:w-10/12 bg-white shadow-lg p-3 rounded-sm mx-auto flex items-center justify-between">
    <div>
        <p class="text-md text-primary-500 font-semibold">{{$delivery->job->subject->name}}</p>
        <p class="text-sm text-primary-400">{{$delivery->job->subject->course->name}}</p>
    </div>
    <div>
          <a href="{{route('job.deliveries', $delivery->job)}}" class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
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
                        Entrega: {{$delivery->job->title}}
                    </h1>
                    <div class="text-sm text-gray-700">
                        Fecha de Inicio: {{$delivery->job->start->format('d-m-Y')}}
                    </div>
                </div>
            </div>

            <div class="w-3/12">
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
            </div>

        </div>

        {{-- estados responsive --}}
        <div class="text-right">
            {{-- <span class="rounded-full text-gray-100 bg-blue-400 px-2 py-1 text-xs font-medium md:hidden">{{$delivery->state($delivery->state)}}</span> --}}
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
        </div>
        <div class="text-sm text-gray-700 text-right">
            Fecha de Entrega: {{$delivery->job->end->format('d-m-Y')}}
        </div>

        <div class=" w-full flex relative items-center border-b mb-2 py-3">
            <div class="">
                <img class="w-8 h-8 rounded-full object-cover mr-4 shadow" src="{{asset('img/avatar/user.png')}}" alt="avatar">
            </div>
            <div class="flex w-full pt-1">
                <div class="w-full">
                    <div class="w-9/12">
                        <h2 class="text-sm font-medium text-gray-900 -mt-1">{{$delivery->student->name}} </h2>
                        <p class="text-gray-700 font-light text-xs">Entregada el {{$delivery->created_at->format('d-m-Y')}}</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="flex justify-center p-2">
            {{-- Youtube --}}
            @if ($delivery->link)
            <iframe id="player" type="text/html" width="800" height="600"
                src="http://www.youtube.com/embed/{{$vid}}" frameborder="0" allowfullscreen></iframe>
            @endif
       </div>

       @if ($delivery->file_path)
           <div class="flex justify-center p-2 mt-2">
               <iframe id="viewer" height="600" width="800" frameborder="0"></iframe>
           </div>
           <a id="descargarFile" href="{{route('descargarDelivery', $delivery)}}" class="bg-teal-500 rounded p-2" hidden>Descargar Entrega</a>
       @endif


        <form action="{{route('delivery.update', $delivery->id)}}" method="POST" onsubmit="return disableButton();">
            @method('PUT')
            @csrf
            <input type="text" hidden name="id_job" value="{{$delivery->job->id}}">
            <div class="border-t mt-3 flex py-6 text-gray-700 text-sm">
                {{-- estados --}}
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    Actualizar Estado
                    </label>
                    <div class="relative">
                        <select onchange="setCode()"  id="state" name="state"  class="block hover:bg-gray-300 appearance-none w-full bg-gray-200 border-gray-200 text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-primary-400 border-b-2" id="grid-state">
                            <option disabled selected value> {{$delivery->state($delivery->state)}} </option>
                            <option value="1">Rehacer</option>
                            <option value="2">Aprobado</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                        </div>
                </div>
            </div>

            <button type="submit" class="flex mx-auto btn btn-primary" id="entregaDisabled">Guardar</button>
        </form>

        {{-- Movimientos de la tarea --}}
        <div class="border rounded-sm mt-6 py-4 text-gray-700 text-sm w-full px-3 mb-6 md:mb-0">
            <div class="border-b">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Historial de Entregas
                </label>
            </div>

            <div>
            @if ($activities)
            <div class="card-body py-2 my-2">
                <div class="overflow-x-auto">
                    <table class="table-auto border-collapse w-full">
                        <thead>
                            <tr class="px-5 py-3 border-b border-primary-400 text-left font-semibold text-gray-800">
                                <th class="px-1 py-2">Fecha</th>
                                <th class="px-1 py-2">Actividad</th>
                                <th class="px-1 py-2" >Actor</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                            @foreach ($activities as $activity)
                                <tr class="hover:bg-gray-100 border-b border-gray-200 bg-white text-sm">
                                    <td class="px-1 py-2">{{$activity->created_at->format('d-m-Y')}}</td>
                                    <td class="px-1 py-2">{{$activity->description}}</td>
                                    <td class="px-1 py-2 mt-1 hidden md:block">{{$activity->causer->name}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

                @else
                <div class="card w-full rounded-sm bg-gray-100 mx-auto mt-6 mb-4">
                    <div class="alert flex flex-row items-center bg-blue-100 p-5 rounded border-b-2 border-blue-300">
                        <div class="alert-icon flex items-center bg-blue-100 border-2 border-blue-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                            <span class="text-blue-500">
                                <svg fill="currentColor"
                                    viewBox="0 0 20 20"
                                    class="h-6 w-6">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="alert-content ml-4">
                            <div class="alert-title font-semibold text-lg text-blue-800">
                                Información
                            </div>
                            <div class="alert-description text-sm text-blue-600">
                                Aún no hay ningún movimiento!
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
        {{-- end log entrega --}}

        {{-- Comentarios --}}
        <div class="border-t mt-3 flex pt-3 text-gray-700 text-sm">
            <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
            </svg>
            <span> Comentarios de la entrega</span>
        </div>

        <div class="flex justify-start mt-2 mb-8">
            <div class="w-full">
                @foreach ($delivery->comments as $item)
                <div class=" w-full flex relative items-center mt-3">
                    <div class="p-2">
                        <img class="w-8 h-8 rounded-full object-cover mr-1 shadow" src="{{asset('img/avatar/user.png')}}" alt="avatar">
                    </div>

                    <div class="w-full">
                        @if ($item->user->roles[0]->name === 'teacher')
                            <h2 class="text-sm font-medium text-gray-900">{{$item->user->teacher->name}} </h2>
                        @else
                        <h2 class="text-sm font-medium text-gray-900">{{$item->user->student->name}} </h2>

                        @endif


                            {{-- <h2 class="text-sm font-medium text-gray-900">{{$item->user->teacher->name}} </h2> --}}

                        <p class="text-gray-700 font-light text-xs">{{$item->created_at->diffForHumans()}} </p>

                    </div>
                </div>

                <div class="text-sm text-gray-700 w-full px-2">
                    <p class="text-sm font-medium text-gray-900 ml-10">{{$item->comment}}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="border-t mt-3 mb-6 pt-6 text-gray-700 text-sm w-full">
        <form action="{{route('comments.store')}}" method="POST" id="formDelivery">
                @csrf
                <input type="text" name="delivery" value="{{$delivery->id}}" hidden>
                {{-- <div
                    class="border border-gray-400 bg-white h-10 rounded-sm py-1 content-center flex items-center"> --}}
                    {{-- <input name="comment" type="text" class="bg-transparent focus:outline-none w-full text-sm p-2 text-gray-800" placeholder="Agregar un comentario"> --}}
                    <textarea name="comment" onkeyup="setCommentDelivery()" id="commentDelivery" cols="30" rows="5" class="border border-gray-400 bg-white focus:outline-none w-full text-sm p-2 text-gray-800" id="grid-last-name" type="text" placeholder="Comentario de la entrega" value="" maxlength="3001"></textarea>
                <span class="flex italic text-red-600  text-sm" role="alert" id="commentDeliveryError">
                    {{$errors->first('title')}}
                </span>

                <button type="submit" class="flex mx-auto btn btn-primary" id="entregaDisabledComments">Comentar</button>
                {{-- </div> --}}
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')

    {{-- script archivos --}}
    <script>
        let aux = @json($file);
        let ancho = screen.width;
        let descFile = document.getElementById('descargarFile');

        if (aux) {
            let tipos = ['png', 'jpg', 'pdf'];

            let aux1 = 0;

            tipos.forEach(element => {
                if (aux.search(element) > 0) {
                    aux1 = aux.search(element);
                }
            });

            if (aux1 == 0) {
                document.getElementById('viewer').setAttribute('src', 'https://view.officeapps.live.com/op/embed.aspx?src='+aux);
            } else if (ancho <= 640) {
                document.getElementById('viewer').classList.toggle('hidden');
                descFile.removeAttribute('hidden');
            } else {
                document.getElementById('viewer').setAttribute('src', aux);
            }
        }

        if (ancho <= 640) {
            let marco = document.getElementById('viewer');
            marco.setAttribute('height',500);
            marco.setAttribute('width',270);

            let marco2 = document.getElementById('player');
            marco2.setAttribute('height',200);
            marco2.setAttribute('width',270);
        }
    </script>

    <script>

    //Validación input comentario
    const commentDelivery = document.getElementById("commentDelivery")
    const commentDeliveryError = document.getElementById("commentDeliveryError")
    const formDelivery = document.getElementById("formDelivery")

    function setCommentDelivery(){
        document.getElementById("entregaDisabledComments").disabled = false;
        if (commentDelivery.value.length > 3000){
            document.getElementById("commentDeliveryError").innerHTML = "No puede tener más de 3000 caracteres"
            commentDelivery.classList.add("form-input-error")
        }
        if (commentDelivery.value.length > 2){
            document.getElementById("commentDeliveryError").innerHTML = ""
            commentDelivery.classList.remove("form-input-error")
            commentDelivery.className = ' bg-transparent focus:outline-none w-full text-sm p-3 text-gray-800 placeholder-gray-500 border border-gray-400'
        }
    }

    formDelivery.addEventListener("submit", e=>{

    commentDeliveryError.innerHTML = ""

    if (commentDelivery.value.length < 3){
        e.preventDefault()
        document.getElementById("commentDeliveryError").innerHTML = "Debe tener al menos 3 caracteres"
        commentDelivery.className = ' bg-transparent focus:outline-none w-full text-sm p-3 text-gray-800 border border-red-500'
    }

    document.getElementById("entregaDisabledComments").disabled = true;

    })
    // end validation

    function disableButton(){
        document.getElementById("entregaDisabled").disabled = true;
    }

    </script>
@endpush
