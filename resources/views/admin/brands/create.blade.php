@extends('admin.master-layout')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="d-flex justify-content-start align-items-center">
    <a href="{{ route('admin.brands') }}" class="btn btn-primary mx-3">Brands</a>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Create</a>
</div>
<div class="progress-bar" style="background: white;" >
    <form class="progress-bar d-flex flex-column justify-content-start align-items-start p-3" 
        style="width: 50%" method="POST" enctype="multipart/form-data" action="{{ route('admin.brands.store') }}">
        @csrf
        <h4 class="text-start text-capitalize">Create Brand</h4>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
          <label for="brand_name" class="form-label">Brand name</label>
          <input name='name' required type="text" class="form-control mb-3" id="brand_name" aria-describedby="catHelp">
        </div>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
            <label for="brand_logo_name" class="form-label">Brand logo name</label>
            <input name='logo_name' type="text" class="form-control mb-1" id="brand_logo_name" aria-describedby="catHelp">
            <div id="emailHelp" class="form-text">Change the default logo name to save. (Default is brand name)</div>
        </div>
        <div class="d-flex justify-content-start align-items-center mb-1">
            <div class="d-flex justify-content-start align-items-start flex-column">
                <label for="brand_logo" class="form-label">Brand Logo</label>
                <input accept="image/*" name="logo" id="brand_logo" type="file" class="form-control" id="inputGroupFile01">
                <div id="emailHelp" class="form-text">Choose the file brand logo to upload.</div>
            </div>
            <img style="width: 80px; object-fit: fill;" id="logoPreview" src="" alt="">
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    document.getElementById('brand_logo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('logoPreview');
    
        if (file) {
            const reader = new FileReader();
    
            reader.onload = function(e) {
                preview.src = e.target.result; // Set the source of the preview image
                preview.style.display = 'block'; // Make the preview visible
            };
    
            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            preview.src = ''; // Clear the preview if no file is selected
            preview.style.display = 'none'; // Hide the preview
        }
    });
    </script>
@endsection