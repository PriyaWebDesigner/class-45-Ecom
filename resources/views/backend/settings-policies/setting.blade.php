@extends('backend.master')

@section('content')
<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" class="form-control">
        @csrf
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Add New Category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Category Name*</label>
                            <input type="text" name="name" value="" class="form-control"
                                placeholder="Enter category name*" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file" accept="image/*" name="image" value="" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" value="Submit" class="form-control btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection