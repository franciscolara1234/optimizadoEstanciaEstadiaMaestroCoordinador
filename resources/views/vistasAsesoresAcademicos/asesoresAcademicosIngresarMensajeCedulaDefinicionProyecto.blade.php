<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styleAsesorAcademico/asesoresAcademicosCedulaDefinicionProyectoStyle.css"rel="stylesheet" >
    <title>UPQROO</title>
    <script>
        function confirmacion(){
            var respuesta=confirm('¿DESEA INGRESAR LAS OBSERVACIONES Y RECHAZAR EL DOCUMENTO? UNA VEZ RECHAZADO NO SE PODRÁ CAMBIAR ESTA ACCIÓN HASTA QUE EL ESTUDIANTE REALICÉ LOS CAMBIOS');
            if(respuesta == true){
                confrimacion2();
            }else{
                return false;
            }
        }
        function confirmacion2(){
            var respuesta=confirm('¿Seguro?');
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
                <a href="">{{$tituloProceso}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">{{$tituloPagina}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">{{$alumno->Matricula}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        
        <div class="buscador-matricula">

        </div>
            {{-- <form action="{{ route('mensajeAsesorAcademico.index')}}" class="buscador-matricula">

                {{-- <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador"> --}}
            {{-- </form> --}} 
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">{{$tituloPagina}} {{$tituloProceso}}</span> </h1>

                <div class="contenedor-informacion-alumno">
                    <div class="contenedor-items-alumno">
                        <div class="contenedor-asignatura-alumno">
                            <div class="imagen-proceso-asignatura">
                                <img class="imagen-proceso" src="/icons/usuario-ESTADIAs.png" alt="">
                            </div>
                                <p class="nombre-proceso-asignatura">{{$tituloPagina}}</p>
                            <div>

                            </div>
                        </div>
                        <div class="contenedor-nombre-alumno">
                            <p class="nombre-alumno">Nombre:     
                                {{$alumno->alumno_perfil_user->Nombre}} {{$alumno->alumno_perfil_user->APP}} {{$alumno->alumno_perfil_user->APM}}</p>
                        </div>
                        <div class="contenedor-matricula-alumno">
                            <p class="matricula-alumno">matrícula:  {{$alumno->Matricula}}</p>
                        </div>
                        <div class="contenedor-carrera-alumno">
                            <p class="carrera-alumno">carrera: {{$alumno->carrera_user->NombreCarrera}}</p>
                        </div>
                        <div class="contenedor-empresa-alumno">
                            <p class="empresa-alumno">
                                {{-- Ase.Empresarial:
                                @if (!empty($alumno->aempresarial_procesos->aemp_pro))
                                {{$alumno->aempresarial_procesos->aemp_pro->Nombre}}
                            @else
                                Sin asesor
                            @endif  --}}
                        </p>
                        </div>
                        <div class="contenedor-empresa-convenio-alumno">
                            <p class="empresa-convenio-alumno">
                                {{-- convenio: --}}

                            </p>
                        </div>
                        <div class="contenedor-ver-cedula-alumno link-info">
                            {{-- "{{ route('ver_documentoAcademico', [$item2->documentos_detallesDoc->ruta, $item2->documentos_detallesDoc->IdTipoDoc])}}" --}}
                            <a style="color:#3B96D1" href="{{ route('ver_documentoAcademico', [$documento->ruta, $documento->IdTipoDoc])}}"  target="_blank" class="ver-cedula">ver documento</a>
                        </div>
                    </div>
                </div>

        </div>
        {{-- ESTATUS DE LA CEDULA --}}
        <div class="contenedor-informacion-cedula">
            <div class="contenedor-items-cedula">
                <p class="frase-definicion-proyecto">estatus documento:</p>
                <p class="estatus-definicion-proyecto">{{$estatusDocumento}}</p>
            </div>

        </div>

        {{--  seccion del avance documentacion   --}}
        <section class="contenedor-observaciones">
            <h2 class="titulo-observaciones"><span >observaciones</span></h2>
            {{-- method="post" target="_blank"  --}}

            @if ($documento->estadoAca == 2)
            <form class="contenedor-observaciones-generales">
                @csrf
                <div class="observaciones-academico" observaciob>
                    <label for="asesor-academico" class="remitente-academico">asesor académico</label>

                    <textarea class="mensaje-observaciones-academico" name="Comentario"  minlength="20" maxlength="1000" readonly>@if ($documento->comentarios_documentos[0]->TipoComentario==1){{$documento->comentarios_documentos[0]->Comentario}}@else{{$documento->comentarios_documentos[1]->Comentario}}@endif</textarea>

                </div>
                {{-- <div class="observaciones-coordinador">
                    <label for="coordinador-coordiandor" class="remitente-coordinador">coordinador carrera</label>
                    <textarea class="mensaje-observaciones-coordinador" name="observaciones-coordinador-carrera" placeholder="observaciones" minlength="20" maxlength="1000" readonly="readonly"></textarea>
                </div> --}}


                {{-- <input type="submit"  value="aprobar cedula" class="boton-aprobar-cedula" disabled> --}}

                {{-- <input type="submit"  value="guardar observaciones" class="boton-rechazar-cedula" onclick="return= confirmacion()">         --}}
                {{-- <button type="submit" class="boton-rechazar-cedula" value=2>

                    GUARDAR OBSERVACIONES
                </button> --}}

            </form>
            @else
                

             <form method="POST" action="{{ route('guardarMensaje', [$documento->IdDoc, $idProceso])}}" class="contenedor-observaciones-generales">
                {{-- @method("PATCH") --}}
                @csrf
                <div class="observaciones-academico" observaciob>
                    <label for="asesor-academico" class="remitente-academico">asesor académico</label>

                    {{-- @if ($documento->comentarios_documentos[0]->TipoComentario==1){{$documento->comentarios_documentos[0]->Comentario}}
                        
                    @endif --}}
                    <textarea class="mensaje-observaciones-academico" name="Comentario" placeholder="observaciones" minlength="20" maxlength="1000">@if (!empty($documento->comentarios_documentos[0]->Comentario))Comentarios anteriores
{{$documento->comentarios_documentos[0]->Comentario}}@else @endif 
                        
                    </textarea>

                </div>
                {{-- <div class="observaciones-coordinador">
                    <label for="coordinador-coordiandor" class="remitente-coordinador">coordinador carrera</label>
                    <textarea class="mensaje-observaciones-coordinador" name="observaciones-coordinador-carrera" placeholder="observaciones" minlength="20" maxlength="1000" readonly="readonly"></textarea>
                </div> --}}


                {{-- <input type="submit"  value="aprobar cedula" class="boton-aprobar-cedula" disabled> --}}

                {{-- <input type="submit"  value="guardar observaciones" class="boton-rechazar-cedula" onclick="return= confirmacion()">         --}}
                <button onclick="return confirmacion()" type="submit" name="estadoDeseado" class="boton-rechazar-cedula" value=2>
                    GUARDAR OBSERVACIONES
                </button>

            </form>
            @endif
   
        </section>
    </main>
</body>
</html>