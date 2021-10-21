@include('layouts.app')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Perfil Usuario</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles_resume.css" rel="stylesheet" />
        {!!Html::style('css/styles.css')!!}
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">{{$user->name}}</span>
               
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Datos Personales</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">Datos Laborales</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('perfiles.index')}}" >Perfiles</a></li>                                                                                             </li>

                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            
            @if(isset($user->imagen))
            <img src="{{url('profiles/'. $user->imagen)}}" class="img-circle" alt="" style="width:400px;"/>
            @else
            <img src="https://image.flaticon.com/icons/png/512/64/64572.png" alt="" style="width:180px;"/>
            @endif

            <!-- <img src="{{url('profiles/'. $user->imagen)}}" class="img-circle" style="with:400px;height:400px;"> -->

            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <ul class="list-group">
                    <li class="list-group-item active">Datos Personales</li>
                    <li class="list-group-item">Nombre: {{$user->name}}</li>
                    <li class="list-group-item">Universidad: {{$user->universidad}}</li>
                    <li class="list-group-item">Sede: {{$user->sede}}</li>
                    <li class="list-group-item">Edad: {{$user->edad}}</li>
                    <li class="list-group-item">Sexo: {{$user->sexo}}</li>
                    <li class="list-group-item">Direccion: {{$user->direccion}}</li>
                    <li class="list-group-item">Telefono de casa: {{$user->telefono_casa}}</li>
                    <li class="list-group-item">Telefono celular: {{$user->telefono_celular}}</li>
                    <li class="list-group-item">Correo: <a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
                    </ul>
                </div>
            </section>
           
            <!-- Experience-->
            <section class="resume-section" id="experience">
                <div class="resume-section-content">
                <ul class="list-group">
                    <li class="list-group-item active">Datos Laborales</li>
                    @foreach ($puestos as $puesto)
                    <li class="list-group-item">Puesto: {{$puesto->titulo}}</li>
                    <li class="list-group-item">Tiempo: {{$puesto->tiempo}}</li>
                    <li class="list-group-item">Empresa:{{$puesto->empresa}}</li>
                    <li class="list-group-item">Historico: {{$puesto->tipo}}</li>
                    <p> </p>
                    <p> </p>
                    @endforeach

                </ul>
                </div>

            </section>
            @guest
                @if (Route::has('register'))
                @endif
                @else
                @if(Auth::user()->id==20)
                {!!Form::open(['route'=> ['user.destroy', $user->id],'method'=>'DELETE']) !!}
                {!!Form::submit('Eliminar Usuario', ['class' =>'btn btn-danger'])!!}
                {!!Form::close() !!} 
                @endif
            @endguest
           
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts_resume.js"></script>
        {!!Html::script('js/scripts_resume.js')!!}
    </body>
</html>
