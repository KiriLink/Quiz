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
    <link rel="stylesheet" href="{{ asset('css/quiz.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
</head>

<body>
    <audio id="miAudio" controls hidden>
        <source src="{{ asset('media/music.mp3') }}" type="audio/mp3">
        Tu navegador no soporta el elemento de audio.
    </audio>

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
                <div id="quiz">
                    <div id="quiz-header">
                        <img src="{{ asset('assets/topic2.png') }}" alt="" class="responsive-img guino_anim">
                    </div>
                    <div id="quiz-start-screen">
                        <p><a href="#" id="quiz-start-btn" onclick="playAudio()" class="quiz-button">Comenzar</a></p>
                    </div>
                </div>
            </div>
        </main>

        <div style="margin-top: 13%;"></div>
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

        <div id="eliminar_modal" class="modal">
            <div class="modal-content">
                <h4 class="red-text">¿Estás seguro de que quieres eliminar esta pregunta?</h4>
                <p>Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                <a href="#!" class="waves-effect waves-red btn-flat" id="confirmarEliminar">Aceptar</a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="{{ asset('materialize/js/materialize.js')}}"></script>
        <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="{{ asset('js/jquery.quiz-min.js')}}"></script>
        <script src='//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.1/mousetrap.min.js'></script>
        <script>
            function playAudio() {
                var audio = document.getElementById('miAudio');
                audio.play();
            }
        </script>
        <script src="{{ asset('js/navbar.js')}}"></script>
        <script src="{{ asset('js/quiz_challenge.js')}}"></script>
        <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>