<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg') }}" />
    <title>QUIZ ST CFT | Pendientes</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gestion_pregunta.css') }}">
</head>

@if(auth()->user()->tipo_usu == 1)

<body>
    <!--Navbar-->
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
    <!--Contenido gestion preguntas-->
    <main>
        <div class="container">
            <div class="row up_section">
                <div class="col s12 m12 l10">
                    <h4 class="green-text text-darken-4"><i class="material-icons green-text text-darken-4">playlist_add_check</i> Preguntas Pendientes</h4>
                </div>
                <div class="col s12 m12 l2" style="margin-top: 2%;">
                    <a class="waves-effect waves-light btn green darken-4" href="{{route('gestionar_pregunta')}}" style="border-radius: 50px;"><i class="material-icons left">chevron_left</i> Volver</a>
                </div>
            </div>
            <div class="table-container">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Pregunta</th>
                            <th>Categoria</th>
                            <th>Dificultad</th>
                            <th>Creador</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($preguntas as $pregunta)
                        @if ($pregunta->id != auth()->user()->id)
                        <tr data-id-pregunta="{{ $pregunta->id_preguntas }}">
                            <td>{{ $pregunta->pregunta }}</td>
                            <td class="categoria">{{ $pregunta->categoria }}</td>
                            @if ($pregunta->dificultad == 0)
                            <td class="dif_normal">
                                Normal
                            </td>
                            @elseif ($pregunta->dificultad == 1)
                            <td class="dif_dificil">
                                Dificil
                            </td>
                            @endif
                            <td class="indigo-text ">{{ $pregunta->name . ' ' . $pregunta->apellido_paterno . ' ' . $pregunta->apellido_materno }}</td>
                            <td class="boton"><a href="{{ route('ver_pregunta', $pregunta->id_preguntas) }}" class="waves-effect waves-light btn-small blue darken-4" style="border-radius: 50px;"><i class="material-icons">visibility</i></a></td>
                            <td class="boton"><a href="{{ route('approve_question', $pregunta->id_preguntas) }}" class="waves-effect waves-light btn-small green darken-1" href="" style="border-radius: 50px;"><i class="material-icons">check</i></a></td>
                            <td class="boton"><a href="{{ route('disapprove_question', $pregunta->id_preguntas) }}" class="waves-effect waves-light btn-small red darken-1" href="" style="border-radius: 50px;"><i class="material-icons">not_interested</i></a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="spacer"></div>

    <!--Menu inferior-->
    <div class="footer-fixed">
        <footer class="">
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
                        <li><a href="{{ route('desafio') }}"><i class="material-icons">grade</i></a></li>
                        <li><a href="{{ route('home') }}"><i class="material-icons">home</i></a></li>
                        <li><a class="active" href="{{ route('gestionar_pregunta') }}" style="background-color: #C4DBD6; border-radius: 10px;"><i class="material-icons green-text text-darken-4">format_list_bulleted</i></a></li>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('materialize/js/materialize.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
</body>
@endif


</html>