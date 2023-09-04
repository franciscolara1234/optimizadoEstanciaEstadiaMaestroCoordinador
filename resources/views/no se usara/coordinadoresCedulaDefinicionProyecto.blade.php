<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styleCoordinadores/coordinadoresCedulaDefinicionProyectoStyle.css"rel="stylesheet" >
    <title>UPQROO</title>
    <script>
        function confirmacion(){
            var respuesta=confirm('¿DESEA APROBAR LA CEDULA DEL ALUMNO?');
            if(respuesta == true){
                return true;

            }else{
                return false;
            }
        }
    </script>


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
                <a href="">ESTADÍAS</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">ALUMNOS</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
                <a href="">201600069</a>
                <img src="/icons/simbolo-mayor-que.png" type=""
                alt="barra de navegacion" class="separador-navegacion">
            </div>

        </section>
        {{-- SECCION DEL BUSCADOR --}}
        {{-- method="post" target="_blank" --}}
            <form action="/cedulascoordinadores/" class="buscador-matricula">
                <input type="search" name="buscador matricula" placeholder="matrícula   alumno" class="barra-buscador-matricula" size="9" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <input type="submit"  value="Buscar alumno" class="boton-buscador">
            </form>
        
       {{-- seccion de informacion general --}}

        <div class="detalle-general-pagina">
            
                <h1 > <span class="nombre-pagina">cédula del alumno</span> </h1>

                <div class="contenedor-informacion-alumno">
                    <div class="contenedor-items-alumno">
                        <div class="contenedor-asignatura-alumno">
                            <div class="imagen-proceso-asignatura">
                                <img class="imagen-proceso" src="/icons/usuario-ESTADIAs.png" alt="">
                            </div>
                                <p class="nombre-proceso-asignatura">proceso estadia</p>
                            <div>

                            </div>
                        </div>
                        <div class="contenedor-nombre-alumno">
                            <p class="nombre-alumno">nombre: francisco alvarez ojeda espina carlos</p>
                        </div>
                        <div class="contenedor-matricula-alumno">
                            <p class="matricula-alumno">matricula: 201600069</p>
                        </div>
                        <div class="contenedor-carrera-alumno">
                            <p class="carrera-alumno">carre: ingenieria en software</p>
                        </div>
                        <div class="contenedor-empresa-alumno">
                            <p class="empresa-alumno">empresa: empresa ficticia de la unam s.a de c.v</p>
                        </div>
                        <div class="contenedor-empresa-convenio-alumno">
                            <p class="empresa-convenio-alumno">convenio: 123ertoqp304958dff</p>
                        </div>
                        <div class="contenedor-ver-cedula-alumno">
                            <a href="" class="ver-cedula">ver cedula</a>
                        </div>
                    </div>
                </div>

        </div>
        {{-- ESTATUS DE LA CEDULA --}}
        <div class="contenedor-informacion-cedula">
            <div class="contenedor-items-cedula">
                <p class="frase-definicion-proyecto">estatus cedula definicion de proyecto:</p>
                <p class="estatus-definicion-proyecto">rechazada en espera de cambios</p>
            </div>

        </div>

        {{--  seccion del avance documentacion   --}}
        <section class="contenedor-observaciones">
            <h2 class="titulo-observaciones"><span >observaciones</span></h2>
            {{-- method="post" target="_blank" --}}
             <form action="/cedulascoordinadores/" class="contenedor-observaciones-generales">
                
                <div class="observaciones-academico" observaciob>
                    <label for="asesor-academico" class="remitente-academico">asesor academico</label>

                    <textarea class="mensaje-observaciones-academico" name="observaciones-asesor-academico" placeholder="observaciones" minlength="20" maxlength="1000" readonly="readonly"></textarea>

                </div>
                <div class="observaciones-coordinador">
                    <label for="coordinador-coordiandor" class="remitente-coordinador">coordinador carrera</label>
                    <textarea class="mensaje-observaciones-coordinador" name="observaciones-coordinador-carrera" placeholder="observaciones" minlength="20" maxlength="1000" readonly="readonly"></textarea>
                </div>


                <input type="submit"  value="aprobar cedula" class="boton-aprobar-cedula" onclick="return confirmacion()">


{{-- 
                <button onclick="" value="rechazar y anexar observaciones" class="boton-rechazar-cedula"></button> --}}
                    <a  class="boton-rechazar-cedula" href="{{ route('mensajeCoordinadorCarrera.create')}}" >
                        <div >
                        rechazar y anexar observacione
                    </div></a>
               




            </form>

            
                       
        </section>
    </main>
</body>
</html>