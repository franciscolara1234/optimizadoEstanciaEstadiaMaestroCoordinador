<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subida De Documentos</title>
    @include('plantilla/alumno/head')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <!--  css botones datatable  -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css" />
    <!-- script buttons datatable-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>

</head>

<body>
    <header>
        @include('plantilla/alumno/navBar')
        @include('sweetalert::alert')
        @include('notificaciones/notificaciones')
    </header>
    <section class="full-box dashboard-contentPage">
        <div class="container p-3">
            <div class="page-header">
                <h2 class="text-center">Documentos<small>({{ $proceso[1] }})</small></h2>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                @csrf
                <form action="{{ route('CrearProcesoAlumno.index', [auth()->user()->id, $proceso[0]]) }}">
                    <div class="py-5">
                        <button class="btn btn-warning " type="submit">Darse De Alta En Periodo</button>
                        <div class="row mt-3" style="padding: 1%">
                            <div class="form-group col">
                                <label class="form-label" for="asesorempresarial">Asesor Empresarial</label>                                
                                <input class="form-control" type="text" name="asesorempresarial" id="asesorempresarial" placeholder="Nombre Completo Asesor Empresarial">
                            </div>
                            <div class="form-group col">
                                <label class="form-label" for="empresa">Asesor Empresarial</label>
                                <select class="form-control" name="empresa" id="empresa">
                                    <option value="">Seleccionar un dato</option>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->IdEmp }}">
                                            {{ $empresa->Nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label class="form-label" for="asesoracademico">Asesor Academico</label>
                                <select class="form-control" name="asesoracademico" id="asesoracademico">
                                    <option value="">Seleccionar un dato</option>
                                    @foreach ($AulaDisponibleCarera as $academico)
                                        <option value="{{ $academico->user_aula_academico->aa_academico_user->IdAsesor }}">
                                            {{ $academico->user_aula_academico->aa_academico_user->APP . ' ' . $academico->user_aula_academico->aa_academico_user->APM . ' ' . $academico->user_aula_academico->aa_academico_user->Nombre }}
                                        </option>
                                    @endforeach
                                    {{-- @foreach ($aa as $academico)
                                        <option value="{{ $academico->IdAsesor }}">
                                            {{ $academico->APP . ' ' . $academico->APM . ' ' . $academico->Nombre }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive" style="padding: 2%">
            <table id="usuarios" class="table table-striped">
                <thead>
                    <tr>
                        <th style="display: none">Id Documento</th>
                        <th>Documento</th>
                        <th>Formato</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos->when($proceso[0] != 5, function ($query) {
            return $query->take(8);
        })->skip(3) as $documento)
                        <tr>
                            <td style="display: none">{{ $documento->IdTipoDoc }}</td>
                            <td>{{ $documento->nombredoc }}</td>
                            <td>
                                <a href="{{ route('DescargarFormatoDocumento.index', $documento->IdTipoDoc) }}">
                                    <button class="btn btn-outline-info btnDescargar">Descargar</button>
                                </a>
                            </td>
                            <td>
                                @foreach ($documentacion as $doc)
                                    @if ($doc->IdTipoDoc == $documento->IdTipoDoc)
                                        @switch($doc->IdEstado)
                                            @case(1)
                                                <button class="btn btn-success">
                                                    <i class="zmdi zmdi-check-circle-u">Aceptado</i>
                                                </button>
                                            @break

                                            @case(2)
                                                <button class="btn btn-warning">
                                                    <i class="zmdi zmdi-folder-person">Pendiente</i>
                                                </button>
                                            @break

                                            @case(3)
                                                <button class="btn btn-outline-danger">
                                                    <i class="zmdi zmdi-folder-person"> Observaciones</i>
                                                </button>
                                            @break

                                            @default
                                        @endswitch
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if (count($documentacion->where('IdTipoDoc', $documento->IdTipoDoc)) == 0)
                                    <form
                                        action="{{ route('subir_doc_alumno.index', [auth()->user()->name, $proceso[0], $documento->IdTipoDoc, $documento->IdTipoDoc]) }}"
                                        method="post" enctype="multipart/form-data">
                                        <span class="btn fileinput-button">
                                            @csrf
                                            <i class="zmdi zmdi-file"></i>
                                            <input type="file" class="archivo" name="docs_archivo">
                                        </span>
                                        @if ($periodoActual != null)
                                            @if (($documento->IdTipoDoc == 4 || $documento->IdTipoDoc == 5) && $periodoActual->Activo_1 == 1)
                                                <button type="submit"
                                                    class="btn btn-outline-info btnSubir">Enviar</button>
                                            @endif
                                            @if (($documento->IdTipoDoc == 6 || $documento->IdTipoDoc == 7) && $periodoActual->Activo_2 == 1)
                                                <button type="submit"
                                                    class="btn btn-outline-info btnSubir">Enviar</button>
                                            @endif
                                            @if (($documento->IdTipoDoc == 8) && $periodoActual->Activo_3 == 1)
                                                <button type="submit"
                                                    class="btn btn-outline-info btnSubir">Enviar</button>
                                            @endif
                                        @endif
                                    </form>
                                @endif
                                @foreach ($documentacion as $doc)
                                    @if ($doc->IdTipoDoc == $documento->IdTipoDoc)
                                        @if ($doc->ruta == null)
                                        @else
                                            <form
                                                action="{{ route('cancelar_doc.index', [$proceso[0], $doc->IdDoc]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" value="{{ $doc->ruta }}" class="nombreDoc"
                                                    id="nombreDoc" name="nombreDoc" readonly>
                                                @if ($doc->IdEstado == 1)
                                                @else
                                                    @switch($doc->IdTipoDoc)
                                                        @case(6)
                                                        
                                                        @if($doc->IdEstado==2 && $doc->estadoAca==NULL || $doc->IdEstado==2 && $doc->estadoAca==1  )
                                                        
                                                        <a href="{{ route('observacion_documento_ver.index',[ $doc->IdDoc, $tipoProcesoSeleccionado]) }}">cambiar documentacion</a>    
                                                        @endif

                                                            @break
                                                        @case(7)


                                                                         
                                                        @if($doc->IdEstado==2 && $doc->estadoAca==NULL || $doc->IdEstado==2 && $doc->estadoAca==1  )
                                                        
                                                        <a href="{{ route('observacion_documento_ver.index',[ $doc->IdDoc, $tipoProcesoSeleccionado]) }}">cambiar documentacion</a>    
                                                        @endif

                                                            @break
                                                        @default

                                                        <button type="submit" class="btn btn-outline-danger btnCancelar">
                                                            Cancelar
                                                        </button>

                                                    @endswitch
                                                @endif
                                            </form>
                                            @if ($doc->estadoAca == 2 || $doc->IdEstado==3)
                                                <form
                                                    action="{{ route('observacion_documento_ver.index',[ $doc->IdDoc, $tipoProcesoSeleccionado]) }}"
                                                    class="d-flex"
                                                    style="padding-left: 20%; padding-right: 20%; padding-top:1%;">
                                                    <button type="submit"
                                                        class="btn btn-danger btnObservaciones">Observacion</button>
                                                </form>
                                            @endif
                                  
                                        @endif

                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</body>
<script>
    $(document).ready(function() {
        $('#usuarios').DataTable({
            dom: "Bfrtip",
            buttons: {
                dom: {
                    button: {
                        className: 'btn'
                    }
                },
                buttons: []
            }
        });
    });
</script>

</html>
