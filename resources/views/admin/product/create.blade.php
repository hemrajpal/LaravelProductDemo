@extends('admin-layout')
  
@section('admin-content')
<div class="container">
    <form class="form-horizontal" method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf
        <fieldset>

        <!-- Form Name -->
        <legend>Create Product</legend>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="name">Name</label>  
        <div class="col-md-5">
        <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="" value="{{old('name')}}">
            
        </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="price">Price</label>  
        <div class="col-md-4">
        <input id="price" name="price" type="text" placeholder="" class="form-control input-md" required="" value="{{old('price')}}">
            
        </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="description">Description</label>
        <div class="col-md-8">                     
            <textarea class="form-control ckeditor" id="description" name="description">{{old('description')}}</textarea>
        </div>
        </div>

        <!-- File Button --> 
        <div class="form-group">
        <label class="col-md-4 control-label" for="photo">Photo</label>
        <div class="col-md-4">
            <input id="photo" name="photo" class="input-file" type="file">
        </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="category">Category</label>
        <div class="col-md-4">
            <select id="category" name="category" class="form-control">
            @foreach ($categories as $citem)
                <option value="{{$citem->id}}">{{$citem->name}}</option>
            @endforeach
            </select>
        </div>
        </div>

        <!-- Button -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-4">
            <button id="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>

        </fieldset>
    </form>

</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        
    });
</script>
@endsection