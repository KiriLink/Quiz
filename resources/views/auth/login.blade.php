<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz | Inicio de sesión</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logotipo-santo-tomas-horizontal.svg')}}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css')}}">

    <link rel="stylesheet" href="assets/estilos.css">
</head>

<body>
    <div class="logos1">
        <img src="{{ asset('assets/logotipo-santo-tomas-horizontal.svg')}}" class="img-logo1" alt="logo">
        <h1 class="titulo">Area de salud CFT<span class="subtitulo"> Santo Tomas</span></h1>
    </div>

    <div class="position">
        <!--Contenedor formulario-->
        <form class="container" action="{{route('login')}}" method="POST">
            @csrf
            <div class="centering-wrapper">
                <div class="section1 text-center">
                    <!--Titulo-->
                    <div class="primary-header">Inicio Sesión</div>
                    <!--Inicio preguntas-->
                    <div class="input-position">
                        <!--Contenedor de pregunta-->
                        <div class="form-group">
                            <h5 class="input-placeholder" id="email-txt">Correo Electronico<span class="error-message" id="email-error"></span></h5>
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
                    <div class="password-container"><a href="#" class="link">Olvide mi contraseña</a></div>
                    @error('email'){{ 'Las credenciales son incorrectas' }}@enderror
                    <!--Boton-->

                    <div class="btn-position">
                        <button class="btn" type="submit">Iniciar Sesión</button>
                    </div>
                    <!--subtexto-->
                    <div class="down-text">¿No tienes cuenta? <a href="{{route('register')}}" class="link">Registrarse</a></div>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/index.js')}}"></script> <!--importar js-->
</body>

</html>