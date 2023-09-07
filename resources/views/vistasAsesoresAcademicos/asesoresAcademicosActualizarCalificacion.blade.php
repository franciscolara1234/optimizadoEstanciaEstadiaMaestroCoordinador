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
            
                <h1 > <span class="nombre-pagina">Actualizar Calificación </span> </h1>

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
                            <p class="matricula-alumno">matrícula: {{$procesoSeleccionado->user_proceso->Matricula}}</p>
                        </div>
                        <div class="contenedor-carrera-alumno">
                            <p class="carrera-alumno">carre: {{$procesoSeleccionado->user_proceso->carrera_user->NombreCarrera}}</p>
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
                <p class="frase-definicion-proyecto">calificacion final: @if (sizeof($procesoSeleccionado->calificaciones_proceso)==0)
                    N/A
                @else
                    @if (($procesoSeleccionado->calificaciones_proceso[0]->TipoCalificaciones)==1)
                        {{$procesoSeleccionado->calificaciones_proceso[0]->cal_final}}
                    @else
                        {{$procesoSeleccionado->calificaciones_proceso[1]->cal_final}}
                    @endif
                @endif </p>
                <p class="estatus-definicion-proyecto">
                    @if (sizeof($procesoSeleccionado->calificaciones_proceso)==0)
                </p>ponderar una calificación al alumno de acuerdo a su desempeño en el periodo </p>
                <p>asignado, donde 50 es el minimo y 100 el maximo de califiación </p>
                @else
                    calificaciones asignadas, en caso necesario cambiar las calificaciones 
                @endif
            </div>

        </div>

        {{--  seccion del avance documentacion   --}}
        @error('cal1')
        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
            {{ $message }}</p>
        @enderror
        <section class="contenedor-observaciones">
            {{-- <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul> --}}

                <form method="POST" action="{{ route('guardarCalificacion',[ $procesoAlumno =  $procesoSeleccionado->IdProceso ])}}" class="contenedor-observaciones-generales">
                    @csrf
                            {{-- <input type="submit"  value="" class="boton-ingresar-calificacion" onclick="return confirmacion()"> --}}
                            <button type="submit" class="boton-ingresar-calificacion" onclick="return confirmacion()" style="padding-left: 50%; padding-right: 50%; padding-top:1%;">
                                Actualizar Calificación
                            </button>
                    <div class="contenedor-calificaciones">
                                <div class="primeras-calificaciones">
                                    <p class="titulo-actitud">actitud</p>
                                    <div class="contenido-primera-calificacion">

                                        
                                        <p class="aptitudes-1">aptitudes</p>
                                        <p class="calificacion-1">cal.</p>
                    
                                        <label class="asistencia-puntualidad">cumplimiento del plan de trabajo</label>
                                        <input type="number" name="cal1" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal1}}" class="cal1" size="3"  min="50" max="100" required >

                                        <label class="respeto-normas-reglamento">respeto a normas y reglamentos</label>
                                        <input type="number" name="cal2" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal2}}" class="calificacion-02" size="3" min="50" max="100"  required >
                    
                    
                                        <label class="diciplina-tareas-asignadas">diciplina en tareas asignadas</label>
                                        <input type="number" name="cal3" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal3}}" class="calificacion-03" size="3" min="50" max="100"  required >
                    
                                        
                                        <label class="capacidad-integracion-colaboracion">capacidad de integración y colaboración</label>
                                        <input type="number" name="cal4" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal4}}" class="califiacion-04" size="3" min="50" max="100"  required>
                    
                                        </div>
                                </div>
                
                
                
                        <div class="segundas-calificaciones">
                            <p class="titulo-desempenio">desempeño</p>
                            <div class="contenido-segunda-calificacion">

                                <p class="aptitudes-2">aptitudes</p>
                                <p class="calificacion-2">cal.</p>

                                <label class="cumplimiento-plan-trabajo">cumplimiento del plan de trabajo</label>
                                <input type="number" name="cal5" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal5}}" class="califiacion-05" size="3" min="50" max="100"  required>

                                <label class="interes-funcion-empresa">interés por funciones de la empresa</label>
                                <input type="number" name="cal6" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal6}}" class="calificacion-06" size="3" min="50" max="100"  required>


                                <label class="entrega-resultados-tareas-asignadas">entrega resultados de tareas asignadas</label>
                                <input type="number" name="cal7" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal7}}" class="calificacion-07" size="3"  min="50" max="100"  required>

                                
                                <label class="toma-decisiones-oportunas">toma decisiones oportunas</label>
                                <input type="number" name="cal8" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal8}}" class="califiacion-08" size="3"  min="50" max="100" required>

                                <label class="demuestra-seguridad-habilidad">demuestra seguridad habilidad</label>
                                <input type="number" name="cal9" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal9}}" class="califiacion-09" size="3" min="50" max="100" required>
                                
                                </div>
                        </div>



                        <div class="terceras-calificaciones">
                            <p class="titulo-producto">producto</p>
                            <div class="contenido-tercera-calificacion">
                                <p class="aptitudes-2">aptitudes</p>
                                <p class="calificacion-2">cal.</p>

                                <label class="redacción-ortografía-formato">redacción, ortografía y formato</label>
                                <input type="number" name="cal10" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal10}}" class="califiacion-10" size="3"  min="50" max="100" required  >

                                <label class="cumplimiento-proyecto">cumplimiento del estatus-definicion-proyecto</label>
                                <input type="number" name="cal11" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal11}}" class="califiacion-11" size="3"  min="50" max="100" required >

                                <label class="conclusiones-contribucion-tecnica">conclusiones y contribución técnica</label>
                                <input type="number" name="cal12" value="{{$procesoSeleccionado->calificaciones_proceso[0]->cal12}}" class="califiacion-12" size="3"  min="50" max="100"  required>

                            </div>
                        </div>
                    </div>

                </form>



                       
        </section>
    </main>
</body>
</html>