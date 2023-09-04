<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/StyleCoordinadores/coordinadoresServicioSocial.css"rel="stylesheet" >

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
                <a href="">{{$informacionProcesoElejido[0]->tipo_procesos_proceso->nombreProceso}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">ALUMNOS</a>
                
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">progreso documentación</a>

                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">

                {{$informacionProcesoElejido[0]->user_proceso->Matricula}}

            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        {{-- method="post" target="_blank" --}}
            {{-- <form action="academicosinfoalumno" class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador">
            </form> --}
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">Progreso Documentación </span> </h1>

                <div class="contenedor-informacion-alumno">
                    <div class="contenedor-items-alumno">
                        <div class="contenedor-asignatura-alumno">
                            <div class="imagen-proceso-asignatura">
                                <img class="imagen-proceso" src="/icons/usuario-ESTADIAs.png" alt="">
                            </div >
                            <div>
                                <p class="nombre-proceso-asignatura">
                                    {{$informacionProcesoElejido[0]->tipo_procesos_proceso->nombreProceso}} {{$informacionProcesoElejido[0]->periodo_proceso->Periodo}}  

                                </p>
                            </div>
                     
                          
                        </div>
                        <div class="contenedor-nombre-alumno">
                             <p class="nombre-alumno">nombre:
                                {{$informacionProcesoElejido[0]->user_proceso->alumno_perfil_user->Nombre}}
                                {{$informacionProcesoElejido[0]->user_proceso->alumno_perfil_user->APP}}
                                {{$informacionProcesoElejido[0]->user_proceso->alumno_perfil_user->APM}}
                                {{-- {{$datosAlumno[0]->nombres}} 
                                {{$datosAlumno[0]->ape_paterno}}
                                {{$datosAlumno[0]->ape_materno}} --}}
                            </p>
                        </div>
                        <div class="contenedor-matricula-alumno">
                            <p class="matricula-alumno">matrícula:
                                {{$informacionProcesoElejido[0]->user_proceso->Matricula}}
                                  {{-- {{$datosAlumno[0]->matricula}} --}}
                            </p>
                        </div>
                        <div class="contenedor-carrera-alumno">
                            <p class="carrera-alumno">carrera: {{$informacionProcesoElejido[0]->user_proceso->carrera_user->NombreCarrera}}
   
                                  {{-- {{$datosAlumno[0]->nombre_carrera}} --}}
                            </p>
                        </div>
                        <div class="contenedor-empresa-alumno">
                            <p class="empresa-alumno">Ase. Empresarial: 
                                {{-- {{$datosAlumno[0]->nombre_emp}} --}}

                                @if (!empty($informacionProcesoElejido[0]->aempresarial_procesos->aemp_pro))
                                {{$informacionProcesoElejido[0]->aempresarial_procesos->aemp_pro->Nombre}}
                            @else
                                Sin asesor
                            @endif

                            {{-- {{$informacionProcesoElejido[0]->user_proceso->carrera_user->NombreCarrera}} --}}


                            </p>
                        </div>
                        <div class="contenedor-empresa-convenio-alumno">
                            <p class="empresa-convenio-alumno">Profesor(a):  {{$informacionProcesoElejido[0]->aa_academico_procesos[0]->aa_academico->Nombre}} {{$informacionProcesoElejido[0]->aa_academico_procesos[0]->aa_academico->APP}} {{$informacionProcesoElejido[0]->aa_academico_procesos[0]->aa_academico->APM}}</p>
                        </div>
                        <div class="contenedor-calificacion-alumno">
                            @if (empty($informacionProcesoElejido[0]->calificaciones_proceso[0]))
                                
                                <p class="calificacion-alumno">calificación: N/A</p> 
                            
                                
                            @else
                                @if (($informacionProcesoElejido[0]->calificaciones_proceso[0]->TipoCalificaciones)==1)

                                <a style="color: #3B96D1" class="calificacion-alumno" href="{{ route('anteriorCalificacion',[$procesoAlumno  = $informacionProcesoElejido[0]->IdProceso , $identificacdorProceso =  $informacionProcesoElejido[0]->IdTipoProceso ])}}">
                                    calificacion final: {{$informacionProcesoElejido[0]->calificaciones_proceso[0]->cal_final}}   
                                </a>


                                 
                                @elseif(($informacionProcesoElejido[0]->calificaciones_proceso[1]->TipoCalificaciones)==1)

                                <a style="color: #3B96D1" class="calificacion-alumno" href="{{ route('anteriorCalificacion',[$procesoAlumno  = $informacionProcesoElejido[0]->IdProceso , $identificacdorProceso =  $informacionProcesoElejido[0]->IdTipoProceso ])}}">
                                    calificación final: {{$informacionProcesoElejido[0]->calificaciones_proceso[1]->cal_final}}   
                                </a>
                                @endif

                                
                            
                            @endif

                        </div>
                    </div>
                </div>

        </div>
        {{--  seccion del avance documentacion   --}}
        <section class="contenedor-avance-documentacion-alumno">
            <h2 class="titulo-documentacion-avances"><span >Documentación vinculación</span></h2>
            <div class="contenedor-items-codigo-colores">
                <div class="documentacion-sin-intento">
                    <p class="texto-sin-intento">sin intento</p>
                </div>
                <div class="documentacion-pendiente-revision">
                    <p class="texto-sin-intento">Pendiente Revisión</p>
                </div>
                <div class="documentacion-aceptada">
                    <p class="texto-aceptado">aceptada</p>
                </div>
                <div class="documentacion-rechazada">
                    <p class="texto-rechazado">rechazada</p>
                </div>
            </div>
            <div class="contenedor-items-documentacion">

                <div  class="carga-horaria-alumno" style="background-color:{{$documentos[0]}}">
                    <p class="primer-documento">1</p>
                    <p class="nombre-primer-documento">carta presentación</p>
                </div>
                <div class="constancia-vigencia-seguro" style="background-color:{{$documentos[1]}}">
                    <p class="segundo-documento">2</p>
                    <p class="nombre-segundo-documento">carta aceptación</p>
                </div>
                <div class="carta-exclusion-responsabilidad" style="background-color:{{$documentos[2]}}">
                    <p class="tercer-documento">3</p>
                    <p class="nombre-tercer-documento">cédula registro</p>

                </div>

                <div class="carta-presentacion" style="background-color:{{$documentos[3]}}">
                    <p class="cuarto-documento">4</p>
                    <p class="nombre-cuarto-documento">Definición de proyecto</p>
                </div>
                {{-- @dump($document1,$document2,$document3,$document4,$document5) --}}
                <div class="cedula-registro" style="background-color:{{$documentos[4]}}">
                    <p class="quinto-documento">5</p>
                    <p class="nombre-quinto-documento">Carta de Liberación</p>
                </div>
                <div class="carta-aceptacion" style="background-color:{{$documentos[5]}}">
                    <p class="quinto-documento">6</p>
                    <p class="nombre-quinto-documento">Carta compromiso</p>
                </div>
                <div class="definicion-proyecto" style="background-color:{{$documentos[6]}}">

                    <p class="sexto-documento">7</p>
                    <p class="nombre-sexto-documento">Reporte mensual 1</p>
                </div>
                <div class="carta-liberacion" style="background-color:{{$documentos[7]}}">
                    <p class="septimo-documento">8</p>
                    <p class="nombre-septimo-documento">Reporte mensual 2</p>
                </div>
                <div class="reporte-evaluacion" style="background-color:{{$documentos[8]}}">
                    <p class="octavo-documento">9</p>
                    <p class="nombre-octavo-documento">Reporte mensual 3</p>

                </div>
                 <div class="documento10" style="background-color:{{$documentos[9]}}; " style="display: null " >
                    <p class="noveno-documento" >10</p>
                    <p class="nombre-noveno-documento">Reporte mensual 4</p>
                </div>
                 <div class="documento11" style="background-color:{{$documentos[10]}}; " style="display: null " >
                    <p class="noveno-documento" >11</p>
                    <p class="nombre-noveno-documento">Reporte mensual 5</p>
                </div>
                 <div class="documento12" style="background-color:{{$documentos[11]}}; " style="display: null " >
                    <p class="noveno-documento" >12</p>
                    <p class="nombre-noveno-documento">Reporte mensual 6</p>
                </div>
                 <div class="documento13" style="background-color:{{$documentos[12]}}; " style="display: null " >
                    <p class="noveno-documento" >13</p>
                    <p class="nombre-noveno-documento">Reporte mensual 7</p>
                </div>
                 <div class="documento14" style="background-color:{{$documentos[13]}}; " style="display: null " >
                    <p class="noveno-documento" >14</p>
                    <p class="nombre-noveno-documento">Reporte mensual 8</p>
                </div>
                 <div class="documento15" style="background-color:{{$documentos[14]}}; " style="display: null " >
                    <p class="noveno-documento" >15</p>
                    <p class="nombre-noveno-documento">Reporte mensual 9</p>
                </div>
                 <div class="documento16" style="background-color:{{$documentos[15]}}; " style="display: null " >
                    <p class="noveno-documento" >16</p>
                    <p class="nombre-noveno-documento">Reporte mensual 10</p>
                </div>
                 <div class="documento17" style="background-color:{{$documentos[16]}}; " style="display: null " >
                    <p class="noveno-documento" >17</p>
                    <p class="nombre-noveno-documento">Reporte mensual 11</p>
                </div>
                 <div class="documento18" style="background-color:{{$documentos[17]}}; " style="display: null " >
                    <p class="noveno-documento" >18</p>
                    <p class="nombre-noveno-documento">Reporte mensual 12</p>
                </div>
   
            </div>
           
           
        </section>
    </main>
    
</body>
</html>