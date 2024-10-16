@extends('admin.layouts.app')

@section('title','Post Manager')

@section('content')
<h4>Thêm bài viết:</h4>
<form action="{{route('admin.post.store')}}" method="post">
    @csrf
    @method('post')
    <div class="form-group">
        <label for="Name">Name:</label>
        <input type="text" class="form-control" id="Name" name="name" placeholder="Name..." >
    </div>
    <div class="form-group">
        <label for="Content">Content:</label>
        <input type="text" class="form-control" id="Content" name="content" placeholder="Content..." >
    </div>
    <div class="form-group">
        <label for="Author">Author:</label>
        <input type="text" class="form-control" id="Author" name="author" placeholder="Author...">
    </div>
    <div class="form-group">
        <label for="Description">Categories:</label>
        <select class="form-control" name="detail_id" id="Detail_id">
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option> 
            
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="Image">Image:</label>
        <input type="file" class="form-control" id="Image" name="image" placeholder="Image...">
      </div>
    <button type="submit" class="btn btn-default">Add</button>
</form>
@endsection