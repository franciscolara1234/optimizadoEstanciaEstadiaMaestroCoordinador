<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styleCoordinadores/inicioEstadiasCoordinadores.css"rel="stylesheet" >
    <title>UPQROO</title>
</head>
<body>
    <header class="header">
        @extends('plantillas/coordinadores/plantillaCoordinadoresMenu')
        @section('headerStart')
        @endsection
    </header>

    <main class="main-container">
        {{-- seccionde barra de navegacion --}}
        <section class="barra-navegacion"> 
            <div class="items-navegacion">
                <a href="">ESTADIAS</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">informacion alumno</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
               
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        
        {{-- method="post"   target="_blank"--}}
            <form action="/informacion/"  class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit" value="Buscar alumno" class="boton-buscador" >
            </form>
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">alumno estadias</span> </h1>
          

            <div class="informacion-general">
                <div class="contenido-informacion-general">

                    <div class="cantidad-alumnos">
                       
                            <h3>alumnos</h3>
                   
                        <h2>100</h2>
                        
                    </div>
                    <div class="alumnos-con-empresa">
                            <h3>con empresa</h3>
                        <h2>100</h2>
                    </div>
                    <div class="alumnos-sin-empresa">
                        <h3>sin empresa</h3>
                        <h2>100</h2>
                      
                    </div>
                    <div class="cantidad-empresas">
                        <h3>empresas</h3>
                        <h2>100</h2>
                    </div>
                    <div class="empresas-con-convenio">
                        <h3>con convenio</h3>
                        <h2>100</h2>
                    </div>
                    <div class="empresas-sin-convenio">
                        <h3>sIN CONVENIO</h3>
                        <h2>100</h2>
                    </div>
                </div>
            </div>

        </div>
        {{--  seccion del data table  --}}
        <section class="data-table">

        </section>
    </main>
</body>
</html>