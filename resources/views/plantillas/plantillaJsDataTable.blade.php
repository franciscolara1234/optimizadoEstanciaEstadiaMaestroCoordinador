@yield('scripstStart')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script>
          $('#usuarios').DataTable(
            {
            dom:  
            "Bfrltip",
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ],
            responsive: true, autoWidth: false,
            columnDefs: [
                { responsivePriority: 0, targets: 1 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 2, targets: -1 }
            ],
  
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },});
            
        //   $('#usuarios').DataTable();
    </script>


            @if (session('documento')!=NULL)
                <script>
                    Swal.fire(
                            'Guardado!',
                            'Las Observaciones Se Han guardado con Exito.',
                            'Éxito'
                            )
                </script>
            @endif
            @if (session('aulaCreada')!=NULL)
                <script>
                    Swal.fire(
                            'Aula Creada!',
                            'Se Ha Abierto El Aula.',
                            'Éxito'
                            )
                </script>
            @endif
            @if (session('aceptadoDoc')!=NULL)
                <script>
                    Swal.fire(
                            'Guardado!',
                            'El Documento Ha Sido Aceptado Con Éxito.',
                            'Éxito'
                            )
                </script>
            @endif
            @if (session('calificacion')!=NULL)
                <script>
                    Swal.fire(
                            'Guardada!',
                            'La Calificación Se Ha Guardado.',
                            'Éxito'
                            )
                </script>
            @endif

            @if (session('actuCalificacion')!=NULL)
                <script>
                    Swal.fire(
                            'Actualizado!',
                            'La Calificación Se Ha Actualizado.',
                            'Éxito'
                            )
                </script>
            @endif
            @if (session('error')!=NULL)
                <script>
                    Swal.fire(
                            'ERROR',
                            'Ya Existe Un Aula Abierta Con El Proceso y Maestro Elejido!',
                            'Éxito'
                            )
                </script>
            @endif

    <script>




        // $('.formulario-aviso').submit(function(e){
        //     e.preventDefault();

        //     Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes, delete it!'
        //     }).then((result)  {

        //     if (result.value) {
        //         // Swal.fire(
        //         // 'Deleted!',
        //         // 'Your file has been deleted.',
        //         // 'success'
        //         // )

        //         // document.getElementById('estadoDeseado').value = value;

        //         this.submit();
                
                
        //     }

        //     });    


        // });



    </script>
@yield('scriptsEnd')