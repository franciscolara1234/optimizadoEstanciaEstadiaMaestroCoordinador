<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('plantilla/admin/head')
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
        @include('plantilla/admin/navBar')
        @include('sweetalert::alert')
        @include('notificaciones/notificaciones')
    </header>
    <section class="full-box dashboard-contentPage">
        <div class="container p-3">
            <h2 class="text-center">Busqueda<small>({{ $proceso[1] }})</small></h2>
            @foreach ($documentacion as $user)
             <h2 class="text-center">{{$user->name}}</h2>                
            @endforeach
        </div>
        <div class="table-responsive" style="padding: 2%;">
            <table id="usuarios" class="table table-striped">
                <thead>
                    <tr>
                        <th style="display: none">Identificador</th>
                        <th class="text-center">Documento</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Accion</th>
                        <th class="text-center">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos as $documento)
                        <tr>
                            <td style="display: none">{{ $documento->IdTipoDoc }}</td>
                            <td>{{ $documento->nombredoc }}</td>
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
                                                    <i class="zmdi zmdi-folder-person">
                                                        Observaciones</i>
                                                </button>
                                            @break

                                            @default
                                        @endswitch
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                @if (count($documentacion->where('IdTipoDoc', $documento->IdTipoDoc)) == 0)
                              
                                @endif
                                @foreach ($documentacion as $doc)
                                    @if ($doc->IdTipoDoc == $documento->IdTipoDoc)
                                        @if ($doc->ruta == null)
                                        @else
                                            @switch($doc->IdTipoDoc )
                                                @case(6)

                                                        @if ($doc->estadoAca==1)
                                                                <input type="text" value="{{ $doc->ruta }}" class="nombreDoc"
                                                                id="nombreDoc" name="nombreDoc" readonly>
                                                            <form
                                                                action="{{ route('Cambiar_documento_Estado.index', [$doc->IdDoc, $idSeleccionado=$proceso[0]]) }}"
                                                                class="d-flex"
                                                                style="padding-left: 20%; padding-right: 20%; padding-top:1%;">
                                                                {{-- @dump($proceso[0]) --}}
                                                                @csrf
                                                                @if ($doc->IdEstado == 1)
                                                                    <button type="submit" id="estadoDeseado" value=2
                                                                        name="estadoDeseado"
                                                                        class="btn btn-warning btnPendiente">Pendiente</button>
                                                                    <button type="submit" id="estadoDeseado" value=3
                                                                        name="estadoDeseado" class="btn btn-danger btnObservaciones">
                                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                        Observaciones</button>
                                                                @elseif ($doc->IdEstado == 2)
                                                                    <button type="submit" id="estadoDeseado" value=1
                                                                        name="estadoDeseado" class="btn btn-success btnAceptar"> <i
                                                                            class="zmdi zmdi-check zmdi-hc-lg"></i>
                                                                        Aceptar</button>
                                                                    <button type="submit" id="estadoDeseado" value=3
                                                                        name="estadoDeseado" class="btn btn-danger btnObservaciones">
                                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                        Observaciones</button>
                                                                @elseif ($doc->IdEstado == 3)
                                                                    <button type="submit" class="btn btn-danger btnObservaciones"
                                                                        id="estadoDeseado" name="estadoDeseado" value=3>
                                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                        Observaciones</button>
                                                                @endif
                                                            </form>
                                                        @endif

                                                    @break
                                                @case(7)
                                                                @if ($doc->estadoAca==1)
                                                                <input type="text" value="{{ $doc->ruta }}" class="nombreDoc"
                                                                id="nombreDoc" name="nombreDoc" readonly>
                                                            <form
                                                                action="{{ route('Cambiar_documento_Estado.index', [$doc->IdDoc, $idSeleccionado=$proceso[0]]) }}"
                                                                class="d-flex"
                                                                style="padding-left: 20%; padding-right: 20%; padding-top:1%;">
                                                                {{-- @dump($proceso[0]) --}}
                                                                @csrf
                                                                @if ($doc->IdEstado == 1)
                                                                    <button type="submit" id="estadoDeseado" value=2
                                                                        name="estadoDeseado"
                                                                        class="btn btn-warning btnPendiente">Pendiente</button>
                                                                    <button type="submit" id="estadoDeseado" value=3
                                                                        name="estadoDeseado" class="btn btn-danger btnObservaciones">
                                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                        Observaciones</button>
                                                                @elseif ($doc->IdEstado == 2)
                                                                    <button type="submit" id="estadoDeseado" value=1
                                                                        name="estadoDeseado" class="btn btn-success btnAceptar"> <i
                                                                            class="zmdi zmdi-check zmdi-hc-lg"></i>
                                                                        Aceptar</button>
                                                                    <button type="submit" id="estadoDeseado" value=3
                                                                        name="estadoDeseado" class="btn btn-danger btnObservaciones">
                                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                        Observaciones</button>
                                                                @elseif ($doc->IdEstado == 3)
                                                                    <button type="submit" class="btn btn-danger btnObservaciones"
                                                                        id="estadoDeseado" name="estadoDeseado" value=3>
                                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                                        Observaciones</button>
                                                                @endif
                                                            </form>
                                                        @endif
                                                    @break
                                                @default
                                                <input type="text" value="{{ $doc->ruta }}" class="nombreDoc"
                                                id="nombreDoc" name="nombreDoc" readonly>
                                            <form
                                                action="{{ route('Cambiar_documento_Estado.index', [$doc->IdDoc, $idSeleccionado=$proceso[0]]) }}"
                                                class="d-flex"
                                                style="padding-left: 20%; padding-right: 20%; padding-top:1%;">
                                                {{-- @dump($proceso[0]) --}}
                                                @csrf
                                                @if ($doc->IdEstado == 1)
                                                    <button type="submit" id="estadoDeseado" value=2
                                                        name="estadoDeseado"
                                                        class="btn btn-warning btnPendiente">Pendiente</button>
                                                    <button type="submit" id="estadoDeseado" value=3
                                                        name="estadoDeseado" class="btn btn-danger btnObservaciones">
                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                        Observaciones</button>
                                                @elseif ($doc->IdEstado == 2)
                                                    <button type="submit" id="estadoDeseado" value=1
                                                        name="estadoDeseado" class="btn btn-success btnAceptar"> <i
                                                            class="zmdi zmdi-check zmdi-hc-lg"></i>
                                                        Aceptar</button>
                                                    <button type="submit" id="estadoDeseado" value=3
                                                        name="estadoDeseado" class="btn btn-danger btnObservaciones">
                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                        Observaciones</button>
                                                @elseif ($doc->IdEstado == 3)
                                                    <button type="submit" class="btn btn-danger btnObservaciones"
                                                        id="estadoDeseado" name="estadoDeseado" value=3>
                                                        <i class="zmdi zmdi-alert-circle zmdi-hc-lg"></i>
                                                        Observaciones</button>
                                                @endif
                                            </form>
                                            @endswitch

                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="justify-content-center">
                                    @foreach ($documentacion as $doc)
                                        @if ($doc->IdTipoDoc == $documento->IdTipoDoc)
                                            @if ($doc->ruta == null)
                                            @else
                                                <form method="post"
                                                    action="{{ route('ver_documento.index', [$doc->ruta, $proceso[0]]) }}">
                                             
                                                    @csrf
                                                    <button type="submit" class="btn btnVer"> <i class="zmdi zmdi-eye zmdi-hc-lg">
                                                        </i>
                                                        Ver
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <footer></footer>
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
