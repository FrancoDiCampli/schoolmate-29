<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schoolmate</title>
    <link rel="icon" type="image/png" href="{{asset('img/sm-sidebar-png.png')}}" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <style>
        .tooltip .tooltip-text {
            visibility: hidden;

        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
        }
    </style>
</head>

<body class="bg-gray-100 font-montserrat" id="all">
    <div class="loader-container">
        <div class="loader"></div>
        <div class="loader2"></div>
    </div>

    <main id="app" class="">
        <div class="top-navbar w-full mx-auto flex items-center  bg-gray-200 p-3 border-b border-gray-400">
            @php
            // Esta variable es para crear la ruta de inicio, que es distinta dependiendo del rol
            $user = auth()->user()->roles()->first()->name;
            @endphp
            <a href="{{route("$user")}}">
                <img src="{{asset('img/sm-sidebar-png.png')}}" class="md:w-16 md:h-16 w-12 h-12  pl-0 md:ml-10 ml-6 "
                    alt="">
            </a>

            <div class="">
                <h1 class="text-bluedark-400 font-rubik text-2xl ml-12 mr-10 w-auto hidden md:block">Félix<span
                        class="font-semibold">Frías</span></h1>
                <span class="text-bluedark-400 font-rubik text-md ml-12 mr-10 w-auto hidden md:block text-center">UEP N°
                    28</span>
            </div>


            <div class=" w-full flex relative items-center text-right float-right justify-end ">
                <div class="p-2 flex absolute">
                    <button id="boton"
                        class="rounded-full hover:bg-gray-400 focus:shadow-md focus:outline-none md:mr-4 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 55" class="w-6 h-6 m-2">
                            <path
                                d="M51.376 45.291C46.716 40.66 44.354 35.179 44.354 29v-8.994c.043-6.857-4.568-11.405-8.53-13.216-1.117-.51-2.294-.888-3.494-1.178V5c0-2.757-2.243-5-5-5s-5 2.243-5 5v.706c-1.079.283-2.139.629-3.146 1.093-4.379 2.018-8.815 6.882-8.855 13.201v9c0 6.388-2.256 11.869-6.705 16.291a1.002 1.002 0 00.535 1.695l9.491 1.639c1.79.309 3.415.556 4.944.758C20.339 52.804 23.766 55 27.512 55c3.747 0 7.175-2.198 8.919-5.621 1.522-.201 3.139-.447 4.919-.755l9.49-1.639a1 1 0 00.536-1.694zM24.329 5c0-1.654 1.346-3 3-3s3 1.346 3 3v.193a20.176 20.176 0 00-6 .05V5zm-8 16h-.006a1.001 1.001 0 01-.994-1.006c.03-4.682 3.752-7.643 5.948-8.654 3.849-1.775 8.594-1.772 12.469-.002a1 1 0 11-.832 1.818c-3.353-1.533-7.469-1.537-10.799 0-1.767.814-4.762 3.173-4.785 6.85a1 1 0 01-1.001.994zm17.606 28.678C32.416 51.739 30.047 53 27.512 53c-2.534 0-4.902-1.26-6.421-3.32h.001c.396.041.78.073 1.164.106.183.016.371.035.552.05.14.011.275.018.414.028 2.906.212 5.582.212 8.486.005.167-.012.33-.021.499-.034.218-.017.444-.04.665-.059.339-.03.676-.058 1.025-.094l.038-.004z"
                                data-original="#000000" class="active-path" data-old_color="#000000" fill="#0E2A3F" />
                            </svg>
                        @if ($cant > 0)
                        <p class="absolute bg-red-600 justify-center rounded-full px-1 mr-4 text-white text-xs">
                            {{$cant}}</p>
                        @endif
                    </button>

                    {{-- notificaciones --}}
                    <div id="capa" style="display:none;" class="hidden overflow-auto h-48 border bg-white absolute p-2 mt-12 text-sm md:w-auto w-56 mx-auto right-0 shadow-lg z-50
                    rounded-sm text-left md:mr-24 mr-6">
                        @foreach ($noLeidas ?? [] as $item)
                        <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex m-1"
                            role="alert">

                            @hasanyrole('teacher|adviser')
                                @if ($item->type == 'App\Notifications\JobCreated' || $item->type == 'App\Notifications\JobUpdated' )
                                    <a class="rounded text-white font-bold p-1"
                                    href="{{route('jobs.showJob', $item->data['job_id'])}}">
                                    <pre
                                        class="font-semibold antialiased mr-2 text-left flex-auto">{{$item->data['message']}}</pre>
                                    </a>
                                @endif
                            @endhasanyrole

                            @role('student')
                                <a class="rounded text-white font-bold p-1"
                                href="{{route('deliver', $item->data['job_id'])}}">
                                <pre
                                    class="font-semibold antialiased mr-2 text-left flex-auto">{{$item->data['message']}}</pre>
                                </a>
                            @endrole

                            @role('teacher')
                                <a class="rounded text-white font-bold p-1"
                                href="{{route('job.delivery', $item->data['delivery_id'])}}">
                                <pre
                                    class="font-semibold antialiased mr-2 text-left flex-auto">{{$item->data['message']}}</pre>
                                </a>
                            @endrole

                        </div>
                        @endforeach

                        <a href="{{route('notifications')}}"
                            class="bg-teal-600 text-white text-sm p-2 shadow-lg hover:text-gray-700">Ver más</a>
                    </div>
                    {{-- <h2 class="text-sm font-medium text-gray-800 m-2">{{auth()->user()->name}} </h2> --}}
                    <p class="tooltip z-50">
                        <img class="w-10 h-10 rounded-full object-cover mr-4 shadow hidden md:block"
                            src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                            alt="avatar">
                        <span
                            class="tooltip-text hidden md:block bg-gray-600 m-2 -mx-24 absolute text-center text-xs p-1 text-white rounded-md shadow-md">{{Auth::user()->name}}</span>
                    </p>

                </div>
            </div>


            <div class="relative md:w-0 w-2/12 text-right">
                <div id="dropdown"
                    class="hidden transition-all delay-100 bg-white absolute right-0 text-sm text-left w-8/12 p-2 rounded-sm">
                    <a href="" class="block ">Perfil</a>
                    <a href="" class="block ">Logout</a>
                </div>
                <button onclick="setRes()"
                    class="md:hidden text-gray-700 mt-2 ml-2 mr-3 hover:text-gray-900 focus:outline-none">
                    <svg aria-hidden="true" data-prefix="fas" data-icon="bars"
                        class="h-5 w-5 svg-inline--fa fa-bars fa-w-14" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path id="marker" class="hidden" fill="currentColor"
                            d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
                        <path id="bar" fill="currentColor"
                            d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" />
                    </svg>

                </button>
            </div>
        </div>

        <div class="mx-full flex min-h-screen  relative">
            @include('partials.sidebar')

            <div class="main-content md:w-10/12 w-10/12 mx-10">

                {{-- Mensaje de sesion --}}
                <div class="container">
                    @if (session('messages'))
                    <!--Toast-->
                    <div
                        class="alert-toast fixed bottom-auto md:top-0 right-0 m-8 w-5/6 md:w-full max-w-sm items-center z-50">
                        <input type="checkbox" class="hidden" id="footertoast">

                        <label
                            class="close cursor-pointer flex items-start justify-between w-full pl-3 pt-3 bg-greenschool-200 md:h-auto h-auto rounded shadow-lg text-white"
                            title="close" for="footertoast">
                            {{ session('messages') }}

                            <svg class="fill-current text-white mr-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </label>
                    </div>

                    @endif
                </div>

                <div class="container">
                    @if (session('errores'))
                    <!--Toast-->
                    <div class="alert-toast fixed bottom-auto md:top-0 right-0 m-8 w-5/6 md:w-full max-w-sm z-50">
                        <input type="checkbox" class="hidden" id="footertoast">

                        <label
                            class="close cursor-pointer flex items-start justify-between w-full pl-3 pt-3 bg-red-500 sm:h-20 md:h-auto h-auto rounded shadow-lg text-white"
                            title="close" for="footertoast">
                            {{ session('errores') }}

                            <svg class="fill-current text-white mr-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </label>
                    </div>

                    @endif
                </div>

                @yield('content')

            </div>

        </div>
    </main>

    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
    @stack('js')
    <script>
        let sidebar = document.getElementById('sidebar')
        let bar = document.getElementById('bar')
        let marker = document.getElementById('marker')
        function setRes(){
            sidebar.classList.toggle("sidebar-expanded");
            bar.classList.toggle("hidden");
            marker.classList.toggle("hidden");

        }

        let dd = document.getElementById('users-admin')
        function showMenu(){
            dd.classList.toggle("hidden");
        }

        // let fm = document.getElementById('float-menu')
        // function toogleFm(){
        //         fm.classList.toggle('hidden')

        // }

        let nt = document.getElementById('menu-notification')
        function notification(){
            nt.classList.toggle('hidden')

        }

        //almacenando el div y el boton en unas variables
        var div = document.getElementById('capa');
        var but = document.getElementById('boton');

        //la funcion que oculta y muestra
        function showHide(e){
        e.preventDefault();
        e.stopPropagation();
        if(div.style.display == "none"){
        div.style.display = "block";
        } else if(div.style.display == "block"){
        div.style.display = "none";
        }
        }
        //al hacer click en el boton
        but.addEventListener("click", showHide, false);

        //funcion para cualquier clic en el documento
        document.addEventListener("click", function(e){
        //obtiendo informacion del DOM para
        var clic = e.target;
        if(div.style.display == "block" && clic != div){
        div.style.display = "none";
        }
        }, false);



        //Script para manener scroll al recargar página
        window.onload=function(){
        var pos=window.name || 0;
        window.scrollTo(0,pos);
        }
        window.onunload=function(){
        window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
        }


    </script>
</body>

</html>
