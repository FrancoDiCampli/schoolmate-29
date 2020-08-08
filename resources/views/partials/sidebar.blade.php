<div id="sidebar" class="md:block bg-gray-200 shadow-lg w-0 md:w-3/12 transition-all delay-75  m-0 p-0 mx-auto text-left">
    <button onclick="setRes()" class="md:hidden text-gray-700 mt-5 ml-5">


    </button>
    <div class="md:pt-10 pb-10 px-6 pl-8 "> {{-- agregar md:fixed mt-20 --}}

        <a href='{{route("$user")}}' class="flex md:hidden justify-start md:justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md py-2 border-b md:border-none mb-6">
            <img  class="w-8 h-8 rounded-full object-cover mr-2 shadow-md md:hidden" src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="">
            <span class="mx-2 hidden md:block pt-2">{{Auth::user()->name}}</span>
        </a>

        @php
        // Esta variable es para crear la ruta de inicio, que es distinta dependiendo del rol
         $user = auth()->user()->roles()->first()->name;

        @endphp
        <a href='{{route("$user")}}' class="flex justify-start md:justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2">
            <svg aria-hidden="true" data-prefix="fas" data-icon="tachometer-alt"
                class="h-5 w-5  svg-inline--fa fa-tachometer-alt fa-w-18" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M288 32C128.94 32 0 160.94 0 320c0 52.8 14.25 102.26 39.06 144.8 5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2C561.75 422.26 576 372.8 576 320c0-159.06-128.94-288-288-288zm0 64c14.71 0 26.58 10.13 30.32 23.65-1.11 2.26-2.64 4.23-3.45 6.67l-9.22 27.67c-5.13 3.49-10.97 6.01-17.64 6.01-17.67 0-32-14.33-32-32S270.33 96 288 96zM96 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm48-160c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm246.77-72.41l-61.33 184C343.13 347.33 352 364.54 352 384c0 11.72-3.38 22.55-8.88 32H232.88c-5.5-9.45-8.88-20.28-8.88-32 0-33.94 26.5-61.43 59.9-63.59l61.34-184.01c4.17-12.56 17.73-19.45 30.36-15.17 12.57 4.19 19.35 17.79 15.17 30.36zm14.66 57.2l15.52-46.55c3.47-1.29 7.13-2.23 11.05-2.23 17.67 0 32 14.33 32 32s-14.33 32-32 32c-11.38-.01-20.89-6.28-26.57-15.22zM480 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z" />
            </svg>
            <span class="mx-2 hidden md:block">Inicio</span>
        </a>


        <a href='{{route('notifications')}}' class="flex justify-start md:justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2 md:hidden">
            @if ($cant > 0)
            <svg aria-hidden="true" data-prefix="fas" data-icon="bell" class="w-5 h-5 svg-inline--fa fa-bell fa-w-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"/></svg>
            <span class="mx-2 hidden md:block">Notificaciones</span>
            <span class="text-gray-800 bg-white hover:bg-gray-900 hover:text-white justify-center rounded-full px-2 mr-4e text-sm font-semibold items-center hidden"> {{$cant}}</span>

            @else
            <svg aria-hidden="true" data-prefix="far" data-icon="bell-slash" class="w-5 h-5 svg-inline--fa fa-bell-slash fa-w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M633.99 471.02L36 3.51C29.1-2.01 19.03-.9 13.51 6l-10 12.49C-2.02 25.39-.9 35.46 6 40.98l598 467.51c6.9 5.52 16.96 4.4 22.49-2.49l10-12.49c5.52-6.9 4.41-16.97-2.5-22.49zM163.53 368c16.71-22.03 34.48-55.8 41.4-110.58l-45.47-35.55c-3.27 90.73-36.47 120.68-54.84 140.42-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h279.66l-61.4-48H163.53zM320 96c61.86 0 112 50.14 112 112 0 .2-.06.38-.06.58.02 16.84 1.16 31.77 2.79 45.73l59.53 46.54c-8.31-22.13-14.34-51.49-14.34-92.85 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84c-26.02 5.41-49.45 16.94-69.13 32.72l38.17 29.84C275 103.18 296.65 96 320 96zm0 416c35.32 0 63.97-28.65 63.97-64H256.03c0 35.35 28.65 64 63.97 64z"/></svg>
            <span class="mx-2 hidden md:block">Notificaciones</span>
            @endif
        </a>

        @role('admin')
        <a href="{{route('courses.index')}}"
            class="flex md:justify-start justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2">
            <svg aria-hidden="true" data-prefix="fas" data-icon="graduation-cap"
                class="h-5 w-5  svg-inline--fa fa-graduation-cap fa-w-20" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 640 512">
                <path fill="currentColor"
                    d="M622.34 153.2L343.4 67.5c-15.2-4.67-31.6-4.67-46.79 0L17.66 153.2c-23.54 7.23-23.54 38.36 0 45.59l48.63 14.94c-10.67 13.19-17.23 29.28-17.88 46.9C38.78 266.15 32 276.11 32 288c0 10.78 5.68 19.85 13.86 25.65L20.33 428.53C18.11 438.52 25.71 448 35.94 448h56.11c10.24 0 17.84-9.48 15.62-19.47L82.14 313.65C90.32 307.85 96 298.78 96 288c0-11.57-6.47-21.25-15.66-26.87.76-15.02 8.44-28.3 20.69-36.72L296.6 284.5c9.06 2.78 26.44 6.25 46.79 0l278.95-85.7c23.55-7.24 23.55-38.36 0-45.6zM352.79 315.09c-28.53 8.76-52.84 3.92-65.59 0l-145.02-44.55L128 384c0 35.35 85.96 64 192 64s192-28.65 192-64l-14.18-113.47-145.03 44.56z" />
            </svg>
            <span class="mx-2 hidden md:block">Cursos</span>
        </a>


        <a href="{{route('subjects.index')}}"
                class="flex md:justify-start justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2">
                <svg aria-hidden="true" data-prefix="fas" data-icon="tags"
                    class="h-5 w-5  svg-inline--fa fa-tags fa-w-20" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 640 512">
                    <path fill="currentColor"
                        d="M497.941 225.941L286.059 14.059A48 48 0 00252.118 0H48C21.49 0 0 21.49 0 48v204.118a48 48 0 0014.059 33.941l211.882 211.882c18.744 18.745 49.136 18.746 67.882 0l204.118-204.118c18.745-18.745 18.745-49.137 0-67.882zM112 160c-26.51 0-48-21.49-48-48s21.49-48 48-48 48 21.49 48 48-21.49 48-48 48zm513.941 133.823L421.823 497.941c-18.745 18.745-49.137 18.745-67.882 0l-.36-.36L527.64 323.522c16.999-16.999 26.36-39.6 26.36-63.64s-9.362-46.641-26.36-63.64L331.397 0h48.721a48 48 0 0133.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882z" />
                </svg>
                <span class="mx-2 hidden md:block">Materias</span>
        </a>

    <a href="{{route('enrollments.index')}}"
            class="flex md:justify-start justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2">
            <svg aria-hidden="true" data-prefix="fas" data-icon="chart-pie"
                class="h-5 w-5  svg-inline--fa fa-chart-pie fa-w-17" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 544 512">
                <path fill="currentColor"
                    d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z" />
            </svg>
            <span class="mx-2 hidden md:block">Matriculas</span>
        </a>

        <a href="" class="flex md:justify-start justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2">
            <svg aria-hidden="true" data-prefix="fas" data-icon="tasks"
                class="h-5 w-5 svg-inline--fa fa-tasks fa-w-16" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <path fill="currentColor"
                    d="M139.61 35.5a12 12 0 00-17 0L58.93 98.81l-22.7-22.12a12 12 0 00-17 0L3.53 92.41a12 12 0 000 17l47.59 47.4a12.78 12.78 0 0017.61 0l15.59-15.62L156.52 69a12.09 12.09 0 00.09-17zm0 159.19a12 12 0 00-17 0l-63.68 63.72-22.7-22.1a12 12 0 00-17 0L3.53 252a12 12 0 000 17L51 316.5a12.77 12.77 0 0017.6 0l15.7-15.69 72.2-72.22a12 12 0 00.09-16.9zM64 368c-26.49 0-48.59 21.5-48.59 48S37.53 464 64 464a48 48 0 000-96zm432 16H208a16 16 0 00-16 16v32a16 16 0 0016 16h288a16 16 0 0016-16v-32a16 16 0 00-16-16zm0-320H208a16 16 0 00-16 16v32a16 16 0 0016 16h288a16 16 0 0016-16V80a16 16 0 00-16-16zm0 160H208a16 16 0 00-16 16v32a16 16 0 0016 16h288a16 16 0 0016-16v-32a16 16 0 00-16-16z" />
            </svg>
            <span class="mx-2 hidden md:block">Deliveries</span>
        </a>
        <a href="" class="flex md:justify-start justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2">
            <svg aria-hidden="true" data-prefix="fas" data-icon="clipboard-list"
                class="h-5 w-5 svg-inline--fa fa-clipboard-list fa-w-12" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512">
                <path fill="currentColor"
                    d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z" />
            </svg>
            <span class="mx-2 hidden md:block">Tareas</span>



            <a onclick="showMenu()" href="#"
                class="focus:outline-none flex md:justify-start justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2">
                <svg aria-hidden="true" data-prefix="fas" data-icon="user-graduate"
                    class="h-5 w-5 svg-inline--fa fa-user-graduate fa-w-14"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M319.4 320.6L224 416l-95.4-95.4C57.1 323.7 0 382.2 0 454.4v9.6c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-9.6c0-72.2-57.1-130.7-128.6-133.8zM13.6 79.8l6.4 1.5v58.4c-7 4.2-12 11.5-12 20.3 0 8.4 4.6 15.4 11.1 19.7L3.5 242c-1.7 6.9 2.1 14 7.6 14h41.8c5.5 0 9.3-7.1 7.6-14l-15.6-62.3C51.4 175.4 56 168.4 56 160c0-8.8-5-16.1-12-20.3V87.1l66 15.9c-8.6 17.2-14 36.4-14 57 0 70.7 57.3 128 128 128s128-57.3 128-128c0-20.6-5.3-39.8-14-57l96.3-23.2c18.2-4.4 18.2-27.1 0-31.5l-190.4-46c-13-3.1-26.7-3.1-39.7 0L13.6 48.2c-18.1 4.4-18.1 27.2 0 31.6z" />
                </svg>
                <span class="mx-2 hidden md:block">Usuarios</span>
            </a>

            <div class="hidden text-left md:ml-0 ml-20 pl-6 md:pl-8 text-gray-600" id="users-admin">
                <div class="py-1 hover:text-gray-700 ">
                <a href="{{route('user.show',$user)}}">Profile</a>
                </div>
                <div class="py-1 hover:text-gray-700 ">
                <a href="{{route('teachers.index')}}">Profesores</a>
                </div>
                <div class="py-1 hover:text-gray-700 ">
                    <a href="{{route('students.index')}}">Alumnos</a>
                    </div>
            </div>
            @endrole

            <a class="flex md:justify-start justify-start text-gray-600 mt-1 hover:text-gray-700 focus:bg-gray-300 rounded-md p-2" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <svg aria-hidden="true" data-prefix="fas" data-icon="sign-out-alt" class="svg-inline--fa fa-sign-out-alt fa-w-16 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/>
              </svg>
            <span class="mx-2 hidden md:block">Cerrar Sesión</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
</div>
