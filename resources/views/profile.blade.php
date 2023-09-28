<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="Assets/Media/logo.png" />
    <title>GUINO | Perfil</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="Assets/materialize/css/materialize.css">
    <link rel="stylesheet" href="Assets/CSS/profile.css">
    <link rel="stylesheet" href="Assets/css/navbar.css">
</head>

<body>
    <div class="navbar">
        <nav>
            <div class="nav-wrapper indigo">
                <img src="Assets/Media/logo_nav.png" alt="" class="circle responsive-img logo">
                <span class="brand-logo hide-on-med-and-down">MaxWell FairField</span>
                <span
                    class="sub-brand-logo indigo-text text-accent-1 hide-on-med-and-down">m.fairfield21@gmail.com</span>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="" style="font-weight: bolder; font-size: 1.2rem;"><i
                                class="material-icons left red-text">favorite</i>5</a></li>
                    <li><a href="" style="font-weight: bold; font-size: 1.1rem;"><i
                                class="material-icons left teal-text text-lighten-2">stars</i>Platino</a></li>
                    <li><a href="" class="waves-effect waves-light btn yellow darken-2"><i
                                class="material-icons">edit</i></a></li>
                    <li><a href="" class="waves-effect waves-light btn red accent-2"><i
                                class="material-icons">exit_to_app</i></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <li><a href=""><i class="material-icons left">person</i>MaxWell FairField</a></li>
        <li><a href=""><i class="material-icons left">email</i>m.fairfiel</a></li>
        <li><a href="" style="font-weight: bolder; font-size: 1.2rem;"><i
                    class="material-icons left red-text">favorite</i>5</a></li>
        <li><a href="" style="font-weight: bold; font-size: 1.1rem;"><i
                    class="material-icons left teal-text text-lighten-2">stars</i>Platino</a></li>
        <li><a href=""><i class="material-icons left yellow-text text-darken-2">edit</i>Editar Perfil</a></li>
        <li><a href=""><i class="material-icons left red-text text-accent-2">exit_to_app</i>Cerrar Sesion</a></li>
    </ul>
    <main>
        <div class="container">
            <h3 class="title_bar">Rendimiento en tópicos de preguntas</h3>

            <div class="bar light-blue darken-2" data-percent="85%"><span class="label">Biología</span></div>
            <div class="bar light-blue darken-1" data-percent="75%"><span class="label">Historia</span></div>
            <div class="bar light-blue" data-percent="65%"><span class="label">Filosofia</span></div>
            <div class="bar light-blue lighten-1" data-percent="100%"><span class="label">Arte</span></div>
            <div class="bar light-blue lighten-2" data-percent="90%"><span class="label">Química</span></div>
            <div class="bar light-blue lighten-3" data-percent="80%"><span class="label">Física</span></div>
            <div class="bar light-blue lighten-4" data-percent="85%"><span class="label">Economía</span></div>
            <div class="bar light-blue accent-1" data-percent="75%"><span class="label">Literatura</span></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12 m6">
                    <p class="title_rank">Aciertos en preguntas</p>
                    <div class="center-vertical">
                        <div class="chart graph" id="graph" data-percent="21"></div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <p class="title_rank">Mejor racha en desafio</p>
                    <div class="center-vertical">
                        <i class="material-icons large yellow-text">star</i>
                        <p class="rank_num">0</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="footer-fixed">
        <footer class="">
            <nav class="z-depth-0">
                <div class="nav-wrapper indigo">
                    <ul class="justify">
                        <li><a href="#!" style="background-color: #869DF1; border-radius: 10px;"><i
                                    class="material-icons indigo-text">person</i></a></li>
                        <li><a href="#!"><i class="material-icons">lightbulb</i></a></li>
                        <li><a href="#!"><i class="material-icons">grade</i></a></li>
                        <li><a href="#!"><i class="material-icons">home</i></a></li>
                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="Assets/materialize/js/materialize.js"></script>
    <script src="Assets/JS/graph_bars.js"></script>
    <script src="Assets/JS/graph_circle.js"></script>
    <script src="Assets/JS/navbar.js"></script>
    <script src="Assets/JS/downbar.js"></script>
</body>

</html>