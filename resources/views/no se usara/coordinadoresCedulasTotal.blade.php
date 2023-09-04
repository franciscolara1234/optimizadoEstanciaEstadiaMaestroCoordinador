<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styleCoordinadores/coordinadoresCedulasTotalStyle.css"rel="stylesheet" >
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
                <a href="">ALUMNOS</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">201600069</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        
            <form action="../../form-result.php" method="post" target="_blank" class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador">
            </form>
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">definición de proyectos </span> </h1>

                <div class="contenedor-informacion-general-cedulas">

                    <div class="alumnos-total">
                        <p>alumnos:</p>
                        <p>34</p>
                    </div>

                    <div class="cedulas-en-linea">
                        <p>cedulas en linea:</p>
                        <p>22</p>
                    </div>
                    <div class="cedulas-aprobadas">
                        <p>cedulas aprobadas:</p>
                        <p>18</p>
                    </div>
                    <div class="cedulas-rechazadas">
                        <p>cedulas rechazadas:</p>
                        <p>04</p>
                    </div>
                    
                    
                </div>

        </div>
        {{--  seccion del del datatable --}}
        <section class="contenedor-data-table">

           
        </section>
    </main>
</body>
</html>