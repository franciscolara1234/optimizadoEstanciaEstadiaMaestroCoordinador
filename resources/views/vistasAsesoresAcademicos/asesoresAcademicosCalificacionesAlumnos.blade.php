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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <link href="/css/styleAsesorAcademico/asesoresAcademicosCalificacionesAlumnosStyle.css"rel="stylesheet" >
    <title>UPQROO</title>
</head>
<body>
    <header class="header">
        @extends('plantillas/asesoresAcademicos/plantillaAsesorAcademicoMenu')
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
                <a href="">ALUMNOS</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">calificaciones</a>
                {{-- <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion"> --}}
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        {{-- method="post" target="_blank" --}}
        
        <div class="buscador-matricula">

        </div>

            {{-- <form action="{{ route('calificacionAsesorAcademico.index')}}"  class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador">
            </form> --}}

       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">

                <h1 > <span class="nombre-pagina">calificaciones PARA</span> </h1>
                <h1 > <span class="nombre-pagina">REPORTE DE EVALUACIÓN {{$tituloPagina}}</span> </h1>

                <div class="contenedor-informacion-calificaciones-alumnos">

                    <div class="alumnos-total">
                        <p>alumnos:</p>
                        <p>{{$alumnosEntotal}}</p>
                    </div>

                    <div class="alumnos-pendientes-de-calificacion">
                        <p>pendientes de calificación:</p>
                        <p>{{$alumnosSinCalificacion}}</p>
                    </div>
                    <div class="alumnos-aprobados">
                        <p>alumnos aprobados:</p>
                        <p>{{$alumnosAprobados}}</p>
                    </div>
                    <div class="alumnos-reprobados">
                        <p>alumnos reprobados:</p>
                        <p>{{$alumnosReprobados}}</p>
                    </div>


                </div>

        </div>
        {{--  seccion del del datatable --}}
        <section class="contenedor-data-table">
            <div class="card">
                <div class="card-body">
                   <table class="table table-striped" id="usuarios" class="table table-striped table-bordered" style="width:100%">               
                       <thead>
                               <tr>
                                   <th>matrícula</th>
                                   <th>Nombre</th>
                                   <th>proceso</th>
                                   <th>carrera</th>
                                   <th>calificación</th>
                                   <th>calificación final</th>
                               </tr>
                           
                       </thead>
                       <tbody class="table-scroll">
                           @foreach ($procesosAsignados as $item)
                           
                               <tr >
                                   <td>
                                    {{-- {{$datosTabla['matricula']}} --}}
                                    {{$item->proceso->user_proceso->Matricula}}

                                </td>
                                   <td>
                                    {{$item->proceso->user_proceso->alumno_perfil_user->Nombre}} {{$item->proceso->user_proceso->alumno_perfil_user->APP}} {{$item->proceso->user_proceso->alumno_perfil_user->APM}}

                                       {{-- <a href="{{ route('verCalificacionesAlumno',[ $identificador=$datosTabla['id_alumno'], $identificadorProceso = $datosTabla['id_proceso']])}}"> --}}
                                           {{-- {{$datosTabla['nombres']}}
                                           {{$datosTabla['ape_paterno']}}
                                           {{$datosTabla['ape_materno']}} --}}
                                       {{-- </a> --}}
                                   </td>
                                   <td>
                                    {{-- {{$datosTabla['nombre_proceso']}} --}}
                                    
                                    {{$item->proceso->tipo_procesos_proceso->nombreProceso}}

                                    </td>
                                   <td>
                                    {{-- {{$datosTabla['nombre_carrera']}} --}}
                                    {{$item->proceso->user_proceso->carrera_user->NombreCarrera}}

                                   </td>
                                    <td>
                                        
                                        @if (sizeof($item->proceso->calificaciones_proceso)==0)
                                            <a style="color: #3B96D1" href="{{ route('ingresarCalificacion', [$idProcesoAlumno=$item->proceso->IdProceso, $identificadorProceso = $item->proceso->IdTipoProceso] )}}">
                                                ingresar calificacion
                                            </a>

                                        @else
                                        <a href="{{ route('ingresarCalificacion', [$idProcesoAlumno=$item->proceso->IdProceso, $identificadorProceso = $item->proceso->IdTipoProceso])}}" style="color:#3B96D1">
                                            Ver Calificación
                                        </a>
                                        @endif

                                    </td>
                                   <td>
                                    @if (sizeof($item->proceso->calificaciones_proceso)==0)
                                        N/A 
                                    @else
                                        @if (($item->proceso->calificaciones_proceso[0]->TipoCalificaciones)==1)
                                            {{$item->proceso->calificaciones_proceso[0]->cal_final}}
                                        @else
                                            {{$item->proceso->calificaciones_proceso[1]->cal_final}}
                                        @endif
                                    @endif
                                    </td>
                               </tr>
                           @endforeach 
                       </tbody>
                   </table>
               </div>
           </div>
           
        </section>
        @extends('plantillas/plantillaJsDataTable')
        @section('scripstStart')
        @endsection

    </main>
</body>
</html>