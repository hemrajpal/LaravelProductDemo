@extends('admin-layout')
  
@section('admin-content')
<div class="container">
    <form class="form-horizontal" method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @csrf
        <fieldset>

        <!-- Form Name -->
        <legend>Create Category</legend>

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

        <!-- Select Basic -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="category">Status</label>
        <div class="col-md-4">
            <select id="status" name="status" class="form-control">
            <option value="yes">Enable</option>
            <option value="no">Disable</option>
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
@endsection