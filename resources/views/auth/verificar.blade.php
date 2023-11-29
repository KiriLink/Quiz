<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/caraguino.png')}}" />
    <title>QUIZ ST CFT | Reenviar verificación</title>

    <link rel="stylesheet" href="{{ asset('css/formulario.css')}}">
</head>

<body>
    <div class="position">
        <!--Contenedor formulario-->
        <form class="container" action="{{route('reenviar_correo')}}" method="POST">
            @csrf
            <div class="centering-wrapper">
                <div class="section1 text-center">
                    <!--Titulo-->
                    <div class="primary-header">QUIZ ST CFT</div>
                    <div class="secondary-header">Reenviar correo de verificación</div>
                    <!--Inicio preguntas-->
                    <div class="input-position">
                        <!--Contenedor de pregunta-->
                        <div class="form-group">
                            <h5 class="input-placeholder" id="email-txt">Correo Electrónico<span class="error-message" id="email-error"></span></h5>
                            <input type="email" required="true" name="email" class="form-style" id="logemail" autocomplete="off" style="margin-bottom: 20px;">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                    </div>
                    <!--subtexto-->
                    <div style="color: #FF5757;">
                        @error('email')
                        <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <!--Boton-->
                    <div class="btn-position">
                        <button class="btn" type="submit" name="action">Reenviar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/login.js')}}"></script>

</body>

</html>