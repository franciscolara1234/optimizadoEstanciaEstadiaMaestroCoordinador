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
        <div class="container p-3 center-block">
            <div class="page-header d-flex justify-content-center align-items-center">
                <h2 class="text-titles"> Asignar Asesor Academico al Proceso y Carrera <small>(Nuevo)</small></h2>
            </div>
        </div> 
        <!-- Content page -->
   {{--  seccion del avance documentacion   --}}
        <section class="col-md-12 col-lg-12 d-flex justify-content-center align-items-center">
           {{-- method="post" target="_blank"  --}}
           <div class="card-body p-4 p-lg-5 text-black">


            <form method="POST" action="{{ route('CrearAulaProcesoAcademico')}}" class="d-flex justify-content-center align-items-center">
                @csrf
                <div class="row">

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <label for="tipo-proceso" class="form-label">Proceso Elegido</label>
    
                        <select id="tipoProceso"  class="form-control form-control-lg" name="select-tipo-proceso" reandoly>
                            <option value="{{$tipoProcesoSeleccionado[0]->IdTipoProceso}}">{{$tipoProcesoSeleccionado[0]->nombreProceso}}</option> 
                        </select>
                    </div> 
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <label for="carrera" class="form-label">Carrera Elegida</label>
    
                        <select id="tipoProceso"  class="form-control form-control-lg" name="select-carrera" reandoly>
                            <option value="{{$carreraSeleccionada[0]->IdCarrera}}">{{$carreraSeleccionada[0]->NombreCarrera}}</option> 
                        </select>
                    </div> 

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-outline mb-4">
                            <label for="tipo-proceso" class="form-label">Elegir Al Asesor Academico Para El Proceso Elegido</label>
    
                        <select id="tipoProceso"  class="form-control form-control-lg" name="select-id-maestro" >
                            @foreach ($maestros as $item)
                            <option value="{{$item['id']}}">{{$item->aa_academico_user->Nombre}}  {{$item->aa_academico_user->APP}} {{$item->aa_academico_user->APM}}</option> 
                            @endforeach
                        </select>
                        </div>
                        
                        
                    </div>

                    {{-- <input type="submit"  value="seleccionar Proceso" class="boton-aprobar-cedula" disabled> --}}
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center">
                    <div class="pt-1 mb-4">
                            <input type="submit"  value="Confirmar Proceso-Carrera" class="btn btn-dark btn-lg btn-block" onclick="return= confirmacion()">                        </div>
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
    <script>
        $.material.init();
    </script>
    <script>
    document.getElementById("tipoProceso").addEventListener("change", function() {
    if (this.value === "1") {
        document.getElementById("procesoCarrera1").setAttribute('required', '');
        document.getElementById("procesoCarrera1").removeAttribute('disabled', '');
        document.getElementById("procesoCarrera1").style.display = "block";
    } else {
        document.getElementById("procesoCarrera1").removeAttribute('required', '');
        document.getElementById("procesoCarrera1").setAttribute('disabled', '');
        document.getElementById("procesoCarrera1").style.display = "none";
    }
    if (this.value === "2") {
      document.getElementById("procesoCarrera2").setAttribute('required', '');
      document.getElementById("procesoCarrera2").removeAttribute('disabled', '');
      document.getElementById("procesoCarrera2").style.display = "block";
    } else {
      document.getElementById("procesoCarrera2").removeAttribute('required', '');
      document.getElementById("procesoCarrera2").setAttribute('disabled', '');
      document.getElementById("procesoCarrera2").style.display = "none";
    }
    
    if (this.value === "3") {
      document.getElementById("procesoCarrera3").setAttribute('required', '');
      document.getElementById("procesoCarrera3").removeAttribute('disabled', '');
      document.getElementById("procesoCarrera3").style.display = "block";
    } else {
      document.getElementById("procesoCarrera3").removeAttribute('required', '');
      document.getElementById("procesoCarrera3").setAttribute('disabled', '');
      document.getElementById("procesoCarrera3").style.display = "none";
    }
    if (this.value === "4") {
      document.getElementById("procesoCarrera4").setAttribute('required', '');
      document.getElementById("procesoCarrera4").removeAttribute('disabled', '');
      document.getElementById("procesoCarrera4").style.display = "block";
    } else {
        document.getElementById("procesoCarrera4").removeAttribute('required', '');
        document.getElementById("procesoCarrera4").setAttribute('disabled', '');
        document.getElementById("procesoCarrera4").style.display = "none";
    }
    if (this.value === "5") {
        document.getElementById("procesoCarrera5").setAttribute('required', '');
        document.getElementById("procesoCarrera5").removeAttribute('disabled', '');
        document.getElementById("procesoCarrera5").style.display = "block";
    } else {
      document.getElementById("procesoCarrera5").removeAttribute('required', '');
      document.getElementById("procesoCarrera5").setAttribute('disabled', '');
      document.getElementById("procesoCarrera5").style.display = "none";
    }
  });


