@extends('admin_layout.admin')
 
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Add product</h3>
              </div>
              
              @if(Session::has('status'))
            <div class='alert alert-success'>
             {{   Session::get('status');}}
            </div>
          
                
              @endif


              @if(count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $errors)
                  <li>{{ $errors }}</li>    
                  @endforeach
                </ul>
              </div>
              @endif
          

              <!-- /.card-header -->
              <!-- form start -->
                {{--  <form id="quickForm"> --}}
              {!!Form::open(['action' => 'App\Http\Controllers\ProductController@saveproduct', 'method' => 'POST','class'=>'form-group',
              'enctype'=>'multipart/form-data'])!!}
              {{ csrf_field() }}

           
                <div class="card-body">
               <div class="form-group">
                   
                    {{Form::label('', 'Product name', ['for'=>'exampleInputEmail1' ])}}
                    {{Form::text('product_name', '', ['class' => 'form-control', 'placeholder' => 'Enter product name','id'=>'exampleInputEmail1'])}}

                    {{--<label for="exampleInputEmail1">Product name</label>  --}}
                    {{-- <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name">--}}                
                
                  </div>
                  <div class="form-group">
                    {{Form::label('', 'Product price', ['for'=>'exampleInputEmail1' ])}}
                    {{Form::text('product_price', '', ['class' => 'form-control', 'placeholder' => 'Enter product price','id'=>'exampleInputEmail1', 'min'=>'1'])}}
 
                   {{-- <label for="exampleInputEmail1">Product price</label> --}} 
                   {{-- <input type="number" name="product_price" class="form-control" id="exampleInputEmail1" placeholder=Enter product price" min="1"> --}}                 
                   </div>

                  <div class="form-group">
              {{Form::select('product_category',$categories,null,['placeholder' => 'Select Product category', 'class'=>'form-control select2'])}}
                    
                  
                    {{-- <label>Product category</label> 
                    {{Form::label('', 'Product category')}}
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">Fruit</option>
                      <option>Juice</option>
                      <option>Vegetable</option>
                    </select>--}} 
                  </div>
                  {{Form::label('', 'Product image', ['for'=>'exampleInputEmail1' ])}}
                 {{-- <label for="exampleInputFile">Product image</label> --}} 
                  <div class="input-group">
                    <div class="custom-file">
                      {{Form::file('product_image',['class'=>'custom-file-input', 'id'=>'exampleInputFile', 'placeholder' => 'Product image'])}}
                
                      {{Form::label('', 'Choose file', ['for'=>'exampleInputFile','class'=>'custom-file-label' ])}}
                       
                        
                    {{--   <input type="file" class="custom-file-input" id="exampleInputFile">
                      
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}
                   
                        </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                 {{--<input type="submit" class="btn btn-success" value="Save">  --}} 
                  {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
                </div>
                {{-- </form> --}}
              
              {!!Form::close()!!}
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('scripts')
<!-- jquery-validation -->
<script src="backend/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="backend/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="backend/dist/js/adminlte.min.js"></script>
 
<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection