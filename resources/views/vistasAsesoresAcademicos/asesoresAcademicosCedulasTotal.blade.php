<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function aceptarDoc(){
            var respuesta=confirm('¿DESEA ACEPTAR EL DOCUMENTO SELECCIONADO? UNA VEZ ACEPTADO EL DOCUMENTO NO SE PODRÁ REVERTIR ESTA ACCIÓN');
            if(respuesta == true){
                // return true;
                aceptarDoc2();

            }else{
                return false;
            }
        }
        function aceptarDoc2(){
            var respuesta=confirm('¿ESTA SEGURO?');
            if(respuesta == true){
                return true;

            }else{
                return false;
            }
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css
    ">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <link href="/css/styleAsesorAcademico/asesoresAcademicosCedulasTotalStyle.css"rel="stylesheet" >
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
                <a href="">{{$tituloProceso}}</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">{{$tituloPagina}}</a>
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
            {{-- <form action="{{ route('mensajeAsesorAcademico.index')}}"  class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador">
            </form> --}}
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">{{$tituloPagina}} {{$tituloProceso}}
                    </span>
                </h1>

                <div class="contenedor-informacion-general-cedulas">

                    <div class="alumnos-total">
                        <p>alumnos:</p>
                        <p>{{$totalAlumnos}}</p>
                    </div>

                    <div class="cedulas-en-linea">
                        <p>Documentos en linea:</p>
                        <p>{{$totalDocumentosEnLinea}}</p>
                    </div>
                    <div class="cedulas-aprobadas">
                        <p>Documentos aprobadas:</p>
                        <p>{{$totalDocumentosApro}}</p>
                    </div>
                    <div class="cedulas-rechazadas">
                        <p>Documentos rechazadas:</p>
                        <p>{{$totalDocumentosRechazados}}</p>
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
                                   <th>estatus</th>
                                   <th>Documento</th>
                                   <th>Ver Documento</th>
                               </tr>
                           
                       </thead>
                       <tbody class="table-scroll">
                           @foreach ($documentosProcesosAsignados as $item)

                               <tr >
                                   <td>
                                    {{$item->proceso->user_proceso->Matricula}} 
                                    </td>
                                   <td>
                                       {{$item->proceso->user_proceso->alumno_perfil_user->Nombre}}                                     {{$item->proceso->user_proceso->alumno_perfil_user->APP}} 
                                       {{$item->proceso->user_proceso->alumno_perfil_user->APM}} 
                                   </td>
                                   <td>
                                        {{$item->proceso->tipo_procesos_proceso->nombreProceso}} 
                                    </td>
                                   <td>
                                        {{$item->proceso->user_proceso->carrera_user->NombreCarrera}}
                                    </td>
                                   <td>
                                        @foreach ($item->proceso->detalle_doc_proceso as $item2)

                                            @if ($item2->documentos_detallesDoc->IdTipoDoc == $identificadorDocumento)

                                                @switch($item2->documentos_detallesDoc->estadoAca)
                                                @case(1)
                                                    <button class="form-control btn btn-light btn-lg" disabled data-bs-toggle="button"  style="background-color:#4FB420" >
                                                    ACEPTADO</button>

                                                    @break
                                                @case(NULL)
                                                    <button class="form-control btn btn-light btn-lg" disabled data-bs-toggle="button"  style="background-color:#FEEED2" >
                                                    PENDIENTE</button>
                                                    @break
                                                @case(2)
                                                    <button class="form-control btn btn-light btn-lg" disabled data-bs-toggle="button"  style="background-color:#F18989" >
                                                    OBSERVACIONES</button>

                                                    @break
                                                @default
                                                <input type="text" class="input-group-text form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="NO HAY INTENTO" readonly>
                                                @break
                                                @endswitch  
                                            @endif
                                        @endforeach




                                    </td>

                                    <td>

                                    @foreach ($item->proceso->detalle_doc_proceso as $item2)
                                            @if ($item2->documentos_detallesDoc->IdTipoDoc == $identificadorDocumento)
                                                <input type="text" class="input-group-text form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{$item2->documentos_detallesDoc->ruta}}" readonly>
                                       

                                                <form method="POST" action="{{ route('cambiarEstadoDoc',[ $idDoc=$item2->documentos_detallesDoc->IdDoc, $idProceso=$item->proceso->IdTipoProceso])}}" class="formulario-aviso d-flex" id="formulario-aviso" style="padding-left: 0%; padding-right: 0%; padding-top:1%;">

                                                    @method('PATCH')
                                                    @csrf
                                                    
                                                        @switch($item2->documentos_detallesDoc->estadoAca)
                                                            @case(null)
                                                                <button onclick="return aceptarDoc()" type="submit" id="estadoDeseado" value=1
                                                                name="estadoDeseado"
                                                                class="aceptar btn btn-outline-success">Aceptar Documento</button><br>

                                                                <button type="submit" id="estadoDeseado" value=2
                                                                name="estadoDeseado" class="btn btn-outline-danger">
                                                                <i class="observaciones zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                
                                                                @if (!empty($item2->documentos_detallesDoc->comentarios_documentos[0]->Comentario))
                                                                    Observaciones Anteriores       
                                                                @else
                                                                Añadir Observaciones
                                                                @endif
                                                            </button>
                                                                @break
                                                            @case(1)
                                                                <button type="submit" id="estadoDeseado" value=2
                                                                name="estadoDeseado" class="btn btn btn-outline-success btn-lg" disabled data-bs-toggle="button" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                                                <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                Documento Aceptado</button>
                                                                @break
                                                            @case(2)
                                                                <button type="submit" id="estadoDeseado" value=2
                                                                name="estadoDeseado" class="btn btn-outline-danger">
                                                                <i class="boton-seleccionado zmdi zmdi-alert-circle zmdi-hc-lg"></i>Ver Observaciones
                                                                </button>
                                                                @break
                                                            @default

                                                        @endswitch
                                                </form>
                                            @endif
                                    @endforeach

                                    </td>
                                    <td>
                                        @foreach ($item->proceso->detalle_doc_proceso as $item2)
                                                @if ($item2->documentos_detallesDoc->IdTipoDoc == $identificadorDocumento)
                                                    @php
                                                        $documentoVacio1 = false;
                                                    @endphp
                                                    <div class="justify-content-center">


                                                        <a style="color:#3B96D1" href="{{ route('ver_documentoAcademico', [$item2->documentos_detallesDoc->ruta, $item2->documentos_detallesDoc->IdTipoDoc])}}"  target="_blank" class="ver-cedula">ver documento</a>
                                                        {{-- <form   target="_blank"  action="{{ route('ver_documentoAcademico', [$item2->documentos_detallesDoc->ruta, $item2->documentos_detallesDoc->IdTipoDoc])}}" class="d-flex"
                                                        style="padding-left: 20%; padding-right: 20%; padding-top:1%;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-outline-secondary" style="padding-left: 50%; padding-right: 50%; padding-top:1%;"> <i class="zmdi zmdi-eye zmdi-hc-lg">
                                                                </i>
                                                                    Ver
                                                                </button>
                                                        </form> --}}
                                                    </div>
                                                @endif

                                        @endforeach
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

</body>
</html>