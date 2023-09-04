<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styleCoordinadores/coordinadoresdatosGeneralesEmpresaStyle.css" rel="stylesheet" >
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
                <a href="">ESTADIAS</a>
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

                <div class="scroll">
                    <div class="contenido-informacion-general">
                        {{-- <div class="imagen-empresa">
                            <img src="/icons/empresa.png" type=""
                            alt="barra de navegacion" class="separador-navegacion">
                        </div> --}}
                        
                        <div class="nombre-empresa">
                            <p>empresa:</p>
                            <p>universidad politecnica de quintana roo</p>
                        </div>
                        <div class="responsable-empresa">
                            <p>contacto:</p>
                            <p>nombre contacto empresa encargado area</p>
                        </div>
                        <div class="cargo-responsable">
                            <p>cargo del contacto</p>
                            <p>ingeniero encargo del area de software</p>
                        </div>
                        <div class="correo-empresarial">
                            <p>correo electronico:</p>
                            <p>empresadelarea@upqroo.edu.mx</p>
                        </div>
                        <div class="telefono-empresa">
                            <p>telefono:</p>
                            <p>9990009998</p>
                        </div>
                        <div class="razon-social">
                            <p>razon social:</p>
                            <p>emresa ficticia de quintana roo s a de c v</p>
                        </div>
                        <div class="numero-convenio">
                            <p>convenio</p>
                            <p>qw3452etr492ud83uqw</p>
                        </div>
                        <div class="sector-empresarial">
                            <p>sector empresarial:</p>
                            <p>tecnologica</p>
                        </div>
                        <div class="clasificacion-empresa">
                            <p>clasificacio de la empresa:</p>
                            <p>privada</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        {{--  seccion del data table  --}}
        <section class="alumnos-matriculados">
            <div class="titulo-alumnos-empresa">
                <h2><span>alumnos en la empresa</span></h2>
            </div>
            <div class="contenedor-alumnos-empresa">
                <div class="contenedor-estancias-uno">
                    <p>estancia 1:</p>
                    <p>02</p>
                </div>
                <div class="contenedor-estancias-dos">
                    <p>estancias 2:</p>
                    <p>03</p>
                </div>
                <div class="contenedor-estadias">
                    <p>estadias:</p>
                    <p>00</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>