<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg')}}">
    <title>Quiz | Quiz</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/quiz.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
</head>

<body>
<div class="navbar">
        <nav>
            <div class="nav-wrapper" style="background-color:#4C6B64;">
                <img src="{{ asset('assets/profile.png')}}" alt="" class="circle responsive-img logo">
                <span class="brand-logo hide-on-med-and-down">{{ auth()->user()->name .' '. auth()->user()->apellido_paterno ." ". auth()->user()->apellido_materno}}</span>
                <span class="sub-brand-logo hide-on-med-and-down" style="color: #004F45;">{{ auth()->user()->email }}</span>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="" style="font-weight: bolder; font-size: 1.2rem;"><i class="material-icons left red-text">favorite</i>5</a></li>
                    <li><a href="" style="font-weight: bold; font-size: 1.1rem;"><i class="material-icons left teal-text text-lighten-2">stars</i>Platino</a></li>
                    <li><a href="" class="waves-effect waves-light btn yellow darken-2"><i class="material-icons">edit</i></a></li>
                    <li><a href="/logout" class="waves-effect waves-light btn red accent-2"><i class="material-icons">exit_to_app</i></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <li><a href=""><i class="material-icons left">person</i>{{ auth()->user()->name .' '. auth()->user()->apellido_paterno ." ". auth()->user()->apellido_materno}}</a></li>
        <li><a href=""><i class="material-icons left">email</i>{{ auth()->user()->email }}</a></li>
        <li><a href="" style="font-weight: bolder; font-size: 1.2rem;"><i
                    class="material-icons left red-text">favorite</i>5</a></li>
        <li><a href="" style="font-weight: bold; font-size: 1.1rem;"><i
                    class="material-icons left teal-text text-lighten-2">stars</i>Platino</a></li>
        <li><a href=""><i class="material-icons left yellow-text text-darken-2">edit</i>Editar Perfil</a></li>
        <li><a href=""><i class="material-icons left red-text text-accent-2">exit_to_app</i>Cerrar Sesion</a></li>
    </ul>
    <main>
        <div class="container">
            <div id="quiz">
                <div id="quiz-header">
                    <h1>Quiz Variado</h1>
                </div>
                <div id="quiz-start-screen">
                    <p><a href="#" id="quiz-start-btn" class="quiz-button">Comenzar</a></p>
                </div>
            </div>
        </div>
    </main>
    <div class="footer-fixed">
        <footer class="">
            <nav class="z-depth-0">
                <div class="nav-wrapper" style="background-color:#4C6B64;">
                    <ul class="justify">
                        <li><a href="#!"><i class="material-icons">person</i></a></li>
                        <li><a href="{{ route('preguntas.normales') }}" style="background-color: #C4DBD6; border-radius: 10px;"><i
                                    class="material-icons" style="color: #4C6B64;">lightbulb</i></a></li>
                        <li><a href="#!"><i class="material-icons">grade</i></a></li>
                        <li><a href="{{route('login')}}"><i class="material-icons">home</i></a></li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <script src="{{ asset('materialize/js/materialize.js')}}"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('js/jquery.quiz-min.js')}}"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.1/mousetrap.min.js'></script>

    <script src="{{ asset('js/navbar.js')}}"></script>
    <script src="{{ asset('js/downbar.js')}}"></script>
    <script src="{{ asset('js/quiz.js')}}"></script>
</body>

</html>