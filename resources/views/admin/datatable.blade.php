<!DOCTYPE html5>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    <title>Usuarios tabla registrados</title>
</head>

<body>
    <!-- NavBar -->
    @include('plantilla/admin/navBar')
    <section class="full-box dashboard-contentPage" style="margin: 5%">
        <!-- Notificaciones -->
        @include('notificaciones/notificaciones')
        @include('sweetalert::alert')
        <!-- Content page -->
        <div class="row align-items-center justify-content-center">
            <h2 class="text-titles text-justify text-center">Usuarios<small>(Registrados)</small> </h2>
        </div>
        <div class="row">
            <div class="col-md-3">
                <form action="{{ route('agregar_usuario.index') }}" method="GET">
                    @csrf
                    <button type="submit" value="Agregar usuario" class="btn btn-info"> <i
                            class="zmdi zmdi-account-add"></i> Agregar usuario</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table id="usuarios" class="table table-striped">
                <thead>
                    <tr style="background: rgb(217, 214, 214)">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Matricula</th>
                        <th>Rol</th>
                        <th>Correo</th>
                        <th>Editar</th>
                        {{-- <th>Eliminar</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->Nombre }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->NombreTipo }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('ver_datos_usuario.index', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btnEliminarUser"> editar <i
                                            class="zmdi zmdi-edit"></i></button>
                                </form>
                            </td>
                            {{-- <td>
                                <form action="{{ route('eliminarUsuario.index', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btnEliminarUser">Eliminar</button>
                                </form>
                            </td> --}}
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
