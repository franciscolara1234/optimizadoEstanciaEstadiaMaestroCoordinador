<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('plantilla/admin/head')
    <link rel="stylesheet" type="text/css" href="/css/estilos.css">
</head>
<body>
    <header>

    </header>
    <section class="full-box dashboard-contentPage">
        @include('plantilla/admin/navBar')
        @include('sweetalert::alert')
        @include('notificaciones/notificaciones')
        <div class="page-header">
            <div class="text-center pt-4 pb-3"><h2>Registro de Asesores</h2></div>
        </div>
        <div class="container">
            <div class="row">
                <form action="{{ route('asesores_subir.index')}}" class="form-group" style="padding-top: 1%" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="csv_aa" style="padding-top: 1%; padding-bottom:1%">Subir Archivo CSV para Asesores Academicos</label>
                    <input type="file" name="csv_aa" id="csv_aa" class="form-control">
                    <button type="submit" class="btn btn-dark">Subir</button>
                </form>
                <form action="{{ route('asesores_subir_E.index')}}" class="form-group"  style="padding-top:1%" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="csv_ae" style="padding-top: 1%; padding-bottom:1%">Subir Archivo CSV para Empresas</label>
                    <input type="file" name="csv_ae" id="csv_ae" class="form-control">
                    <button type="submit" class="btn btn-dark">Subir</button>
                </form>
            </div>
        </div>
    </section>
    <footer>

    </footer>
</body>
</html>