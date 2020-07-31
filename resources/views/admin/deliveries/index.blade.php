@extends('layouts.dashboard')

@section('content')

    <div class="md:w-6/12 mx-auto">


        @foreach ($deliveries as $delivery)
        <div class="card w-full  bg-white shadow-lg p-5 border-l-2 border-teal-600 rounded-sm">
            <div class=" w-full  flex justify-end relative">
                <button onclick="toogleFm()" class="focus:outline-none">
                                      <svg aria-hidden="true" data-prefix="fas" data-icon="ellipsis-v"
                    class=" h-4 w-4  svg-inline--fa fa-ellipsis-v fa-w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"/></svg>

                </button>
                    <div id="float-menu" class="hidden border bg-white absolute p-2 text-sm w-6/12 md:w-3/12  top-10 right-0 shadow-lg
                    rounded-sm" >
                    <a href="" class="block py-2">Comments</a>

                        <a href="" class="block py-2">Option C</a>
                </div>

            </div>

            <div class="flex justify-between items-center">
                <div class="text-gray-700">
                    <h1 class="font-semibold"> {{$delivery->job->subject->name}}</h1>
                    <h3>{{$delivery->job->title}}</h3>
                    <p class="italic">Fecha de entrega <span> {{$delivery->created_at->format('d-m')}}</span> </p>
                </div>
                <div>
                    <button class="bg-red-600 rounded-full text-white py-1 px-5">{{$delivery->state($delivery->state)}}</button>
                </div>
            </div>

        </div>

        @endforeach


    </div>

@push('js')
    <script>
        let fm = document.getElementById('float-menu')
        let oo = document.getElementById('orderOption')

        let bt = document.getElementsByClassName('btn')

        Array.from(bt).forEach(function(element) {
        element.addEventListener('click', setOrder);
        });

        function setOrder(){
            let attribute = this.getAttribute("data-order");

            document.getElementById('topic').innerHTML = attribute

        }

        function toogleFm(){
            fm.classList.toggle('hidden')

        }
        function toogleOrder(){
            oo.classList.toggle('hidden')

        }


    </script>
@endpush
@endsection
