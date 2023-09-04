<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styleAsesorAcademico/asesoresAcademicosCalificacionAlumnoStyle.css"rel="stylesheet" >
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
                <a href="">ESTADÍAS</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">calificaciones</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">201600069</a>
               
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        
            <form action="{{ route('calificacionAsesorAcademico.index')}}" class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador">
            </form>
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">calificación alumno</span> </h1>

                <div class="contenedor-informacion-alumno">
                    <div class="contenedor-items-alumno">
                        <div class="contenedor-asignatura-alumno">
                            <div class="imagen-proceso-asignatura">
                                <img class="imagen-proceso" src="/icons/usuario-ESTADIAs.png" alt="">
                            </div>
                                <p class="nombre-proceso-asignatura">{{$datosAlumno[0]->nombre_proceso}}</p>
                            <div>

                            </div>
                        </div>
                        <div class="contenedor-nombre-alumno">
                            <p class="nombre-alumno">nombre: {{$datosAlumno[0]->nombres}}</p>
                        </div>
                        <div class="contenedor-matricula-alumno">
                            <p class="matricula-alumno">matrícula: {{$datosAlumno[0]->matricula}}</p>
                        </div>
                        <div class="contenedor-carrera-alumno">
                            <p class="carrera-alumno">carrera: {{$datosAlumno[0]->nombre_carrera}}</p>
                        </div>
                        <div class="contenedor-empresa-alumno">
                            <p class="empresa-alumno">empresa: {{$datosAlumno[0]->nombre_emp}}</p>
                        </div>
                        <div class="contenedor-empresa-convenio-alumno">
                            <p class="empresa-convenio-alumno">convenio: </p>
                        </div>
                        <div class="contenedor-ver-cedula-alumno">
                            <a href="" class="ver-cedula">documentación: 06/09</a>
                        </div>
                    </div>
                </div>

        </div>
        {{-- ESTATUS DE LA CEDULA --}}
        <div class="contenedor-informacion-cedula">
            <div class="contenedor-items-cedula">
                <p class="frase-definicion-proyecto">calificación final: 100</p>
                <p class="estatus-definicion-proyecto">ponderar una calificación al alumno de acuerdo a su desempeño en el periodo </p>
                <p>asignado, donde 0 es el mínimo y 100 el máximo de califiación </p>
            </div>

        </div>

        {{--  seccion del avance documentacion   --}}
        <section class="contenedor-observaciones">

             <div class="contenedor-observaciones-generales">
                        {{-- <a href="" ></a> --}}
                        {{-- <a href="" class="boton-ingresar-calificacion">
                        </a> --}}
                        <a href="{{ route('ingresarCalificacion', [$identificador = $datosAlumno[0]->id_alumno, $identificadorProceso = $datosAlumno[0]->id_proceso])}}" class="boton-ingresar-calificacion">
                        
                        ingresar calificación    
                        
                        </a>
                        {{-- <input type="button" onclick="{{ route('ingresarCalificacion', [$identificador = $datosAlumno[0]->id_alumno, $identificadorProceso = $datosAlumno[0]->id_proceso])}}" value="ingresar calificación" class="boton-ingresar-calificacion"> --}}

                <div class="contenedor-calificaciones">
                            <div class="primeras-calificaciones">
                                <p class="titulo-actitud">actitud</p>
                                <div class="contenido-primera-calificacion">

                                    
                                    <p class="aptitudes-1">aptitudes</p>
                                    <p class="calificacion-1">cal.</p>
                
                                    <label for="asistencia-puntualidad" class="asistencia-puntualidad">Asistencia y Puntualidad</label>
                                    <input type="number" name="calificacion-01" placeholder="N/A" class="calificacion-01" size="3"  min="0" max="100" readonly="readonly" >
                
                                    <label for="respeto-normas-reglamentos" class="respeto-normas-reglamento">respeto a normas y reglamentos</label>
                                    <input type="number" name="calificaion-02" placeholder="N/A" class="calificacion-02" size="3" min="0" max="100"  readonly="readonly" >
                
                
                                    <label for="diciplina-tareas-asignadas" class="diciplina-tareas-asignadas">diciplina en tareas asignadas</label>
                                    <input type="number" name="calificaion-03" placeholder="N/A" class="calificacion-03" size="3" min="0" max="100"  readonly="readonly" >
                
                                    
                                    <label for="capacidad-integracion-colaboracion" class="capacidad-integracion-colaboracion">capacidad de integración y colaboracion</label>
                                    <input type="number" name="calificaion-04" placeholder="N/A" class="califiacion-04" size="3" min="0" max="100" readonly="readonly" >
                
                                    </div>
                            </div>
            
            
            
                    <div class="segundas-calificaciones">
                        <p class="titulo-desempenio">desempeño</p>
                        <div class="contenido-segunda-calificacion">

                            <p class="aptitudes-2">aptitudes</p>
                            <p class="calificacion-2">cal.</p>

                            <label for="cumplimiento-plan-trabajo" class="cumplimiento-plan-trabajo">cumplimiento del plan de trabajo</label>
                            <input type="number" name="calificacion-05" placeholder="N/A" class="califiacion-05" size="3" min="0" max="100" readonly="readonly" >

                            <label for="interes-funcion-empresa" class="interes-funcion-empresa">interés por funciones de la empresa</label>
                            <input type="number" name="calificacion-06" placeholder="N/A" class="calificacion-06" size="3" min="0" max="100" readonly="readonly" >


                            <label for="entrega-resultados-tareas-asignadas" class="entrega-resultados-tareas-asignadas">entrega resultados de tareas asignadas</label>
                            <input type="number" name="calificaion-07" placeholder="N/A" class="calificacion-07" size="3"  min="0" max="100" readonly="readonly" >

                            
                            <label for="toma-decisiones-oportunas" class="toma-decisiones-oportunas">toma decisiones oportunas</label>
                            <input type="number" name="calificaion-08" placeholder="N/A" class="califiacion-08" size="3"  min="0" max="100" readonly="readonly">

                            <label for="demuestra-seguridad-habilidad" class="demuestra-seguridad-habilidad">demuestra seguridad habilidad</label>
                            <input type="number" name="calificaion-09" placeholder="N/A" class="califiacion-09" size="3" min="0" max="100" readonly="readonly">
                            
                            </div>
                    </div>



                    <div class="terceras-calificaciones">
                        <p class="titulo-producto">producto</p>
                        <div class="contenido-tercera-calificacion">
                            <p class="aptitudes-2">aptitudes</p>
                            <p class="calificacion-2">cal.</p>

                            <label for="redacción-ortografía-formato" class="redacción-ortografía-formato">redacción, ortografía y formato</label>
                            <input type="number" name="calificacion-10" placeholder="N/A" class="califiacion-10" size="3"  min="0" max="100" readonly="readonly"  >

                            <label for="cumplimiento-proyecto" class="cumplimiento-proyecto">cumplimiento del estatus-definicion-proyecto</label>
                            <input type="number" name="calificaion-11" placeholder="N/A" class="califiacion-11" size="3"  min="1" max="100" readonly="readonly" >


                            <label for="conclusiones-contribucion-tecnica" class="conclusiones-contribucion-tecnica">conclusiones y contribución técnica</label>
                            <input type="number" name="calificaion-12" placeholder="N/A" class="califiacion-11" size="3"  min="0" max="100" readonly="readonly" >

                        </div>
                    </div>
                </div>

            </div>
                       
        </section>
    </main>
</body>
</html>