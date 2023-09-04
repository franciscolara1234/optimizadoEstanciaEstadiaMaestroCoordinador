<!DOCTYPE html>
<html lang="en">

<head>
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

    <title>Empresas registradas</title>
</head>

<body>
    @include('plantilla/alumno/head')
    @include('plantilla/alumno/navBar')
    <section class="full-box dashboard-contentPage" style="margin: 5%">
        <!-- Notificaciones -->
        @include('notificaciones/notificaciones')
        @include('sweetalert::alert')
        <!-- Content page -->
        <div class="row align-items-center justify-content-center">
            <h3 class="text-titles text-justify text-center">Empresas<small>(Registradas)</small> </h3>
        </div>

        <div class="table-responsive">

            <table class="table table-striped" id="empresas">
                <thead>
                    <tr style="background: rgb(217, 214, 214)">
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>RFC</th>
                        <th>Giro</th>
                        <th>URLEmpresa</th>
                        <th>TipoEmpresa</th>
                        <th>TamañoEmpresa</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresa as $Edatos)
                        <tr>
                            <td>{{ $Edatos->Nombre }}</td>
                            <td>{{ $Edatos->Direccion }}</td>
                            <td>{{ $Edatos->Correo }}</td>
                            <td>{{ $Edatos->Telefono }}</td>
                            <td>{{ $Edatos->RFC }}</td>
                            <td>{{ $Edatos->Giro }}</td>
                            <td><a href="{{ $Edatos->URLemp }}">{{ $Edatos->URLemp }}</a></td>
                            {{-- <td>{{ $Edatos->URLemp }}</td> --}}
                            <td>{{ $Edatos->Tipo_Empresa }}</td>
                            <td>{{ $Edatos->Tipo_Tamaño }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>


    <section>

    </section>

</body>
<script>
    $(document).ready(function() {
        $('#empresas').DataTable({
            dom: "Bfrtip",
            buttons: {
                dom: {
                    button: {
                        className: 'btn'
                    }
                },
                buttons: [{
                        extend: "excel",
                        text: 'Exportar a Excel',
                        className: 'btn btn-outline-success',
                        excelStyles: {
                            template: 'header-blue'
                        },
                        exportOptions: {
                            columns: function(column, data, node) {
                                if (column > 3) {
                                    return false;
                                }
                                return true;
                            }
                        }
                    },
                    {
                        extend: "pdf",
                        text: 'Exportar a PDF',
                        className: 'btn btn-outline-danger',
                        excelStyles: {
                            template: 'header-blue'
                        },
                        exportOptions: {
                            columns: function(column, data, node) {
                                if (column > 3) {
                                    return false;
                                }
                                return true;
                            }
                        }
                    }
                ]
            }
        });
    });
</script>

</html>
