<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg') }}" />
    <title>QUIZ ST CFT | Categorias</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gestion_pregunta.css') }}">

    <script src="{{ asset('js/toast.js')}}"></script>
</head>

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

    <!--Contenido gestion-->
    <main>
        <div class="container">
            <div class="row up_section">
                <div class="col s12 m12 l8">
                <h4 class="green-text text-darken-4"><i class="material-icons green-text text-darken-4">library_books</i> Gestionar Categorias</h4>
                </div>
                <div class="col s12 m12 l4" style="margin-top: 2%;">
                    <a class="waves-effect waves-light btn modal-trigger green" href="#crear_categoria" style="border-radius: 50px;"><i class="material-icons left">add</i>Crear Categoria</a>
                    <a class="waves-effect waves-light btn green darken-4 pendientes" href="{{route('gestionar_pregunta')}}" style="border-radius: 50px;"><i class="material-icons left">chevron_left</i> Volver</a>
                </div>
            </div>
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
            <div class="table-container">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Creador</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->categoria }}</td>
                            <td class="categoria">{{ $categoria->nombre_usuario . ' ' . $categoria->apellido_paterno . ' ' . $categoria->apellido_materno}}</td>
                            <td class="boton">
                                <a href="#editar_categoria" class="waves-effect waves-light btn-small blue darken-4 modal-trigger" style="border-radius: 50px;" onclick="setCategoryId('{{ $categoria->id_categoria_preguntas }}')">
                                    <i class="material-icons">edit</i>
                                </a>
                            </td>
                            <td class="boton"><a href="{{ route('borrar_categoria', $categoria->id_categoria_preguntas) }}" class="waves-effect waves-light btn-small modal-trigger red darken-1" style="border-radius: 50px;"><i class="material-icons">delete</i></a></td>
                        </tr>
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
                        <li><a class="active" href="{{ route('gestionar_pregunta') }}" style="background-color: #C4DBD6; border-radius: 10px;"><i class="material-icons light-green-text text-darken-4">format_list_bulleted</i></a></li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <!--Estructura de modals-->

    <div id="crear_categoria" class="modal">
        <div class="modal-content">
            <h3 class="green-text text-darken-4">Crear Categoria</h3>
            <div class="divider"></div>
            <div class="row" style="margin-top: 4%;">
                <form class="col s12" action="crear_categoria" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="pregunta-txt" name="nueva_categoria" class="materialize-textarea" required maxlength="50"></textarea>
                            <label for="pregunta-txt">Nueva Categoria</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 4%;">
                        <button class="btn col s12 m4 waves-effect waves-light green darken-4" type="submit" name="action">Crear
                            Categoria
                            <i class="material-icons right">add</i>
                        </button>
                        <button class="btn modal-close col s12 m4 offset-m1 waves-effect waves-light red form_cancel" type="submit" name="action">Cancelar
                            <i class="material-icons right">close</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editar_categoria" class="modal">
        <div class="modal-content">
            <h3 class="green-text text-darken-4">Editar Categoria</h3>
            <div class="divider"></div>
            <div class="row" style="margin-top: 4%;">
                <form class="col s12" action="editar_categoria" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="pregunta-txt" name="categoria" class="materialize-textarea" required maxlength="50"></textarea>
                            <label for="pregunta-txt">Categoria</label>
                        </div>
                    </div>
                    <input id="id_categoria" name="id_categoria" type="hidden" value="">

                    <div class="row" style="margin-top: 4%;">
                        <button class="btn col s12 m4 waves-effect waves-light indigo" type="submit" name="action">Editar
                            Categoria
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
    <script>
        function setCategoryId(id) {
            //console.log('Valor antes del clic:', document.getElementById('id_categoria').value);
            document.getElementById('id_categoria').value = id;
            //console.log('Valor después del clic:', document.getElementById('id_categoria').value);
        }
    </script>

    <script src="{{ asset('materialize/js/materialize.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/modal_gestion.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/select.js') }}"></script>
</body>

</html>