// function mostrar(){
            
            
        //     let tipoProceso  = document.getElementById("tipoProceso")
        //     // let cajaTexto = document.getElementById("color")
        //     let procesoCarrera1 = document.getElementById('procesoCarrera');
        //     let procesoCarrera2 = document.getElementById('procesoCarrera2');
        //     let procesoCarrera3 = document.getElementById('procesoCarrera3');
        //     let procesoCarrera4 = document.getElementById('procesoCarrera4');
        //     let procesoCarrera5 = document.getElementById('procesoCarrera5');

        //     if(procesoCarrera1 === 'Estancia'){
        //         procesoCarrera1.style.display = "block"
        //         procesoCarrera2.style.display = "none"
        //         procesoCarrera3.style.display = "none"
        //         procesoCarrera4.style.display = "none"
        //         procesoCarrera5.style.display = "none"
        //     }

        //     switch (tipoProceso) {
        //         case "Estancia":
        //         procesoCarrera1.style.display = "inline"
        //         procesoCarrera2.style.display = "none"
        //         procesoCarrera3.style.display = "none"
        //         procesoCarrera4.style.display = "none"
        //         procesoCarrera5.style.display = "none"

        //         [break;]
        //         case "Estancia 2":
        //         procesoCarrera1.style.display = "none"
        //         procesoCarrera2.style.display = "inline"
        //         procesoCarrera3.style.display = "none"
        //         procesoCarrera4.style.display = "none"
        //         procesoCarrera5.style.display = "none"
        //             [break;]
        //         ...
        //         case "Estadia":
        //         procesoCarrera1.style.display = "none"
        //         procesoCarrera2.style.display = "none"
        //         procesoCarrera3.style.display = "inline"
        //         procesoCarrera4.style.display = "none"
        //         procesoCarrera5.style.display = "none"
        //             [break;]
        //         case "Servicio Social":
        //         procesoCarrera1.style.display = "none"
        //         procesoCarrera2.style.display = "none"
        //         procesoCarrera3.style.display = "none"
        //         procesoCarrera4.style.display = "inline"
        //         procesoCarrera5.style.display = "none"
        //             [break;]
        //         case "Estadia Nacional":
        //         procesoCarrera1.style.display = "none"
        //         procesoCarrera2.style.display = "none"
        //         procesoCarrera3.style.display = "none"
        //         procesoCarrera4.style.display = "none"
        //         procesoCarrera5.style.display = "inline"
        //             [break;]

        //         default:
        //             [break;]
        //         }
        //  }
    </script>
</body>


    {{-- <script>
        function mostrar(){
            
            
            let tipoProceso  = document.getElementById("tipoProceso")
            // let cajaTexto = document.getElementById("color")
            let procesoCarrera1 = document.getElementById('procesoCarrera');
            let procesoCarrera2 = document.getElementById('procesoCarrera2');
            let procesoCarrera3 = document.getElementById('procesoCarrera3');
            let procesoCarrera4 = document.getElementById('procesoCarrera4');
            let procesoCarrera5 = document.getElementById('procesoCarrera5');

            if(procesoCarrera1 === 'Estancia'){
                procesoCarrera1.style.display = "block"
                procesoCarrera2.style.display = "none"
                procesoCarrera3.style.display = "none"
                procesoCarrera4.style.display = "none"
                procesoCarrera5.style.display = "none"
            }

            switch (tipoProceso) {
                case "Estancia":
                procesoCarrera1.style.display = "inline"
                procesoCarrera2.style.display = "none"
                procesoCarrera3.style.display = "none"
                procesoCarrera4.style.display = "none"
                procesoCarrera5.style.display = "none"

                [break;]
                case "Estancia 2":
                procesoCarrera1.style.display = "none"
                procesoCarrera2.style.display = "inline"
                procesoCarrera3.style.display = "none"
                procesoCarrera4.style.display = "none"
                procesoCarrera5.style.display = "none"
                    [break;]
                ...
                case "Estadia":
                procesoCarrera1.style.display = "none"
                procesoCarrera2.style.display = "none"
                procesoCarrera3.style.display = "inline"
                procesoCarrera4.style.display = "none"
                procesoCarrera5.style.display = "none"
                    [break;]
                case "Servicio Social":
                procesoCarrera1.style.display = "none"
                procesoCarrera2.style.display = "none"
                procesoCarrera3.style.display = "none"
                procesoCarrera4.style.display = "inline"
                procesoCarrera5.style.display = "none"
                    [break;]
                case "Estadia Nacional":
                procesoCarrera1.style.display = "none"
                procesoCarrera2.style.display = "none"
                procesoCarrera3.style.display = "none"
                procesoCarrera4.style.display = "none"
                procesoCarrera5.style.display = "inline"
                    [break;]

                default:
                    [break;]
                }
         }

    </script> --}}


</html>
