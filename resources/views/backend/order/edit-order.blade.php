@extends('backend.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Order</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{url('admi/order-update/'.$order->id)}}" method="POST" enctype="multipart/form-data" class="form-control">
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Order</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Invoice Number</label>
                                        <input type="text" name="invoiceId" value="{{$order->invoiceId}}" class="form-control" readonly>
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" name="c_name" value="{{$order->c_name}}" class="form-control" required>
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Phone</label>
                                        <input type="text" name="c_phone" value="{{$order->c_phone}}" class="form-control" required>
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Address</label>
                                        <textarea name="address" class="form-control" required>{{$order->address}}</textarea>
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Delivery Charge</label>
                                        <input type="text" name="area" value="{{$order->area}}" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Courier</label>
                                        <select name="courier_name" class="form-control">
                                            <option value="steadfast">Steadfast</option>
                                            <option value="redx">REDX</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                
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
        <!-- /.card-body -->
    </div>
@endsection

