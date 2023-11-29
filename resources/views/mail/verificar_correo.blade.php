<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #3F51B5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .container {
            width: 100%;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 600px;
            height: 100vh;
        }

        .section{
            margin: auto 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #3F51B5;
        }

        h2{
            color: #121212;
            margin-top: 0;
        }

        p {
            color: #555555;
            text-align: center;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #5271FF;
            color: #ffffff;
            border-radius: 5px;
            margin-top: 15px;
        }

        .footer {
            margin-top: 20px;
            color: #C5CAE9;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="section">
            <h1>ST CFT QUIZ</h1>
            <h2>Verificación de Correo Electrónico</h2>
            <p>¡Gracias por registrarte! Por favor, haz clic en el siguiente enlace para verificar tu correo
                electrónico:</p>
            <a class="button" href="{{ url('validar_correo',$title)}}">Verificar Correo</a>
            <p class="footer">Si no has solicitado este correo, por favor ignóralo.</p>
        </div>
    </div>
</body>

</html>