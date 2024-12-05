@extends('backend.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Order List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Invoice Number</th>
                        <th>Product</th>
                        <th>Customer Info</th>
                        <th>Courier Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>xy-4</td>
                    <td>
                      <img src="https://dummyimage.com/100x100/c43f82/fff" >
                      2 x Dell Kerbpard <br> <br>

                      <img src="https://dummyimage.com/100x100/c43f82/fff" >
                      2 x Smart Watch <br> <br>
                    </td>
                    <td>
                        Name: Developer Text <br>  
                        phone: 72585885 <br>
                        Address: Kolkata <br>
                    </td>
                    <td>Not Found</td>
                    <td>
                        <a href="#" class="btn btn-danger">Cancel</a>
                        <a href="#" class="btn btn-success">Confirm</a>
                        <a href="#" class="btn btn-info">Delivered</a>
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary">Edit</a>
                      <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>xy-4</td>
                    <td>
                      <img src="https://dummyimage.com/100x100/c43f82/fff" >
                      2 x Dell Kerbpard <br> <br>

                      <img src="https://dummyimage.com/100x100/c43f82/fff" >
                      2 x Smart Watch <br> <br>
                    </td>
                    <td>
                        Name: Developer Text <br>  
                        phone: 72585885 <br>
                        Address: Kolkata <br>
                    </td>
                    <td>Not Found</td>
                    <td>
                        <a href="#" class="btn btn-danger">Cancel</a>
                        <a href="#" class="btn btn-success">Confirm</a>
                        <a href="#" class="btn btn-info">Delivered</a>
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary">Edit</a>
                      <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
