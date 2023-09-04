<!DOCTYPE html>
<html lang="en">

<head>
    <!---- css ---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    @include('plantilla/admin/head')

    <!--  css botones datatable  -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css" />

    <!---- script ---->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

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
    </header>
    <section class="full-box dashboard-contentPage" style="margin: 5%">
        @include('notificaciones/notificaciones')
        @include('sweetalert::alert')
        <div class="row align-items-center justify-content-center">
            <h2 class="text-titles text-justify text-center">Creacion De Periodos</h2>
        </div>
        <div class="row">
            <div class="col-md-3">
                @csrf
                <form action="{{ route('adminPeriodoCrear.index') }}">
                    <div class="py-5">
                        <button class="btn btn-warning " type="submit">Crear Periodo Actual</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table id='periodo' class="table table-striped table-hover">
                <thead>
                    <tr class="table-warning">
                        <td>Periodo</td>
                        <td>Fase 1</td>
                        <td>Fase Activa 1</td>
                        <td class="text-center">Acciones</td>
                        <td>Fase 2</td>
                        <td>Fase Activa 2</td>
                        <td class="text-center">Acciones</td>
                        <td>Fase 3</td>
                        <td>Fase Activa 3</td>
                        <td class="text-center">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periodos as $periodo)
                        <tr>
                            <td>{{ $periodo->Periodo }}</td>
                            <td>{{ $periodo->Idfase_1 }}</td>
                            <td>{{ $periodo->Activo_1 }}</td>
                            <td class="text-center">
                                @if ($periodo->Activo_1 == 1)
                                    @csrf
                                    <form action="{{route('adminActivarFase.index',[$periodo->IdPeriodo,1])}}">
                                        <button type="submit" class="btn btn-warning "> Desactivar <i
                                                class="zmdi zmdi-edit"></i></button>
                                    </form>
                                @else
                                    @csrf
                                    <form action="{{route('adminActivarFase.index',[$periodo->IdPeriodo,1])}}">
                                        <button type="submit" class="btn btn-warning "> Activar <i
                                                class="zmdi zmdi-edit"></i></button>
                                    </form>
                                @endif
                            </td>
                            <td>{{ $periodo->Idfase_2 }}</td>
                            <td>{{ $periodo->Activo_2 }}</td>
                            <td class="text-center">
                                @if ($periodo->Activo_2 == 1)
                                    @csrf
                                    <form action="{{route('adminActivarFase.index',[$periodo->IdPeriodo,2])}}">
                                        <button type="submit" class="btn btn-warning "> Desactivar <i
                                                class="zmdi zmdi-edit"></i></button>
                                    </form>
                                @else
                                    @csrf
                                    <form action="{{route('adminActivarFase.index',[$periodo->IdPeriodo,2])}}">
                                        <button type="submit" class="btn btn-warning "> Activar <i
                                                class="zmdi zmdi-edit"></i></button>
                                    </form>
                                @endif
                            </td>
                            <td>{{ $periodo->Idfase_3 }}</td>
                            <td>{{ $periodo->Activo_3 }}</td>
                            <td class="text-center">
                                @if ($periodo->Activo_3 == 1)
                                    @csrf
                                    <form action="{{route('adminActivarFase.index',[$periodo->IdPeriodo,3])}}">
                                        <button type="submit" class="btn btn-warning "> Desactivar <i
                                                class="zmdi zmdi-edit"></i></button>
                                    </form>
                                @else
                                    @csrf
                                    <form action="{{route('adminActivarFase.index',[$periodo->IdPeriodo,3])}}">
                                        <button type="submit" class="btn btn-warning "> Activar <i
                                                class="zmdi zmdi-edit"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <footer>

    </footer>
</body>
<script>
    $(document).ready(function() {
        $('#periodo').DataTable({
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
