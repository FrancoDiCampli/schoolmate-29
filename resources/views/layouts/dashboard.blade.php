<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body class="bg-gray-100 font-montserrat" id="all">

    <main id="app" class="">
        <div class="top-navbar w-full mx-auto flex items-center  bg-gray-200 p-3 border-b border-gray-400">
                <a href="">
                      <img src="{{asset('img/sm-sidebar-png.png')}}" class="md:w-16 md:h-16 w-12 h-12  pl-0 md:ml-10 ml-6 " alt="">
                </a>

            <h1 class="text-bluedark-400 font-rubik text-2xl ml-12 mr-10 w-auto hidden md:block">Félix<span class="font-semibold">Frías</span></h1>

            <div class="text-xs md:text-base text-right text-gray-600 justify-end w-full">
                <a href="" class="">admin@mail.com</a> |
                <span>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </span>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>

            <div class="relative md:w-0 w-2/12 text-right">

                <div id="dropdown"
                    class="hidden transition-all delay-100 bg-white absolute right-0 text-sm text-left w-8/12 p-2 rounded-sm">
                    <a href="" class="block ">Perfil</a>
                    <a href="" class="block ">Logout</a>
                </div>
                <button onclick="setRes()" class="md:hidden text-gray-700 mt-5 ml-5">
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


            <div class="main-content md:w-10/12 w-full mx-10">

                {{-- Mensaje de sesion --}}
                <div class="container">
                    @if (session('messages'))
                        <!--Toast-->
                        <div class="alert-toast fixed bottom-auto md:top-0 right-0 m-8 w-5/6 md:w-full max-w-sm items-center">
                            <input type="checkbox" class="hidden" id="footertoast">

                            <label class="close cursor-pointer flex items-start justify-between w-full pl-3 pt-3 bg-greenschool-200 md:h-auto h-auto rounded shadow-lg text-white" title="close" for="footertoast">
                                {{ session('messages') }}

                                <svg class="fill-current text-white mr-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                </svg>
                            </label>
                        </div>

                    @endif
                </div>

                <div class="container">
                    @if (session('errores'))
                        <!--Toast-->
                        <div class="alert-toast fixed bottom-auto md:top-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
                            <input type="checkbox" class="hidden" id="footertoast">

                            <label class="close cursor-pointer flex items-start justify-between w-full pl-3 pt-3 bg-red-500 sm:h-20 md:h-auto h-auto rounded shadow-lg text-white" title="close" for="footertoast">
                                {{ session('errores') }}

                                <svg class="fill-current text-white mr-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
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

    // let main = document.getElementById('app')
    // main.addEventListener('click',function(e){
    //     dd.classList.toggle("shown");
    // })

    </script>
</body>

</html>
