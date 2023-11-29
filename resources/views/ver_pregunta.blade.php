<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg') }}" />
    <title>QUIZ ST CFT | Ver Pregunta</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/ver_pregunta.css')}}">
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
            <div class="row up_section">
                <div class="col s12 m12 l8">
                    <h4 class="green-text text-darken-4"><i class="small material-icons left green-text text-darken-4">visibility</i>Visualizador de Pregunta</h4>
                </div>
                @if (Session::has('mensaje'))
                <div class="red-text" style="text-align: center;">
                    <span>{{ Session::get('mensaje') }}</span>
                </div>
                @endif
                @if ($errors->any())
                <div class="row">
                    <div class="col s12">
                        <div class="card-panel red lighten-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col s12 m12 l4" style="margin-top: 2%;">
                    <a class="waves-effect waves-light btn green darken-4" href="{{route('gestionar_pregunta')}}" style="border-radius: 50px;"><i class="material-icons left">chevron_left</i> Volver</a>
                    <a class="waves-effect waves-light btn yellow darken-2 modal-trigger editar_pregunta" href="#editar_pregunta" style="border-radius: 50px;"><i class="material-icons left">edit</i>
                        Editar Pregunta</a>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row">
                <div class="col s12 m12 l8">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h5 class="indigo-text green-text text-darken-3">Pregunta</h5>
                            <p>{{ $preguntas->pregunta }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h5 class="indigo-text green-text text-darken-3">Opciones</h5>
                            <p class="green-text">{{ $preguntas->respuesta_correcta }}</p>
                            <div class="divider"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <p>{{ $preguntas->respuesta_2 }}</p>
                            <div class="divider"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <p>{{ $preguntas->respuesta_3 }}</p>
                            <div class="divider"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <p>{{ $preguntas->respuesta_4 }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h5 class="green-text">Retroalimentación Acierto</h5>
                            <p>{{ $preguntas->retroalimentacion_positiva }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h5 class="red-text">Retroalimentación Error</h5>
                            <p>{{ $preguntas->retroalimentacion_negativa }}</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            @if ($preguntas->dificultad == 0)
                            <h5 class="green-text text-darken-4 text_title">Dificultad:<span class="dif_normal"> Normal</span> </h5>
                            @elseif ($preguntas->dificultad == 1)
                            <h5 class="green-text text-darken-4 text_title">Dificultad:<span class="dif_dificil"> Dificil</span> </h5>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <h5 class="green-text text-darken-4 text_title">Categoria:<span class="indigo-text"> {{ $preguntas->categoria }}</span> </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="spacer"></div>
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
                        <li><a href="{{route('home')}}"><i class="material-icons">home</i></a></li>
                        <li><a class="active" href="{{route('gestionar_pregunta')}}" style="background-color: #C4DBD6; border-radius: 10px;"><i class="material-icons green-text text-darken-4">format_list_bulleted</i></a></li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <!--Estructura modal-->
    <div id="editar_pregunta" class="modal">
        <div class="modal-content">
            <h3 class="green-text text-darken-4">Editar Pregunta</h3>
            <span class="red-text">Esta accion devolverá la pregunta a ser aceptada por la comunidad o un moderador</span>
            <div class="divider"></div>
            <div class="row" style="margin-top: 4%;">
                <form class="col s12" action="{{ route('update', ['id' => $preguntas->id_preguntas]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="pregunta-txt" name="pregunta" class="materialize-textarea" placeholder="{{ $preguntas->pregunta }}" maxlength="10000"></textarea>
                            <label for="pregunta-txt">Pregunta</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="opcion1-txt" name="respuesta_correcta" type="text" class="validate" placeholder="{{ $preguntas->respuesta_correcta }}" maxlength="255">
                            <label for="opcion1-txt">Opción uno (Correcta)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="opcion2-txt" name="respuesta_2" type="text" class="validate" placeholder="{{ $preguntas->respuesta_2 }}" maxlength="255">
                            <label for="opcion2-txt">Opción dos</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="opcion3-txt" name="respuesta_3" type="text" class="validate" placeholder="{{ $preguntas->respuesta_3 }}" maxlength="255">
                            <label for="opcion3-txt">Opción tres</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="opcion4-txt" name="respuesta_4" type="text" class="validate" placeholder="{{ $preguntas->respuesta_4 }}" maxlength="255">
                            <label for="opcion4-txt">Opción cuatro</label>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row" style="margin-top: 2%;">
                        <div class="input-field col s12 m6">
                            <select name="dificultad">
                                <option value="" disabled selected>Elige una opción</option>
                                <option value="0">Normal</option>
                                <option value="1" >Dificil</option>
                            </select>
                            <label>Dificultad de pregunta</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <select name="fk_categoria">
                                <option value="" disabled selected>Elige una opción</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id_categoria_preguntas}}">{{$categoria->categoria}}
                                @endforeach
                            </select>
                            <label>Categoria de pregunta</label>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row" style="margin-top: 2%;">
                        <div class="input-field col s12">
                            <textarea id="retroAcierto-txt" name="retroalimentacion_positiva" class="materialize-textarea" placeholder="{{ $preguntas->retroalimentacion_positiva }}" maxlength="10000"></textarea>
                            <label for="retroAcierto-txt">Retroalimentación acierto</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="retroError-txt" name="retroalimentacion_negativa" type="text" class="validate" placeholder="{{ $preguntas->retroalimentacion_negativa }}" maxlength="10000">
                            <label for="retroError-txt">Retroalimentación error</label>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 4%;">
                        <button class="btn col s12 m4 waves-effect waves-light green darken-4" type="submit" name="action">Editar
                            Pregunta
                            <i class="material-icons right">edit</i>
                        </button>
                        <button class="btn modal-close col s12 m4 offset-m1 waves-effect waves-light red form_cancel" type="submit" name="action">Cancelar
                            <i class="material-icons right">close</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('materialize/js/materialize.js')}}"></script>
    <script src="{{ asset('js/navbar.js')}}"></script>
    <script src="{{ asset('js/modal.js')}}"></script>
    <script src="{{ asset('js/select.js')}}"></script>
</body>

</html>