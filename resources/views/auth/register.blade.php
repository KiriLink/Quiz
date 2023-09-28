<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz | Registrar</title>

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
        <br><br>
        <!--Contenedor formulario-->
        <form class="container" action="{{route('register')}}" method="POST">
            @csrf
            <div class="centering-wrapper">
                <div class="section1 text-center">
                    <!--Titulo-->
                    <div class="primary-header">Registrar</div>
                    <!--Inicio preguntas-->
                    <div class="input-position">
                        <!--Contenedor de pregunta-->
                        <div class="form-group">
                            <h5 class="input-placeholder" id="nombre-txt">Rut<span class="error-message" id=""></span></h5>
                            <input type="text" required="true" name="regrut" class="form-style" id="regnombre" autocomplete="off" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-at"></i>
                        </div><!--MODIFICAAAAAAAAAAAAAAAAAAAAAAAAAAR--><!--MODIFICAAAAAAAAAAAAAAAAAAAAAAAAAAR--><!--MODIFICAAAAAAAAAAAAAAAAAAAAAAAAAAR-->
                        <div class="form-group">
                            <h5 class="input-placeholder" id="email-txt">Correo Electrónico<span class="error-message" id="email-error"></span></h5>
                            <input type="email" required="true" name="email" class="form-style" id="logemail" autocomplete="off" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="nombre-txt">Nombre<span class="error-message" id=""></span></h5>
                            <input type="text" required="true" name="name" class="form-style" id="regnombre" autocomplete="off" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="ap-txt">Apellido Paterno<span class="error-message" id=""></span></h5>
                            <input type="text" required="true" name="regap" class="form-style" id="regap" autocomplete="off" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="am-txt">Apellido Materno<span class="error-message" id=""></span></h5>
                            <input type="text" required="true" name="regam" class="form-style" id="regam" autocomplete="off" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-at"></i>
                        </div>

                        <div class="form-group">
                            <h5 class="input-placeholder" id="pword-txt">Contraseña<span class="error-message" id="password-error"></span></h5>
                            <input type="password" required="true" name="password" class="form-style" id="logpass" autocomplete="on" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group">
                            <h5 class="input-placeholder" id="pword-txt">Confirmar Contraseña<span class="error-message" id="password-error"></span></h5>
                            <input type="password" required="true" name="password_confirmation" class="form-style" id="logpass" autocomplete="on" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                    </div>
                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <!--Boton-->
                    <div class="btn-position">
                        <button class="btn" type="submit">Registrarse</a>
                    </div>
                    <!--Subtexto-->
                    <div class="down-text">¿Ya tienes cuenta? <a href="{{route('login')}}" class="link">Inicia sesión</a></div>
                </div>
            </div>
        </form>
    </div>

    <script src="Assets/js/registro.js"></script>
</body>

</html>