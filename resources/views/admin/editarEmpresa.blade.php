<!DOCTYPE html>
<html lang="es">

<head>
    @include('plantilla/admin/headEmpresaAdmin')
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
    @include('plantilla/admin/navBar')
    <section class="full-box dashboard-contentPage">

        <!-- Content page -->
        <div class="container p-3">
            <div class="row p-4">
                <div class="col-12 col-md-9">
                    <div class="page-header">
                        <h2 class="text-titles">Cambiar los Datos De Empresas <small>(Empresas)</small></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                    {{-- dd($data); --}}
                    @foreach ($data as $dato)
                        <form method="POST" action="{{ route('editarEmpresa.index', $dato->IdEmp) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="nombre"
                                            class="form-control form-control-lg text-center" name="nombre"
                                            value="{{ $dato->Nombre }}" />
                                        <label class="form-label" for="nombre">Nombre de la Empresa</label>
                                    </div>
                                    @error('nombre')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="direccion"
                                            class="form-control form-control-lg text-center" name="direccion"
                                            value="{{ $dato->Direccion }}" />
                                        <label class="form-label" for="direccion">Direccion</label>
                                    </div>
                                    @error('direccion')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="email" id="correo"
                                            class="form-control form-control-lg text-center" name="correo"
                                            value="{{ $dato->Correo }}" />
                                        <label class="form-label" for="correo">Email(empresa)</label>
                                    </div>
                                    @error('correo')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="tel" id="telefono"
                                            class="form-control form-control-lg text-center" name="telefono"
                                            value="{{ $dato->Telefono }}" />
                                        <label class="form-label" for="telefono">Telefono(empresa)</label>
                                    </div>
                                    @error('telefono')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="rfc"
                                            class="form-control form-control-lg text-center" name="rfc"
                                            value="{{ $dato->RFC }}" />
                                        <label class="form-label" for="rfc">RFC(empresa)</label>
                                    </div>
                                    @error('rfc')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="giro"
                                            class="form-control form-control-lg text-center" name="giro"
                                            value="{{ $dato->Giro }}" />
                                        <label class="form-label" for="giro">Giro(empresa)</label>
                                    </div>
                                    @error('giro')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="url" id="urlemp"
                                            class="form-control form-control-lg text-center" name="urlemp"
                                            value="{{ $dato->URLemp }}" />
                                        <label class="form-label" for="urlemp">URL(empresa)</label>
                                    </div>
                                    @error('urlemp')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div>


                                <div>
                                    <label for="Tipo_Empresa" class="block font-medium mb-2 form-label">Tipo Empresa:</label>
                                    <select id="Tipo_Empresa" name="Tipo_Empresa"
                                        class="form-control form-control-lg w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach ($Tipoemp as $tipo)
                                            <option value="{{ $tipo->id_Tipo_Emp }}" {{ $tipo->id_Tipo_Emp == $dato->fk_TipoEmp?  'selected' : '' }}>{{ $tipo->Tipo_Empresa }}
                                            </option >
                                        @endforeach
                                    </select>
                                    {{-- <?php

                                    // var_dump ($Tipoemp);
                                    ?> --}}
                                </div>

                                <div>
                                    <label for="Tamaño_Empresa" class="block font-medium mb-2 form-label">Tamaño Empresa:</label>
                                    <select id="Tamaño_Empresa" name="Tamaño_Empresa"
                                        class="form-control form-control-lg w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach ($Tamañoemp as $tamaño)
                                            <option value="{{ $tamaño->id_Tamaño_Emp }}" {{ $tamaño->id_Tamaño_Emp == $dato->fk_TamañoEmp?  'selected' : '' }}>{{ $tamaño->Tipo_Tamaño }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <?php

                                    // var_dump ($Tipoemp);
                                    ?> --}}
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Guardar</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    @endforeach
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
    <script>
        $.material.init();
    </script>

</body>

</html>









{{-- <!-- <div class="col-12 col-md-3">
                    @foreach ($datos as $dato)
                        <form action="{{ route('eliminarUsuarioCompleto.index', $dato->IdEmp) }}"
                            class="btn-eliminarC-system" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btnEliminarUser ">Eliminar
                                Permanente</button>
                        </form>
                    @endforeach
                </div> --> --}}



{{-- <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password"
                                            class="form-control form-control-lg text-center" name="password" />
                                        <label class="form-label" for="password">Contraseña</label>
                                    </div>
                                    @error('password')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div> --}}

{{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <select class="form-control" name="tipoemp" id="tipoemp">
                                            @foreach ($empresa as $Edatos)
                                                <option value="{{ $Edatos->IdEmp }}">{{ $Edatos->fk_TipoEmp }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="urlemp">Tipo(empresa)</label>
                                    </div>
                                    @error('fk_tipoemp')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div> --}}





{{-- <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
                                    <div class="form-outline mb-4">
                                        <select name="Tipo" id="Tipo" class="form-control form-control-lg text-center">
                                            @foreach ($empresa as $Tipo)
                                                <option value="{{$Tipo->id_Tipo_Emp}}">{{$Tipo->Tipo_Nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

{{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <select class="form-control" name="tipoemp" id="tipoemp">
                                            @foreach ($empresa as $Edatos)
                                                <option value="{{ $Edatos->id_Tipo_Emp }}">{{ $Edatos->Tipo_Empresa }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="urlemp">Tipo(empresa)</label>
                                    </div>
                                    @error('fk_tipoemp')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div> --}}




                                {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="tipo_empresa"
                                            class="form-control form-control-lg text-center" name="tipo_empresa"
                                            value="{{ $dato->Tipo_Empresa }}" />
                                        <label class="form-label" for="tipo_empresa">Tipo(empresa)</label>
                                    </div>
                                    @error('tipo_empresa')
                                        <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                            {{ $message }}</p>
                                    @enderror
                                </div> --}}
