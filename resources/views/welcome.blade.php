<!DOCTYPE html>
<html>
    <head>
       <title>Laravel 8|7 Datatables</title>
       <meta name="csrf-token" content="{{ csrf_token() }}"> 
       <link rel="stylesheet" href="https://cdnj.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
       <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
       <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>
    <body>
       
       <div class="container mt-5">
        <h2 class="mb-4">Laravel 8 | Datatables</h2>
        <p style="display:flex; justify-content: flex-end">
        <a href="{{ url('pdfalumnos/') }}">PDF-Alumnos</a>
        <a href="{{ url('export/')}}">Excel-Alumnos</a>
        </p>
        <a href="javascript:void(0)" id="createNewCustomer" class="btn btn-success">Crear Nuevo Alumno</a>
        <hr>
        <!-- ---------------------DataTable--------------------------------- -->
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Genero</th>
                    <th>Fecha de Nacimiento</th>
                    <th>E-Mail</th>
                    <th width="280px">Otros</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <br><hr>
        <h3>Excel | Formulario de Importacion</h3>
        <form action="{{ route('import')}}" method="post" enctype="multipart/form-data" name="excelimport">
        @csrf
        <input type="file" name="file" class="form-control" id="" required>
        <button class="btn btn-success">Importacion de Archivo Excel (.csv)</button>
        </form>
       </div>
    <!-- ---------------------Modal: Form-Inicio--------------------------------- -->
            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h4 class="modal-title" id="modelHeading"></h4></div>
                            <div class="modal-body">
                                <form  id="CustomerForm" name="CustomerForm" class="form-horizontal">
                                    <input type="hidden" name="Customer_id" id="Customer_id">

                                        <div class="form-group">
                                            <label for="matricula" class="col-sm-2 control-label">Matricula</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="matricula" name="matricula" placeholder="" value="" maxlenght="12">
                                                
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="" maxlenght="30">
                                                
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="app" name="app" placeholder="" value="" maxlenght="30">
                                                
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fn" class="col-sm-2 control-label">FechaN.</label>
                                                <div class="col-sm-12">
                                                    <input type="date" class="form-control" id="fn" name="fn" placeholder="" value="" maxlenght="10">
                                                
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Genero</label>
                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="gen" id="gen" value="Femenino" checked>
                                                        <label class="form-check-label" for="gen">Femenino</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="gen" id="gen" value="Masculino">
                                                        <label class="form-check-label" for="gen">Masculino</label>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">E-Mail</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="" value="" maxlenght="">
                                                
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="pass" class="col-sm-2 control-label">Contraseña</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="pass" name="pass" placeholder="" value="" maxlenght="">
                                                
                                                </div>
                                        </div>

                                        <div class="col-sm-offet-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar Cambios</button>
                                        </div>
                                 </form>
                            </div>
                    </div>
                </div>
            </div>



    <!-- ---------------------Modal: Form-Fin------------------------------------ -->

    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'matricula', name: 'matricula'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'app', name: 'app'},
                    {data: 'gen', name: 'gen'},
                    {data: 'fn', name: 'fn'},
                    {data: 'email', name: 'email'},
                    {data: 'otros', name: 'otros', orderable: false, searchable: false},
                ]
            });
            // -------------------Nuevo-----------------------------------------------------------
            $('#createNewCustomer').click(function (){
                $("#saveBtn").val("create-Customer");
                $("#Customer_id").val("");
                $("#CustomerForm").trigger("reset");
                $("#modelHeading").html("Crear Nuevo Customer");
                $("#ajaxModel").modal("show");
            });

            $('body').on('click','.editCustomer', function(){
                var id = $(this).data('id');
                $.get("editar/" + id, function(data){
                    $('#modelHeading').html("Editar Customer");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal("show");
                    $('#Customer_id').val(data.id);
                    $('#matricula').val(data.matricula);
                    $('#nombre').val(data.nombre);
                    $('#app').val(data.app);
                    $('#fn').val(data.fn);
                    $('#email').val(data.email);
                    $('#pass').val(data.pass);
                })
            });

            $("#saveBtn").click(function (e){
                e.preventDefault();
                $(this).html('Enviar');
                $.ajax({
                    data: $('#CustomerForm').serialize(),
                    url: "{{ route('store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data){
                        $('#CustomerForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                    },
                    error: function(data){
                        console.log('Error:', data);
                        $('#saveBtn').html('Guardar Cambios');
                    }
                });
            }); 
            // -----------------Delete-----------------------------------------
            $('body').on('click', '.deleteCustomer', function(){
                var id = $(this).data("id");
                if(confirm("Estas seguro de querer borrar el registro??")){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('destroy')}}"+'/'+id,
                        success: function(data){
                            table.draw();
                        },
                        error: function(data){
                            console.log('Error:', data);
                        }
                    });
                }
                else{}
            });
        });
    </script>
</html>
