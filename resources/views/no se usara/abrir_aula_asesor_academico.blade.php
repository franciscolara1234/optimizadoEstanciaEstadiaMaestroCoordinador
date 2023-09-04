<!DOCTYPE html>
<html lang="es">

<head>
    @include('plantilla/admin/head')
</head>

<body>
    <!-- Content page-->
    <section class="full-box dashboard-contentPage " >
        <!-- NavBar -->
        @include('plantilla/admin/navBar')
        @include('notificaciones/notificaciones')
        @include('sweetalert::alert')


        <div class="container p-3 center-block">
            <div class="page-header d-flex justify-content-center align-items-center">
                <h2 class="text-titles"> Seleccionar El Asesor Academico Para El Proceso  <small>(Nuevo)</small></h2>
            </div>
        </div> 
        <!-- Content page -->
   {{--  seccion del avance documentacion   --}}
        <section class="col-md-12 col-lg-12 d-flex justify-content-center align-items-center">
           {{-- method="post" target="_blank"  --}}
           <div class="card-body p-4 p-lg-5 text-black">


            <form action="{{ route('AsignarMaestroAulaProceso')}}" method="POST" class="d-flex justify-content-center align-items-center">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-outline mb-4">
                            <label for="tipo-proceso" class="form-label">Elegir el tipo de proceso para abrir el aula</label>
    
                        <select id="tipoProceso"  class="form-control form-control-lg" name="select-tipo-proceso" required>
                                    <option selected="selected" value="no">Selccionar Un Proceso</option>                                 
                                    @foreach ($procesosSelect as $item)
                                    <option value="{{$item['IdTipoProceso']}}">{{$item['nombreProceso']}}</option>
                                    @endforeach
                        </select>
                        @error('select-tipo-proceso')
                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">*
                            Error</p>
                        @enderror
                        </div>
                        
                        
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                        <label for="asesor-academico" class="form-label">Elegir el tipo de proceso para asignar al Asesor academico</label>
                        @php($contenedorNum = 1)
                        
                        @foreach($carrerasConTipoProcesoDisponibles as $numero)

                        
                        @if ($contenedorNum == 1)
                            <select id="{{'procesoCarrera'.$contenedorNum}}" class="form-control form-control-lg" name="select-carrera" style="display:none" required>
                            <option value=""> Selccionar Una Carrera</option>
                            
                        @else
                            <select id="{{'procesoCarrera'.$contenedorNum}}" class="form-control form-control-lg" name="select-carrera" style="display:none" required disabled>
                            <option value=""> Selccionar Una Carrera</option>
                            
                        @endif

                                @foreach($numero as $elemento)

                                {{-- <option value=" ">Seleccionar Tipo de Proceso</option>  --}}
                                    @if (count($elemento)!=0)
                                        @switch($elemento['idTipoProceso'])
                                            @case(1)
                                            <option value="{{$elemento['idCarrera']}}">{{$elemento['tipoProcesoConCarreraDisponibleSinAsignar']}}</option> 
                                            @break
                                        
                                            @case(2)
                                            <option value="{{$elemento['idCarrera']}}">{{$elemento['tipoProcesoConCarreraDisponibleSinAsignar']}}</option> 
                                            @break
                                            @case(3)
                                            <option value="{{$elemento['idCarrera']}}">{{$elemento['tipoProcesoConCarreraDisponibleSinAsignar']}}</option> 
                                                @break
                                            @case(4)
                                            <option value="{{$elemento['idCarrera']}}">{{$elemento['tipoProcesoConCarreraDisponibleSinAsignar']}}</option> 
                                                @break
                                            @case(5)
                                            <option value="{{$elemento['idCarrera']}}">{{$elemento['tipoProcesoConCarreraDisponibleSinAsignar']}}</option> 
                                            @break
                                        
                                            @default
                                        @endswitch
                                    @endif
                                @endforeach
                                @php($contenedorNum++)
                            </select>
                            @endforeach
                            <br>
                    </div>
                    @error('select-carrera')
                    <br>
                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">{{$message}}</p>
                    @enderror
                    {{-- <input type="submit"  value="seleccionar Proceso" class="boton-aprobar-cedula" disabled> --}}
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center">
                    <div class="pt-1 mb-4">
                            <input type="submit"  value="Elegir Proceso-Carrera" class="btn btn-dark btn-lg btn-block" onclick="return= confirmacion()">                        </div>
                    </div>

                </div>


            </form>

            </div>

                       
        </section>      
     
    </section>
    <!--====== Scripts -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/sweetalert2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/material.min.js"></script>
    <script src="./js/ripples.min.js"></script>
    <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="./js/main.js"></script>
    
    <script src="./js/abrirAulaAsesorAcademicoSelectNoneBlock.js"></script>
    <script>
        $.material.init();
    </script>
    <script>
        document.ready = document.getElementById("tipoProceso").value = 'no';
    </script>
</body>

</html>
