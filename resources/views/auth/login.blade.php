<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/caraguino.png')}}" />
    <title>QUIZ ST CFT | Inicio de Sesion</title>

    <link rel="stylesheet" href="{{ asset('css/formulario.css')}}">
</head>

<body>
    <div class="position">
        <!--Contenedor formulario-->
        <form class="container" action="{{route('login')}}" method="POST">
            @csrf
            <div class="centering-wrapper">
                <div class="section1 text-center">
                    <!--Titulo-->
                    <div class="primary-header">QUIZ ST CFT</div>
                    <div class="secondary-header">Inicio de Sesión</div>
                    <!--Inicio preguntas-->
                    <div class="input-position">
                        <!--Contenedor de pregunta-->
                        <div class="form-group">
                            <h5 class="input-placeholder" id="email-txt">Correo Electrónico<span class="error-message" id="email-error"></span></h5>
                            <input type="email" required="true" name="email" class="form-style" id="logemail" autocomplete="off" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="pword-txt">Contraseña<span class="error-message" id="password-error"></span></h5>
                            <input type="password" required="true" name="password" class="form-style" id="logpass" autocomplete="on">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                    </div>
                    <!--subtexto-->
                    <div class="password-container"><a href="{{route('verificar')}}" class="link">No recibí correo de verificación</a></div>
                    <div style="color: #FF5757;">
                        @error('email')
                        @if($message == 'Tu cuenta aún no ha sido verificada.')
                        {{ $message }}
                        @else
                        {{ 'Las credenciales son incorrectas' }}
                        @endif
                        @enderror
                    </div>
                    @if(session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('verification-message'))
                    <div style="color: green;">
                        {{ session('verification-message') }}
                    </div>
                    @endif
                    <!--Boton-->
                    <div class="btn-position">
                        <button class="btn" type="submit" name="action">Iniciar Sesión
                        </button>
                    </div>
                    <!--subtexto-->
                    <div class="down-text">¿No tienes cuenta? <a href="{{route('register')}}" class="link">Registrarse</a></div>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/login.js')}}"></script>

</body>

</html>