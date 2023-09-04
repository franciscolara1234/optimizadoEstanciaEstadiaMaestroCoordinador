<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Observaciones</title>
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
    <!-- NavBar -->

    
    @if (auth()->user()->IdTipoUsu == 1)
    @include('plantilla/admin/navBar')
    @elseif(auth()->user()->IdTipoUsu == 2)
    @include('plantilla/alumno/navBar')
    @endif

    @include('sweetalert::alert')
    @include('notificaciones/notificaciones')
    <!-- Content page-->
    <section class="full-box dashboard-contentPage ">
                    {{-- ///header --}}
                @if($documento->IdEstado==2 && $documento->estadoAca==NULL && $documento->IdTipoDoc == 6 
                || $documento->IdEstado==2 && $documento->estadoAca==Null && $documento->IdTipoDoc==7)
                    <div class="page-header">
                        <h2 class="text-center" style="padding: 1%">Cambiar/Actualizar Documento{{$documento->ruta}}</h2>
                    </div>
                @else                        
                    <div class="page-header">
                        <h2 class="text-center" style="padding: 1%">Observaciones para el documento {{$documento->ruta}}</h2>
                    </div>        
                @endif


{{-- 
        @if(sizeof($documento->comentarios_docu)!=0 )
                    <div class="page-header">
                        <h4 class="text-center" style="padding: 1%">Actualizar Documento</h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form for=" center-blockformFileLg" class="text-center form-label" action="{{ route('editar_documento_alumno',
                        ['idDoc' => $documento->IdDoc, 'idProceso' => $procesoTipoSeleccionado])}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                    @csrf
                                <span class="btn fileinput-button">
                                    <i class="zmdi zmdi-file"></i>
                                    <input type="file" class="form-control form-control-lg archivo" name="docs_archivo">
                                </span>
                                <button  type="submit"
                                        class="btn btn-primary mb-3">Enviar</button>
                        </form>

                    </div>
        @endif --}}
                        @if (auth()->user()->IdTipoUsu == 2 && $documento->IdTipoDoc==6 || auth()->user()->IdTipoUsu == 2 && $documento->IdTipoDoc==7)
                        <div class="page-header">
                            <h4 class="text-center" style="padding: 1%">Actualizar Documento</h4>
                        </div>
                        <div class="d-flex justify-content-center form-control">
                            <form class=" center-block form-label" action="{{ route('editar_documento_alumno',
                            ['idDoc' => $documento->IdDoc, 'idProceso' => $procesoTipoSeleccionado])}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                                @csrf
                            <span class="btn fileinput-button">
                                <i class="zmdi zmdi-file"></i>
                                <input type="file" class="form-control form-control-lg archivo" name="docs_archivo">
                            </span>
                            <button  type="submit"
                                    class="btn btn-primary mb-3 ">Enviar</button>
                            </form>
                        </div>
                        @endif
{{-- @dump($documento->) --}}
        <form action="{{ route('observacion_documento',[$documento->IdDoc, $idProcesoSeleccionado = $procesoTipoSeleccionado]) }}" method="post"
            enctype="multipart/form-data">
            @csrf

 
            @if(sizeof($documento->comentarios_docu)!=0)

                @if($documento->comentarios_docu[0]->TipoComentario == 1)
                <div class="text-center" style="padding: 2%">
                    <textarea class="form-control" id="observaciones" rows="5" name="observaciones" readonly>ACADÉMICO:  {{$documento->comentarios_docu[0]->Comentario}}</textarea>
                </div> 
                @elseif($documento->comentarios_docu[1]->TipoComentario == 2)
                    <div class="text-center" style="padding: 2%">
                        <textarea class="form-control" id="observaciones" rows="5" name="observaciones" readonly>VINCULACIÓN:  {{$documento->comentarios_docu[1]->Comentario}}</textarea>
                    </div> 
                @endif
            @else
            
                    @if (empty($documento->comentario))
                        @if (auth()->user()->IdTipoUsu == 1)
                            <div class="text-center" style="padding: 2%">
                                <textarea class="form-control" id="observaciones" rows="5" name="observaciones"> </textarea>
                            </div>         
                        @endif
                    @else

                        <div class="text-center" style="padding: 2%">
                            <textarea class="form-control" id="observaciones" rows="5" name="observaciones" readonly>VINCULACIÓN: {{$documento->comentario}} </textarea>
                        </div>         

                    @endif
            @endif
            


            @if($documento->comentario)
                
            @else

                @if (auth()->user()->IdTipoUsu == 1)
                    
                    <div class="text-center">
                        <button class="btn btn-dark btn-lg btn-block g" type="submit">Guardar</button>
                    </div>

                    
                @endif



            @endif
        </form>
    </section>

    <!--====== Scripts -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/sweetalert2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/material.min.js"></script>
    <script src="./js/ripples.min.js"></script>
    <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="./js/main.js"></script>
    <script>
        $.material.init();
    </script>
</body>

</html>
<style>
    .id_d {
        visibility: hidden;
        display: none;
        width: 10px;
    }
</style>
