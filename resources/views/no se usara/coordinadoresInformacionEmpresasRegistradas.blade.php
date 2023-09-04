<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css
    ">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <link href="/css/styleCoordinadores/coordinadoresInformacionEmpresasRegistradasStyle.css" rel="stylesheet" >
    <title>UPQROO</title>
</head>
<body>
    <header class="header">
        @extends('plantillas/coordinadores/plantillaCoordinadoresMenu')
        @section('headerStart')
        @endsection
    </header>

    <main class="main-container">
        {{-- seccionde barra de navegacion --}}
        <section class="barra-navegacion"> 
            <div class="items-navegacion">
                <a href="">ESTADíAS</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">empresas</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">nombre empresa</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        
            <form action="../../form-result.php" method="post" target="_blank" class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit" value="Buscar alumno" class="boton-buscador">
            </form>
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 class="contenedor-nombre-pagina"> <span class="nombre-pagina">empresas registradas</span> </h1>
            <div class="informacion-general">

                <div class="contenido-informacion-general">
                    <div class="cantidad-empresas">
                        <h3>empresas</h3>
                        <h2>188</h2>
                    </div>
                    <div class="empresas-con-convenio">
                        <h3>empresas con convenio</h3>
                        <h2>188</h2>
                    </div>
                    <div class="empresas-sin-convenio">
                        <h3>EMPRESAS SIN CONVENIO</h3>
                        <h2>0</h2>
                    </div>
                </div>
            </div>

        </div>
        {{--  seccion del data table  --}}
        <section class="data-table">

            <div class="card">
                <div class="card-body">
                   <table class="table table-striped" id="usuarios" class="table table-striped table-bordered" style="width:100%">               
                       <thead>
                               <tr>
                                   <th>empresa</th>
                                   <th>encargado rh</th>
                                   <th>razon social</th>
                                   <th>giro</th>
                                   <th>convenio</th>
                                   <th>telefono</th>
                                   <th>sec. empresarial</th>
                               </tr>
                           
                       </thead>
                       <tbody class="table-scroll">
                           @foreach ($datosTabla as $datosTabla)
                           <?php $var = 1+$datosTabla->id; 
                                $var2 = [  'educativo', 'tecnologica',  'turismo',  'empresarial'];
                                $random = mt_rand(0, 3);
                           ?>
                               <tr >
                                   <td>{{$datosTabla['nombre_emp']}}</td>
                                   <td>
                                       <a href="">
                                           {{$datosTabla['nombres_rh']}} {{$datosTabla['ape_paterno_rh']}} {{$datosTabla['ape_materno_rh']}}
                                       </a>
                                   </td>
                                   <td>razon social</td>
                                   <td>{{$datosTabla['giro']}}</td>
                                   <td>upqroo1213{{$var}}</td>
                                   <td>{{$datosTabla['tel_num']}}</td>
                                   <td>{{$var2[$random] }}</td>
                               </tr>
                           @endforeach 
                       </tbody>
                   </table>
               </div>
           </div>
               {{-- {{$datosTabla}} --}}
           </section>
       </main>
       {{-- se llama a la plantilla que ocntiene todos los scrips con los cdns necesarios para cargar el data table --}}
       @extends('plantillas/plantillaJsDataTable')
       @section('scripstStart')
       @endsection
</body>
</html>