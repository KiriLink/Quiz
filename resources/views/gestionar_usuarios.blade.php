<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg') }}" />
    <title>QUIZ ST CFT | Usuarios</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/gestion_pregunta.css') }}">
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
                    <h4 style="color: #004F45;"><i class="material-icons" style="color: #004F45;">group</i> Usuarios</h4>
                </div>

                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <script>
                    toast('{{ $error }}')
                </script>
                @endforeach
                @endif
                <div class="col s12 m12 l4" style="margin-top: 2%;">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">search</i>
                        <input type="text" id="buscar" class="autocomplete">
                        <label for="buscar">Buscar...</label>
                    </div>
                </div>
            </div>
            <div class="table-container">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Aciertos</th>
                            <th>Racha</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr>
                            <td><img src="{{ $usuario['ruta_foto'] }}" alt="" class="circle responsive-img img_table"></td>
                            <td>{{ $usuario['name']. ' ' .$usuario['apellido_paterno']. ' ' .$usuario['apellido_materno']  }}</td>
                            <td>{{ $usuario['email'] }}</td>
                            <td class="aciertos">{{ $porcentajes[$usuario->id] }}%</td>
                            <td class="racha">{{ $niveles[$usuario->id] }}</td>
                            <td class="boton"><a href="{{ route('ver_usuario_id', $usuario['id']) }}" class="waves-effect waves-light btn-small blue darken-4" style="border-radius: 50px;"><i class="material-icons">visibility</i></a></td>
                            <td class="boton"><a class="waves-effect waves-light btn-small modal-trigger red darken-1" href="#eliminar_modal" style="border-radius: 50px;" onclick="setCategoryId('{{ $usuario->id }}')"><i class="material-icons">delete</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                        <li><a href="{{ route('gestionar_usuarios') }}" style="background-color: #C4DBD6; border-radius: 10px;"><i class="material-icons green-text text-darken-4">group</i></a></li>
                        @endif
                        @if(auth()->user()->tipo_usu == 0)
                        <li><a href="{{ route('preguntas_normales',1) }}" style="background-color: #C4DBD6; border-radius: 10px;"><i class="material-icons green-text text-darken-4">lightbulb</i></a></li>
                        @endif
                        <li><a href="{{ route('desafio') }}"><i class="material-icons">grade</i></a></li>
                        <li><a href="{{route('home')}}"><i class="material-icons">home</i></a></li>
                        <li><a href="{{route ('gestionar_pregunta')}}"><i class="material-icons">format_list_bulleted</i></a></li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <!--Estructura de modals-->

    <div id="eliminar_modal" class="modal">
        <div class="modal-content">
            <h4 class="red-text">¿Estás seguro de que quieres eliminar este usuario?</h4>
            <p>Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a href="eliminar_usuario" class="waves-effect waves-red btn-flat" id="confirmarEliminar">Aceptar</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function setCategoryId(id) {
            var confirmarEliminarLink = document.getElementById('confirmarEliminar');
            confirmarEliminarLink.href = 'eliminar_usuario/' + id;

            var modal = M.Modal.getInstance(document.getElementById('eliminar_modal'));
            modal.open();
        }
    </script>

    <script src="{{ asset('materialize/js/materialize.js')}}"></script>
    <script src="{{ asset('js/navbar.js')}}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/buscador.js') }}"></script>
</body>

</html>