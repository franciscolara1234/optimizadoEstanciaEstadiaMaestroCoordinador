<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css
    ">
    <link href="/css/styleAsesorAcademico/inicioProcesoAsesorAcademicoStyle.css"rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

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
                <a href="">INICIO</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">NO EXISTE PERIDO</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
            <a href="">NO EXISTE PERIODO</a>
                {{-- <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">201600069</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion"> --}}
            </div>

        </section>
        <div class="buscador-matricula">

        </div>
        {{-- SECCION DEL BUSCADOR --}}
        {{-- method="post" target="_blank" --}}
            {{-- <form action="academicosinfoalumno"  class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit" value="Buscar alumno" class="boton-buscador">
            </form>
         --}}
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">NO EXISTE PERIODO ABIERTO POR FAVOR CONTACTAR A ADMINISTRACIÓN</span> </h1>
          

    
        {{--  seccion del data table  --}}
        <section class="data-table">
            {{-- {{$proceso}} --}}
                {{-- <p>
                    {{$procesos['id_asesor_academico']}}
                    {{-- {{$proceso['id_carrera']}} --}}
                {{-- </p>  --}}
        <div class="card">
             <div class="card-body">
 
            </div>
        </div>
            {{-- {{$datosTabla}} --}}
        </section>
    </main>
    {{-- se llama a la plantilla que ocntiene todos los scrips con los cdns necesarios para cargar el data table --}}
    @extends('plantillas/plantillaJsDataTable')
    @section('scripstStart')
    @endsection
</body>

</html>