<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    @include('plantilla/admin/head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-cover bg-center" style="background-image: url('https://ceduladeregistro.upqroo.edu.mx/css/LogoCafe.jpg')">

    <!-- Content page-->
    <section class="full-box dashboard-contentPage">
        <!-- NavBar -->
        @include('plantilla/admin/navBar')
        <form method="POST" action="{{ route('registrar_empresa.index') }}">
            @csrf
            <div class="flex justify-center items-center h-screen bg-cover bg-center">
                <div class="bg-white p-4 rounded shadow-lg">
                    <h1 class="text-2xl font-bold mb-4">Registro de empresa</h1>
                    <form>
                        <div class="grid grid-cols-4 gap-2">
                            <div>
                                <label for="Nombre" class="block font-medium mb-2 form-label">Nombre</label>
                                <input type="text" id="Nombre" class="form-control form-control-lg"
                                    name="Nombre" />
                                @error('Nombre')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror

                            </div>
                            <div>
                                <label for="Giro" class="block font-medium mb-2 form-label">Tipo de Giro</label>
                                <input type="text" id="Giro" class="form-control form-control-lg"
                                    name="Giro" />
                                @error('Giro')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="Telefono" class="block font-medium mb-2 form-label">Teléfono</label>
                                <input type="tel" id="Telefono" class="form-control form-control-lg"
                                    name="Telefono" />
                                @error('Telefono')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="fk_TamañoEmp" class="block font-medium mb-2 form-label">Tamaño:</label>
                                {{-- <input type="text" id="fk_TamañoEmp" class="form-control form-control-lg"
                                name="fk_TamañoEmp" /> --}}

                                <select id="fk_TamañoEmp" name="fk_TamañoEmp"
                                    class="form-control form-control-lg w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Pequeña</option>
                                    <option value="2">Mediana</option>
                                    <option value="3">Grande</option>
                                </select>

                                {{-- <select id="fk_TamañoEmp" name="fk_TamañoEmp"
                                    class="form-control form-control-lg w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($empresa as $tamaños)
                                        <option value="{{ $tamaños->id_Tamaño_Emp}}">{{ $tamaños->Tipo_Tamaño }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div>
                                <label for="fk_TipoEmp" class="block font-medium mb-2 form-label">Tipo de
                                    empresa:</label>
                                {{-- <input type="text" id="fk_TipoEmp" class="form-control form-control-lg"
                                name="fk_TipoEmp" /> --}}
                                <select id="fk_TipoEmp" name="fk_TipoEmp"
                                    class="form-control form-control-lg w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="1">Privada</option>
                                    <option value="2">Publica</option>
                                    <option value="3">Social</option>
                                </select>
                                {{-- <select id="fk_TipoEmp" name="fk_TipoEmp"
                                    class="form-control form-control-lg w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($empresa as $tipoempr)
                                        <option value="{{ $tipoempr->id_Tipo_Emp}}">{{ $tipoempr->id_Tipo_Emp }}</option>
                                    @endforeach
                                </select> --}}

                                @error('fk_TipoEmp')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="Direccion" class="block font-medium mb-2 form-label">Dirección</label>
                                <input type="text" id="Direccion" class="form-control form-control-lg"
                                    name="Direccion" />
                                @error('Direccion')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="Correo" class="block font-medium mb-2 form-label">Email</label>
                                <input type="text" id="Correo" class="form-control form-control-lg"
                                    name="Correo" />
                                @error('Correo')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="RFC" class="block font-medium mb-2 form-label">RFC</label>
                                <input type="text" id="RFC" class="form-control form-control-lg"
                                    name="RFC" />
                                @error('RFC')
                                    <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="w-full">
                            <label for="URLemp" class="block font-medium mb-2 form-label">URL</label>
                            <input type="text" id="URLemp" class="form-control form-control-lg" name="URLemp" />
                            @error('URLemp')
                                <p class="border border-danger rounded-md bg-red-200 w-full text-red-600 p-2 my-2">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="mt-4 bg-indigo-900 text-white rounded-lg px-4 py-2 mx-auto block">Registrar</button>

                    </form>
                </div>
            </div>
        </form>



    </section>

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
