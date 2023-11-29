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
            height: 100vh;
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
            height: 100%;
        }

        .section {
            margin: auto 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #3F51B5;
        }

        h2 {
            color: #121212;
            margin-top: 0;
        }

        p {
            color: #555555;
            text-align: center;
        }

        .password-display {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 18px;
            color: #333;
            text-align: center;
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
            <h2>Contraseña de Recuperación</h2>
            <p>{{ $content }}</p>
            <div class="password-display">{{ $pass }}</div>
            <p class="footer">Guárdala en un lugar seguro. Si no has solicitado esta recuperación, por favor ignóralo.</p>
        </div>
    </div>
</body>

</html>
