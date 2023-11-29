<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg') }}" />
    <title>QUIZ ST CFT | Ver Usuario</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">

    <script src="{{ asset('js/toast.js')}}"></script>
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
        <div class="container carta">
            <div class="center">
                <h3 class="title_rank">Visualizar Usuario</h3>
                <img src="{{ asset($usuarios[0]->ruta_foto) }}" alt="" class="circle responsive-img img_usuario">
            </div>
            <div class="divider"></div>
            <div class="row" style="margin-top: 1%;">
                @if (Session::has('updatePerfil'))
                <script>
                    toast('{{ Session::get("updatePerfil") }}')
                </script>
                @endif
                <div class="col s12 m12 l8">
                    <span class="card_text"><i class="material-icons left">person</i>{{ $usuarios[0]->name .' '. $usuarios[0]->apellido_paterno ." ". $usuarios[0]->apellido_materno }}</span>
                    <div class="text_slot"><span class="card_text"><i class="material-icons left">email</i>{{ $usuarios[0]->email }}</span></div>
                </div>
                <div class="col s12 m12 l2 right button_slot" style="text-align: center;">
                    <a href="#editar_perfil" class="waves-effect waves-light btn yellow darken-2 modal-trigger" style="border-radius: 50px;"><i class="material-icons left">edit</i> Editar usuario</a>
                    <a href="#eliminar_modal" class="waves-effect waves-light btn red darken-2 modal-trigger eliminar" style="border-radius: 50px;"><i class="material-icons left">delete</i> Eliminar usuario</a>
                </div>
            </div>
        </div>
        <div class="container carta">
            <h3 class="title_bar">Rendimiento en tópicos de preguntas</h3>
            <!--data-percent="porcentaje"-->
            @foreach($porcentajePorCategoria as $item)
            <div class="bar light-blue darken-1" data-percent="{{$item['porcentaje']}}%"><span class="label">{{ $item['categoria'] }}</span></div>
            @endforeach
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12 m5 carta">
                    <p class="title_rank">Aciertos en preguntas</p>
                    <div class="center-vertical">
                        <div class="chart graph" id="graph" data-percent="{{ $porcentajeContestadas }}"></div>
                    </div>
                </div>
                <div class="col s12 m5 offset-m2 carta">
                    <p class="title_rank">Racha actual</p>
                    <div class="center-vertical">
                        <i class="material-icons large yellow-text">star</i>
                        <p class="rank_num">{{$nivelActual}}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div style="margin-top: 15%;"></div>
    <div class="footer-fixed">
        <footer class="">
            <nav class="z-depth-0">
                <div class="nav-wrapper green darken-4">
                    <ul class="justify">
                        <li><a href="{{ route('profile') }}"><i class="material-icons">person</i></a></li>
                        @if(auth()->user()->tipo_usu == 1)
                        <li><a href="{{ route('gestionar_usuarios') }}" ><i class="material-icons">group</i></a></li>
                        @endif
                        @if(auth()->user()->tipo_usu == 0)
                        <li><a href="{{ route('preguntas_normales',1) }}"><i class="material-icons">lightbulb</i></a></li>
                        @endif
                        <li><a href="{{ route('desafio') }}"><i class="material-icons">grade</i></a></li>
                        <li><a href="{{route('home')}}"><i class="material-icons">home</i></a></li>
                        <li><a href="{{route ('gestionar_pregunta')}}"><i class="material-icons">format_list_bulleted</i></a></li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <!--Estructura modal-->
    <div id="editar_perfil" class="modal">
        <div class="modal-content">
            <h3 style="color: #004F45;">Editar Perfil</h3>
            <div class="divider"></div>
            <div class="row" style="margin-top: 4%;">
                <form class="col s12" action="{{ route('editar_usuario') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="name_txt" name="name" type="text" class="validate" placeholder="{{ $usuarios[0]->name }}" maxlength="43">
                            <label for="name_txt">Nombre</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input id="ap_txt" name="regap" type="text" class="validate" placeholder="{{ $usuarios[0]->apellido_paterno }}" maxlength="35">
                            <label for="ap_txt">Apellido Paterno</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="am_txt" name="regam" type="text" class="validate" placeholder="{{ $usuarios[0]->apellido_materno }}" maxlength="35">
                            <label for="am_txt">Apellido Materno</label>
                        </div>
                    </div>
                    <div class="divider" style="margin-top: 2%; margin-bottom: 2%;"></div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input id="email_txt" name="email" type="email" class="validate" placeholder="{{ $usuarios[0]->email }}" onblur="validateEmail(this)" maxlength="200">
                            <label for="email_txt">Correo</label>
                            <div id="email-error" class="red-text"></div>
                        </div>
                        <div class="input-field col s12 m6">
                            <div class="file-field input-field">
                                <div class="btn col s12 m4 waves-effect waves-light green darken-4">
                                    <span>Imagen de perfil</span>
                                    <input type="file" accept=".png, .jpeg, .jpg" name="imgperfil">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row center">
                        <div class="row center">
                            <a class="btn waves-effect waves-light amber" id="restaurarContraseñaBtn">Restablecer contraseña<i class="material-icons right">refresh</i></a>
                        </div>

                    </div>
                    <div class="divider" style="margin-top: 2%; margin-bottom: 2%;"></div>
                    <input name="id" type="hidden" class="validate" value="{{ $usuarios[0]->id }}">

                    <div class="row" style="margin-top: 4%; margin-left: 20%; ">
                        <button class="btn col s12 m4 waves-effect waves-light green darken-4" type="submit" name="action">Editar
                            Perfil
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
            <h4 class="red-text">¿Estás seguro de que quieres eliminar a este usuario?</h4>
            <p>Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a href="{{ route('eliminar_usuario', $usuarios[0]->id)}}" class="waves-effect waves-red btn-flat" id="confirmarEliminar">Aceptar</a>
        </div>
    </div>

    <div id="restablecer_contraseña" class="modal">
        <div class="modal-content">
            <h4 class="red-text">¿Estás seguro que desea cambiar la contraseña por una por defecto?</h4>
            <p>Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="cancelarRestablecer">Cancelar</a>
            <a href="{{ route('restaurar_contrasena', $usuarios[0]->id)}}" class="waves-effect waves-red btn-flat" id="confirmarEliminar">Aceptar</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('materialize/js/materialize.js')}}"></script>
    <script src="{{ asset('js/graph_bars.js')}}"></script>
    <script src="{{ asset('js/ver_usuarios_admin.js')}}"></script>
    <script src="{{ asset('js/graph_circle.js')}}"></script>
    <script src="{{ asset('js/navbar.js')}}"></script>
    <script src="{{ asset('js/modal.js')}}"></script>
    <script src="{{ asset('js/profile.js')}}"></script>

</body>

</html>