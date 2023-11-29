<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg') }}" />
    <title>QUIZ ST CFT | Desafio</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/desafio.css')}}">
</head>

<body>
<div class="navbar">
        <nav style="box-shadow: none !important;">
            <div class="nav-wrapper">
                <img src="{{ asset(auth()->user()->ruta_foto) }}" alt="" class="circle responsive-img logo">
                <span class="brand-logo hide-on-med-and-down" style="color: #121212;">{{ auth()->user()->name .' '. auth()->user()->apellido_paterno ." ". auth()->user()->apellido_materno}}</span>
                <span class="sub-brand-logo hide-on-med-and-down" style=" color: #004F45;">{{ auth()->user()->email }}</span>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    @if (auth()->user()->tipo_usu == 0)
                    <li><a href="#" class="modal-trigger" style="font-weight: bold; font-size: 1.1rem; color: #4C6B64;"><i class="material-icons left blue-grey-text text-lighten-3">assistant</i>Estudiante</a></li>
                    @else
                    <li><a href="#" class="modal-trigger" style="font-weight: bold; font-size: 1.1rem; color: #4C6B64;"><i class="material-icons left teal-text text-lighten-2">stars</i>Administrador</a></li>
                    @endif
                    <li><a href="/logout" class="waves-effect waves-light btn red accent-2" style="border-radius: 50px;"><i class="material-icons">exit_to_app</i></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <li><a href=""><i class="material-icons left">person</i>{{ auth()->user()->name .' '. auth()->user()->apellido_paterno ." ". auth()->user()->apellido_materno}}</a></li>
        <li><a href=""><i class="material-icons left">email</i>{{ auth()->user()->email }}</a></li>
        @if (auth()->user()->tipo_usu == 0)
        <li><a href="#suscripcion" class="modal-trigger" style="font-weight: bold; font-size: 1.1rem;"><i class="material-icons left blue-grey-text text-lighten-3">assistant</i>Estudiante</a></li>
        @else
        <li><a href="#suscripcion" class="modal-trigger" style="font-weight: bold; font-size: 1.1rem;"><i class="material-icons left teal-text text-lighten-2">stars</i>Administrador</a></li>
        @endif
        <li><a href="/logout"><i class="material-icons left red-text text-accent-2">exit_to_app</i>Cerrar Sesion</a></li>
    </ul>

    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m8">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 l8">
                                    <span class="card-title title" style="color: #004F45;">Desafio</span>
                                </div>
                                <div class="col s12 l4 buttons">
                                    <!-- Botones de acción -->
                                    <a href="#info" class="waves-effect waves-light btn yellow darken-2 tooltipped modal-trigger" data-position="bottom" data-tooltip="Información">
                                        <i class="material-icons">info</i>
                                    </a>
                                    <a href="#reiniciar" class="waves-effect waves-light btn red recargar darken-2 tooltipped modal-trigger" data-position="bottom" data-tooltip="Recargar">
                                        <i class="material-icons">refresh</i>
                                    </a>
                                </div>
                            </div>
                            <!-- Lista de usuarios -->
                            <ul class="collection">
                                @foreach ($top3Usuarios as $top3)
                                <!-- Usuario 1 -->
                                <li class="collection-item avatar">
                                    <img src="{{ asset($top3->ruta_foto) }}" alt="" class="circle">
                                    <span class="title">{{$top3->name .' '.$top3->apellido_paterno.' '.$top3->apellido_materno}}</span>
                                    <p class="right indigo-text title">
                                        <i class="material-icons amber-text">star</i> {{$top3->totalDesafio}}
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div>
                        <div class="scrollable">
                            @php
                            $num = 0;
                            @endphp
                            @foreach ($preguntasChunks as $pregunta)
                            <div class="card indigo accent-2">
                                <div class="card-action" style="border-radius: 10px;">
                                    <div class="row">
                                        <div class="col m12 l4">
                                            <h5 class="white-text" style="font-weight: bolder;">Nv. <span class="indigo-text">{{ $loop->iteration }}</span></h5>
                                        </div>
                                        <div class="col m12 l8">
                                            @if ( $nivelActual != $loop->iteration)
                                            <a href="{{ route('entrar_desafio') }}" class="waves-effect waves-light btn-large indigo" disabled>
                                                <i class="material-icons left">play_arrow</i>Comenzar
                                            </a>
                                            @else
                                            <a href="{{ route('entrar_desafio') }}" class="waves-effect waves-light btn-large indigo">
                                                <i class="material-icons left">play_arrow</i>Comenzar
                                            </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                            $num = $loop->iteration;
                            @endphp
                            @endforeach
                            @if ( $nivelActual > $num)
                            {{round($preguntasCount/3)}}
                            Esperando mas preguntas
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <div class="spacer"></div>
    <div class="footer-fixed">
        <footer>
            <nav class="z-depth-0">
                <div class="nav-wrapper green darken-4">
                    <ul class="justify">
                        <li><a href="{{ route('profile') }}"><i class="material-icons">person</i></a></li>
                        @if(auth()->user()->tipo_usu == 1)
                        <li><a href="{{ route('gestionar_usuarios') }}"><i class="material-icons">group</i></a></li>
                        @endif
                        @if(auth()->user()->tipo_usu == 0)
                        <li><a href="{{ route('preguntas_normales',1) }}"><i class="material-icons">lightbulb</i></a></li>
                        @endif
                        <li><a class="active" href="{{ route('desafio') }}" style="background-color: #C4DBD6; border-radius: 10px;"><i class="material-icons green-text text-darken-4">grade</i></a></li>
                        <li><a href="{{route('home')}}"><i class="material-icons">home</i></a></li>
                        <li><a href="{{ route('gestionar_pregunta') }}"><i class="material-icons">format_list_bulleted</i></a></li>

                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <!--Estructura de modals-->

    <div id="reiniciar" class="modal">
        <div class="modal-content">
            <h4 class="red-text">¿Estás seguro de que quieres reiniciar tu racha?</h4>
            <p>Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a href="reiniciar_desafio" class="waves-effect waves-red btn-flat" id="confirmarEliminar">Aceptar</a>
        </div>
    </div>

    <div id="info" class="modal">
        <div class="modal-content">
            <h4>Instrucciones desafio</h4>
            <p>Siempre habrá un ranking con las 3 mejores rachas del modo desafio. Ten en cuenta que siempre podrás reiniciar tu racha si lo deseas.</p>
            <p>Los desafios consisten en oleadas de 3 preguntas que debes contestar correctamente, si fallas en una pregunta el desafio se considerará como fallido.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">cerrar</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('materialize/js/materialize.js')}}"></script>
    <script src="{{ asset('js/navbar.js')}}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>