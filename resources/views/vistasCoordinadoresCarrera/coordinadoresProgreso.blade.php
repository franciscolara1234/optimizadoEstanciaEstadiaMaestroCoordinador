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
                <a href="">{{$tituloPagina}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">progreso vinculación</a>
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
            
                <h1 > <span class="nombre-pagina">progreso vinculación {{$tituloPagina}}</span> </h1>
          

            <div class="informacion-general">
                <div class="contenido-informacion-general">

                    <div class="cantidad-alumnos">
                       
                            <h3>alumnos</h3>
                        <h2>{{$procesosAsignados->count()}}
                        </h2>                       
                        {{-- <h2>{{$contadorAlumnosProceso}}
                        </h2>                        --}}
                    </div>
                    <div class="alumnos-con-empresa">
                            <h3>con empresa</h3>
                        {{-- <h2>2</h2> --}}
                        <h2>{{$alumnosConEmpresa}}</h2>
                    </div>
                    <div class="alumnos-sin-empresa">
                        <h3>sin empresa</h3>
                        {{-- <h2>3</h2> --}}
                        <h2>{{$alumnosSinEmpresa}}</h2>
                      
                    </div>
                    {{-- <div class="cantidad-empresas">
                        <h3>empresas</h3>
                        <h2>100</h2>
                    </div>
                    <div class="empresas-con-convenio">
                        <h3>con convenio</h3>
                        <h2>100</h2>
                    </div>
                    <div class="empresas-sin-convenio">
                        <h3>SIN CONVENIO</h3>
                        <h2>0</h2>
                    </div> --}}
                </div>
            </div>

        </div>
        {{--  seccion del data table  --}}
        <section class="data-table">
            {{-- {{$proceso}} --}}
                {{-- <p>
                    {{$procesos['id_asesor_academico']}}
                    {{-- {{$proceso['id_carrera']}} --}}
                {{-- </p>  --}}
        <div class="card">
             <div class="card-body">
                <table class="table table-striped" id="usuarios" class="table table-striped table-bordered" style="width:100%">               
                    <thead>
                            <tr>
                                <th>matrícula</th>
                                <th>Nombre</th>
                                <th>proceso</th>
                                <th>carrera</th>
                                <th>Maestro</th>
                                <th>Ver Progreso</th>
                                <th>Ciclo Escolar</th>
                            </tr>
                        
                    </thead>
                    <tbody class="table-scroll">
                        {{-- @foreach ($datosTabla as $datosTabla)
                            @foreach (10 as 1)
                            
                                <tr >
                                    <td>alumno</td>
                                    <td>
                                        <a href="">
                                        </a>
                                    </td>
                                    <td>3</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td><a href="">cedula en linea</a></td>
                                </tr>
                            @endforeach  --}}
                            @foreach ($procesosAsignados as $items)
                            
                                <tr >
                                    {{-- <td>{{$datosTabla['matricula']}}</td> --}}
                                    <td>{{$items->user_proceso->Matricula}}</td>
                                    <td>
                                        <div>

                                            {{$items->user_proceso->alumno_perfil_user->Nombre}} {{$items->user_proceso->alumno_perfil_user->APP}} {{$items->user_proceso->alumno_perfil_user->APM}}
                                        </div>
                                    </td>
                                    <td>{{$items->tipo_procesos_proceso->nombreProceso}}</td>
                                    <td>{{$items->user_proceso->carrera_user->NombreCarrera}}</td>
                                    <td>{{$items->aa_academico_procesos[0]->aa_academico->Nombre}} {{$items->aa_academico_procesos[0]->aa_academico->APP}} {{$items->aa_academico_procesos[0]->aa_academico->APM}}</td>
                                    <td><p><a href="{{ route('progresoDocumentacionCoordinacion', $identificadorProceso = $items->IdProceso) }}" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="color:#3B96D1;">Ver Progreso</a></p></td>
                                    {{-- <td>{{$datosTabla['nombre_proceso']}}</td>
                                    <td>{{$datosTabla['nombre_carrera']}}</td>
                                    <td>{{$datosTabla['nombre_emp']}}</td> --}}
                                   
                                    <td> 
                                    {{$items->periodo_proceso->Periodo}}
                                    </td>
                                </tr>
                            @endforeach 
                    </tbody>
                </table>
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