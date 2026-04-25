
<div class="container-fluid">
    <form method="post" action="{{route('admin.category.delete', ['id' => $category->id])}}">
        <p>Are you sure you want to delete this record??</p>
        
        <button type="submit" class="btn btn-primary">Yes</button>
        <button class="btn btn-danger" data-dismiss="modal" type="button">No</button>
        @csrf
    </form>
</dib>