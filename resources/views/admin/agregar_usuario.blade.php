<!DOCTYPE html>
<html lang="es">

<head>
    @include('plantilla/admin/head')
</head>

<body>
    <!-- Content page-->
    <section class="full-box dashboard-contentPage">
        <!-- NavBar -->
        @include('plantilla/admin/navBar')

        <!-- Content page -->
        <div class="container p-3">
            <div class="page-header">
                <h2 class="text-titles">Agregar Usuario <small>(Nuevo)</small></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                    <form method="POST" action="{{ route('registrar_usuario.index') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <input type="text" id="name" class="form-control form-control-lg"
                                        name="name" value="{{ old('name') }}"/>
                                    <label class="form-label" for="name">Alumno (Matrícula) / Admin (Nombre)</label>
                                </div>
                                @error('name')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <select class="form-control" name="IdTipoUsu" id="IdTipoUsu" value="{{ old('idTipoUsu') }}">
                                        
                                        <option value="">Seleccionar Una Opcion</option>   
                                        @foreach ($tipousuario as $tipo)
                                        <option value="{{ $tipo->IdTipoUsu }}">{{ $tipo->NombreTipo }}</option>   
                                        @endforeach
                                    </select>
                                    <label class="form-label" for="role">Rol de Usuario</label>
                                </div>
                                @error('IdTipoUsu')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-outline mb-4">
                                    <input type="email" id="email" class="form-control form-control-lg"
                                        name="email" value="{{ old('email') }}" />
                                    <label class="form-label" for="email">Email(UPQROO)</label>
                                </div>
                                @error('email')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" class="form-control form-control-lg"
                                        name="password" />
                                    <label class="form-label" for="password">Contraseña</label>
                                </div>
                                @error('password')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <input type="password" id="password_confirmation"
                                        class="form-control form-control-lg" name="password_confirmation" />
                                    <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                </div>

                                @error('message')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">*
                                        Error</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <input type="text" id="Nombre" class="form-control form-control-lg"
                                        name="Nombre" value="{{ old('Nombre') }}" />
                                    <label class="form-label" for="name">Nombre de la persona</label>
                                </div>
                                @error('Nombre')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <input type="text" id="ApellidoPaterno" class="form-control form-control-lg"
                                        name="APP" value="{{ old('APP') }}" />
                                    <label class="form-label" for="name">Apellido Paterno</label>
                                </div>
                                @error('APP')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <input type="text" id="ApellidoMaterno" class="form-control form-control-lg"
                                        name="APM" value="{{ old('APM') }}" />
                                    <label class="form-label" for="name">Apellido Materno</label>
                                </div>
                                @error('APM')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <input type="number" id="Matricula" class="form-control form-control-lg"
                                        name="Matricula" value="{{ old('Matricula') }}" />
                                    <label class="form-label" for="name">Matricula</label>
                                </div>
                                @error('Matricula')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <select id="IdCarrera"  class="form-control form-control-lg" name="IdCarrera" value="{{ old('IdCarrera') }}" >

                                        <option value="">Seleccione Una Carrera</option> 
                                        @foreach ($carreras as $item)
                                        <option value="{{$item['IdCarrera']}}">{{$item['NombreCarrera']}}</option> 
                                        @endforeach
                                    </select>
                                    <label class="form-label" for="Carreras">Carreras</label>
                                </div>
                                @error('IdCarrera')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-outline mb-4">
                                    <select id="tipoGrado"  class="form-control form-control-lg" name="IdGrado" style="display:none" value="{{ old('IdGrado') }}"  disabled>
                                        @foreach ($gradoAcademico as $item)
                                        <option value="{{$item['IdGrado']}}">{{$item['NombreGrado']}} </option> 
                                        
                                        @endforeach
                                    </select>
                                    <label style="display:none" class="form-label" id="gradoAcademico" for="IdGrado">Grado Academico</label>
                                </div>
                                @error('IdGrado')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="pt-1 mb-4">
                                    <button class="btn btn-dark btn-lg btn-block" type="submit">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mx-auto">
                <div class="card">
                    <div class="card-body text-black form-group m-4">
                        <form action=" {{ route('registrar_usuario_csv.index')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="alumnoscsv" class="">Subir csv alumnos</label>
                            <input type="file" name="alumnoscsv" id="alumnoscsv" class="form-control my-1">
                            <button type="submit" value="Enviar" class="btn btn-dark">Subir Alumnos</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Scripts -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/sweetalert2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/material.min.js"></script>
    <script src="./js/ripples.min.js"></script>
    <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/registrarUsuarioSelectNoneBlock.js"></script>
    <script>
        $.material.init();
    </script>

</body>

</html>
