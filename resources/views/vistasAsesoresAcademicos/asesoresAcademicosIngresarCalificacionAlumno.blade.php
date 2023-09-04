<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styleAsesorAcademico/asesoresAcademicosCalificacionAlumnoStyle.css"rel="stylesheet" >
    <title>UPQROO</title>
        <script>
        function confirmacion(){
            var respuesta=confirm('¿DESEA GUARDAR LAS CALIFICACIONES?');
            if(respuesta == true){
                return true;

            }else{
                return false;
            }
        }
    </script>
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
                <a href="">{{$procesoSeleccionado->tipo_procesos_proceso->nombreProceso}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">calificaciones</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">{{$procesoSeleccionado->user_proceso->Matricula}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}

        <div class="buscador-matricula">

        </div>

            {{-- <form action="../../form-result.php" method="post" target="_blank" class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador">
            </form> --}}
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">Calificación </span> </h1>

                <div class="contenedor-informacion-alumno">
                    <div class="contenedor-items-alumno">
                        <div class="contenedor-asignatura-alumno">
                            <div class="imagen-proceso-asignatura">
                                <img class="imagen-proceso" src="/icons/usuario-ESTADIAs.png" alt="">
                            </div>
                                <p class="nombre-proceso-asignatura">proceso {{$procesoSeleccionado->tipo_procesos_proceso->nombreProceso}}</p>
                            <div>

                            </div>
                        </div>
                        <div class="contenedor-nombre-alumno">
                            <p class="nombre-alumno">nombre: {{$procesoSeleccionado->user_proceso->alumno_perfil_user->Nombre}} {{$procesoSeleccionado->user_proceso->alumno_perfil_user->APP}} {{$procesoSeleccionado->user_proceso->alumno_perfil_user->APM}}</p>
                        </div>
                        <div class="contenedor-matricula-alumno">
                            <p class="matricula-alumno">Matrícula: {{$procesoSeleccionado->user_proceso->Matricula}}</p>
                        </div>
                        <div class="contenedor-carrera-alumno">
                            <p class="carrera-alumno">carrera: {{$procesoSeleccionado->user_proceso->carrera_user->NombreCarrera}}</p>
                        </div>
                        <div class="contenedor-empresa-alumno">
                            <p class="empresa-alumno">Ase.Empresarial:
                                @if (!empty($procesoSeleccionado->aempresarial_procesos->aemp_pro))
                                {{$procesoSeleccionado->aempresarial_procesos->aemp_pro->Nombre}}
                            @else
                                Sin asesor
                            @endif </p>
                        </div>
                        <div class="contenedor-empresa-convenio-alumno">
                            <p class="empresa-convenio-alumno"> </p>
                        </div>
                        <div class="contenedor-ver-cedula-alumno">
                            <a class="ver-cedula" Target="_blank" href="{{ route('progresoDocumentacion', $procesoSeleccionado->IdProceso) }}" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="color:#3B96D1;">Ver Progreso Vinculación</a>
                        </div>
                    </div>
                </div>

        </div>
        {{-- ESTATUS e instrucciones de la calificacion --}}
        <div class="contenedor-informacion-cedula">
            <div class="contenedor-items-cedula">
                <p class="frase-definicion-proyecto">calificación final: @if (sizeof($procesoSeleccionado->calificaciones_proceso)==0)
                    N/A
                @else
                    {{$procesoSeleccionado->calificaciones_proceso[0]->cal_final}}
                @endif </p>
                <p class="estatus-definicion-proyecto">
                    @if (sizeof($procesoSeleccionado->calificaciones_proceso)==0)
                </p>ponderar una calificación al alumno de acuerdo a su desempeño en el periodo </p>
                <p>asignado, donde 50 es el mínimo y 100 el máximo de califiación </p>
                @else
                    calificaciones asignadas, en caso necesario cambiar las calificaciones 
                @endif
            </div>

        </div>

        {{--  seccion del avance documentacion   --}}
        <section class="contenedor-observaciones">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @if (sizeof($procesoSeleccionado->calificaciones_proceso)==0)

                <form method="POST" action="{{ route('guardarCalificacion',[ $procesoAlumno =  $procesoSeleccionado->IdProceso ])}}" class="contenedor-observaciones-generales">
                    @csrf
                            {{-- <input type="submit"  value="" class="boton-ingresar-calificacion" onclick="return confirmacion()"> --}}
                            <button type="submit" class="boton-ingresar-calificacion" onclick="return confirmacion()" style="padding-left: 50%; padding-right: 50%; padding-top:1%;">
                                Ingresar Calificación
                            </button>
                    <div class="contenedor-calificaciones">
                                <div class="primeras-calificaciones">
                                    <p class="titulo-actitud">actitud</p>
                                    <div class="contenido-primera-calificacion">

                                        
                                        <p class="aptitudes-1">aptitudes</p>
                                        <p class="calificacion-1">cal.</p>
                    
                                        <label for="asistencia-puntualidad" class="asistencia-puntualidad">Asistencia y Puntualidad</label>
                                        <input type="number" name="cal1" placeholder="N/A" class="cal1" size="3"  min="50" max="100" required >
                    
                                        <label for="respeto-normas-reglamentos" class="respeto-normas-reglamento">respeto a normas y reglamentos</label>
                                        <input type="number" name="cal2" placeholder="N/A" class="calificacion-02" size="3" min="50" max="100"  required >
                    
                    
                                        <label for="diciplina-tareas-asignadas" class="diciplina-tareas-asignadas">diciplina en tareas asignadas</label>
                                        <input type="number" name="cal3" placeholder="N/A" class="calificacion-03" size="3" min="50" max="100"  required >
                    
                                        
                                        <label for="capacidad-integracion-colaboracion" class="capacidad-integracion-colaboracion">capacidad de integración y colaboración</label>
                                        <input type="number" name="cal4" placeholder="N/A" class="califiacion-04" size="3" min="50" max="100"  required>
                    
                                        </div>
                                </div>
                
                
                
                        <div class="segundas-calificaciones">
                            <p class="titulo-desempenio">desempeño</p>
                            <div class="contenido-segunda-calificacion">

                                <p class="aptitudes-2">aptitudes</p>
                                <p class="calificacion-2">cal.</p>

                                <label for="cumplimiento-plan-trabajo" class="cumplimiento-plan-trabajo">cumplimiento del plan de trabajo</label>
                                <input type="number" name="cal5" placeholder="N/A" class="califiacion-05" size="3" min="50" max="100"  required>

                                <label for="interes-funcion-empresa" class="interes-funcion-empresa">interés por funciones de la empresa</label>
                                <input type="number" name="cal6" placeholder="N/A" class="calificacion-06" size="3" min="50" max="100"  required>


                                <label for="entrega-resultados-tareas-asignadas" class="entrega-resultados-tareas-asignadas">entrega resultados de tareas asignadas</label>
                                <input type="number" name="cal7" placeholder="N/A" class="calificacion-07" size="3"  min="50" max="100"  required>

                                
                                <label for="toma-decisiones-oportunas" class="toma-decisiones-oportunas">toma decisiones oportunas</label>
                                <input type="number" name="cal8" placeholder="N/A" class="califiacion-08" size="3"  min="50" max="100" required>

                                <label for="demuestra-seguridad-habilidad" class="demuestra-seguridad-habilidad">demuestra seguridad habilidad</label>
                                <input type="number" name="cal9" placeholder="N/A" class="califiacion-09" size="3" min="50" max="100" required>
                                
                                </div>
                        </div>



                        <div class="terceras-calificaciones">
                            <p class="titulo-producto">producto</p>
                            <div class="contenido-tercera-calificacion">
                                <p class="aptitudes-2">aptitudes</p>
                                <p class="calificacion-2">cal.</p>

                                <label for="redacción-ortografía-formato" class="redacción-ortografía-formato">redacción, ortografía y formato</label>
                                <input type="number" name="cal10" placeholder="N/A" class="califiacion-10" size="3"  min="50" max="100" required  >

                                <label for="cumplimiento-proyecto" class="cumplimiento-proyecto">cumplimiento del estatus-definicion-proyecto</label>
                                <input type="number" name="cal11" placeholder="N/A" class="califiacion-11" size="3"  min="50" max="100" required >

                                <label for="conclusiones-contribucion-tecnica" class="conclusiones-contribucion-tecnica">conclusiones y contribución técnica</label>
                                <input type="number" name="cal12" placeholder="N/A" class="califiacion-12" size="3"  min="50" max="100"  required>

                            </div>
                        </div>
                    </div>

                </form>
            @else
                <form action="" class="contenedor-observaciones-generales">
                            {{-- <input type="submit"  value=""  > --}}
                            <div class="boton-ingresar-calificacion">
                                <a href="{{ route('actualizarCalificacion',[$procesoAlumno  = $procesoSeleccionado->IdProceso , $identificacdorProceso =  $procesoSeleccionado->IdTipoProceso ])}}">
                                    Actualizar Calificación
                                </a>
                            </div>
                    <div class="contenedor-calificaciones">
                                <div class="primeras-calificaciones">
                                    <p class="titulo-actitud">actitud</p>
                                    <div class="contenido-primera-calificacion">

                                        
                                        <p class="aptitudes-1">aptitudes</p>
                                        <p class="calificacion-1">cal.</p>
                    
                                        <label for="asistencia-puntualidad" class="asistencia-puntualidad">cumplimiento del plan de trabajo</label>
                                        <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal1}}" class="calificacion-01" size="3"  min="0" max="100" readonly >
                    
                                        <label for="respeto-normas-reglamentos" class="respeto-normas-reglamento">respeto a normas y reglamentos</label>
                                        <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal2}}" class="calificacion-02" size="3" min="0" max="100"  readonly >
                    
                    
                                        <label for="diciplina-tareas-asignadas" class="diciplina-tareas-asignadas">diciplina en tareas asignadas</label>
                                        <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal3}}" class="calificacion-03" size="3" min="0" max="100"  readonly>
                    
                                        
                                        <label for="capacidad-integracion-colaboracion" class="capacidad-integracion-colaboracion">capacidad de integración y colaboración</label>
                                        <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal4}}" class="califiacion-04" size="3" min="0" max="100"  readonly>
                    
                                        </div>
                                </div>
                
                
                
                        <div class="segundas-calificaciones">
                            <p class="titulo-desempenio">desempeño</p>
                            <div class="contenido-segunda-calificacion">

                                <p class="aptitudes-2">aptitudes</p>
                                <p class="calificacion-2">cal.</p>

                                <label for="cumplimiento-plan-trabajo" class="cumplimiento-plan-trabajo">cumplimiento del plan de trabajo</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal5}}" class="califiacion-05" size="3" min="0" max="100"  readonly>

                                <label for="interes-funcion-empresa" class="interes-funcion-empresa">interés por funciones de la empresa</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal6}}" class="calificacion-06" size="3" min="0" max="100"  readonly>


                                <label for="entrega-resultados-tareas-asignadas" class="entrega-resultados-tareas-asignadas">entrega resultados de tareas asignadas</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal7}}" class="calificacion-07" size="3"  min="0" max="100"  readonly>

                                
                                <label for="toma-decisiones-oportunas" class="toma-decisiones-oportunas">toma decisiones oportunas</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal8}}" class="califiacion-08" size="3"  min="0" max="100" readonly>

                                <label for="demuestra-seguridad-habilidad" class="demuestra-seguridad-habilidad">demuestra seguridad habilidad</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal9}}" class="califiacion-09" size="3" min="0" max="100" readonly>
                                
                                </div>
                        </div>



                        <div class="terceras-calificaciones">
                            <p class="titulo-producto">producto</p>
                            <div class="contenido-tercera-calificacion">
                                <p class="aptitudes-2">aptitudes</p>
                                <p class="calificacion-2">cal.</p>

                                <label for="redacción-ortografía-formato" class="redacción-ortografía-formato">redacción, ortografía y formato</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal10}}" class="califiacion-10" size="3"  min="0" max="100" readonly>

                                <label for="cumplimiento-proyecto" class="cumplimiento-proyecto">cumplimiento del estatus-definicion-proyecto</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal11}}" class="califiacion-11" size="3"  min="1" max="100" readonly>


                                <label for="conclusiones-contribucion-tecnica" class="conclusiones-contribucion-tecnica">conclusiones y contribución técnica</label>
                                <input type="number" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal12}}" class="califiacion-12" size="3"  min="0" max="100"  readonly>

                            </div>
                        </div>
                    </div>

                </form>
            @endif


                       
        </section>
    </main>
</body>
</html>