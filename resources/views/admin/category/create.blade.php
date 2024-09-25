@extends('admin.master-layout')
@section('content')
<div class="d-flex justify-content-start align-items-center">
    <a href="{{ route('admin.categories') }}" class="btn btn-primary mx-3">Categories</a>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create</a>
</div>
<div class="progress-bar" style="background: white;" >
    <form class="progress-bar d-flex flex-column justify-content-start align-items-start p-3" 
        style="width: 50%" method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <h4 class="text-start text-capitalize">Create Category</h4>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
          <label for="catname" class="form-label">Category name</label>
          <input name='name' required type="text" class="form-control" id="catname" aria-describedby="catHelp">
          <div id="catHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
            <label for="cat_parent" class="form-label">Parent Category</label>
            <select name='parent_id' class="form-select z-100 text-dark" id="cat_parent" aria-label="Select parent categories">
                <option value="{{Null}}">Null</option>
                @foreach ($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->categories_name}}</option>
                @endforeach
            </select>
            <div id="emailHelp" class="form-text">Choose the parent category if this not a parent node.</div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection