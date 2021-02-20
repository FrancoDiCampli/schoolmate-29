@extends('layouts.dashboard')

@section('content')

<div class="card mt-6 md:w-10/12 bg-white shadow-lg p-3 rounded-sm mx-auto flex items-center justify-between">
    <div>
        <p class="text-md text-primary-500 font-semibold">Notificaciones</p>
        {{-- <p class="text-sm text-primary-400">{{$cant}} </p> --}}
        <a onclick="return confirm('¿Desea eliminar todas las notificaciones?')" href="{{route('deleteNotif')}}"
            class="flex mx-auto btn btn-primary">Eliminar todas</a>
    </div>
    <div>
        <a href="{{URL::previous()}}"
            class="flex text-teal-600 font-semibold p-3 rounded-full hover:bg-gray-200 mx-1 focus:shadow-sm focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" viewBox="0 0 306 306">
                <path data-original="#000000" class="active-path" data-old_color="#000000" fill="#A0AEC0"
                    d="M247.35 35.7L211.65 0l-153 153 153 153 35.7-35.7L130.05 153z" /></svg>
        </a>
    </div>
</div>

{{-- card --}}
<div class="flex justify-center mt-2 mb-8">
    <div class="card bg-white rounded-sm w-full md:w-10/12 p-4 shadow-lg">
        <div class=" w-full flex relative items-center border-b">

            <table class="w-full">
                <tbody class="">
                    @foreach ($todas as $item)
                    <tr
                        class="relative transform scale-100 text-xs py-1 border-b border-primary-100 border-opacity-25 cursor-default">
                        <td class="pl-5 pr-3 whitespace-no-wrap">
                            <div class="text-gray-600">{{$item->created_at->diffForHumans()}}</div>
                            {{-- <div>07:45</div> --}}
                        </td>

                        <td class="px-2 py-2 whitespace-no-wrap font-montserrat">
                            <div class=" text-gray-600 font-medium">{{$item->data['message']}}</div>
                            <div
                                class="leading-3 text-gray-900 text-base font-medium hover:text-primary-500 focus:outline-none">

                                @hasanyrole('teacher|adviser')
                                @if ($item->type == 'App\Notifications\JobCreated' || $item->type ==
                                'App\Notifications\JobUpdated' )
                                <a class="rounded text-gray-600 hover:text-bluedark-500 font-bold p-1 font-montserrat"
                                    href="{{route('jobs.showJob', $item->data['job_id'])}}">
                                    <pre
                                        class="font-semibold font-montserrat mr-2 text-left flex-auto">{{$item->data['message']}} - {{$item->data['teacher']}}</pre>
                                </a>
                                @endif
                                @endhasanyrole

                                @role('student')
                                @if ($item->type == 'App\Notifications\JobCreated')
                                <a class="rounded text-gray-600 hover:text-bluedark-500 font-bold p-1"
                                    href="{{route('deliver', $item->data['job_id'])}}">
                                    <pre
                                        class="font-semibold font-montserrat mr-2 text-left flex-auto">{{$item->data['teacher']}}</pre>
                                </a>
                                @elseif($item->type == 'App\Notifications\PostCreated')
                                <a class="rounded text-gray-600 hover:text-bluedark-500 font-bold p-1 font-montserrat"
                                    href="{{route('posts.show', $item->data['post_id'])}}">
                                    <pre
                                        class="font-semibold font-montserrat mr-2 text-left flex-auto">{{$item->data['post']}}</pre>
                                </a>
                                @else
                                <a class="rounded text-gray-600 hover:text-bluedark-500 font-bold p-1 font-montserrat"
                                    href="{{route('deliver', $item->data['job_id'])}}">
                                    <pre
                                        class="font-semibold font-montserrat mr-2 text-left flex-auto">{{$item->data['student']}}</pre>
                                </a>
                                @endif
                                @endrole

                                @role('teacher')
                                @if ($item->type == 'App\Notifications\DeliveryCreated' || $item->type ==
                                'App\Notifications\DeliveryUpdated')
                                <a class="rounded text-gray-600 hover:text-bluedark-500 font-bold p-1 font-montserrat break-all"
                                    href="{{route('job.delivery', $item->data['delivery_id'])}}">
                                    <pre
                                        class="font-semibold font-montserrat mr-2 text-left flex-auto">{{$item->data['student']}}</pre>
                                </a>
                                @endif
                                @endrole

                            </div>
        </div>
        <div class="leading-5 text-primary-300">{{$item->data['subject']}}</div>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{$todas->links()}}
    </div>
</div>
</div>

<!-- component -->
{{-- <div class="container mx-auto py-10 flex justify-center h-screen">
      <div class="w-4/12 pl-4  h-full flex flex-col">
            <div class="bg-white text-sm text-gray-500 font-bold px-5 py-2 shadow border-b border-gray-300">
                Tracking events
            </div>

            <div class="w-full h-full overflow-auto shadow bg-white" id="journal-scroll">

            <table class="w-full">
                <tbody class="">
                    <tr class="relative transform scale-100 text-xs py-1 border-b-2 border-blue-100 cursor-default">
                        <td class="pl-5 pr-3 whitespace-no-wrap">
                            <div class="text-gray-400">24 jule</div>
                            <div>07:45</div>
                        </td>

                        <td class="px-2 py-2 whitespace-no-wrap">
                            <div class="leading-5 text-gray-500 font-medium">Taylor Otwel</div>
                            <div class="leading-5 text-gray-900">Create pull request #1213
                                <a class="text-blue-500 hover:underline" href="#">#231231</a></div>
                            <div class="leading-5 text-gray-800">Hello message</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
    </div>
  </div> --}}

@endsection