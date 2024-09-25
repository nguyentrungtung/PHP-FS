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
        style="width: 50%" method="POST" enctype="multipart/form-data" action="{{ route('admin.brands.update',['id'=>$brand->id])}}">
        @csrf
        @method('PUT')
        <h4 class="text-start text-capitalize">Create Brand</h4>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
          <label for="brand_name" class="form-label">Brand name</label>
          <input disabled value="{{$brand->brand_name}}" name='name' required type="text" class="form-control mb-3 form_input" id="brand_name" aria-describedby="catHelp">
        </div>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
            <label for="brand_logo_name" class="form-label">Brand logo name</label>
            <input value="{{pathinfo($brand->brand_logo, PATHINFO_FILENAME)}}" disabled name='logo_name' type="text" class="form-control mb-1 form_input" id="brand_logo_name" aria-describedby="catHelp">
            <div id="emailHelp" class="form-text">Change the default logo name to save. (Default is brand name)</div>
        </div>
        <div class="d-flex justify-content-start align-items-center mb-1">
            <div class="d-flex justify-content-start align-items-start flex-column">
                <label for="brand_logo" class="form-label">Brand Logo</label>
                <input disabled accept="image/*" name="logo" id="brand_logo" type="file" class="form-control form_input" id="inputGroupFile01">
                <div id="emailHelp" class="form-text">Choose the file brand logo to upload.</div>
            </div>
            <img style="width: 80px; object-fit: fill;" id="logoPreview" src="{{asset($brand->brand_logo)}}" alt="">
            <input type="hidden" name="current_logo" value="{{ $brand->brand_logo }}">
          </div>
        <button id="save" type="submit"  class="btn btn-success d-none">Save</button>
    </form>
    <div class="d-flex justify-content-start align-items-center mt-2">
        <button id="cancel" class="btn btn-secondary mx-1 d-none">Cancel</button>
        <button id="change" class="btn btn-primary mx-1">Change</button>
        <button onclick="confirmDelete({{ $brand->id }})" id="delete"  class="btn btn-danger mx-1">Delete</button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded',()=>{
        const inputs = document.querySelectorAll('.form_input');
        const save=document.getElementById('save');
        const cancel=document.getElementById('cancel');
        const change=document.getElementById('change');
        // 
        change.addEventListener('click',()=>{
            inputs.forEach(input => {
                input.disabled = false; // Hoặc input.removeAttribute('disabled');
            });
            cancel.classList.remove('d-none');
            save.classList.remove('d-none');
            change.classList.add('d-none');                                                   
        })
        cancel.addEventListener('click',()=>{
            inputs.forEach(input => {
                input.disabled = true; // Hoặc input.removeAttribute('disabled');
            });
            cancel.classList.add('d-none');
            save.classList.add('d-none');
            change.classList.remove('d-none');
        })
    })
    // 
    
    function confirmDelete(id) {
        // Hiển thị hộp thoại xác nhận
        if (confirm('Are you sure you want to delete this brand?')) {
            $.ajax({
                url: '{{ url("admin/brands/delete") }}/' + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}' // Thêm CSRF token
                },
                success: function(result) {
                    // Nếu xóa thành công, làm mới trang hoặc xử lý kết quả
                    setTimeout(function() {
                        window.location.href = '{{url("admin/brands")}}'; // Reload trang
                    }, 500);
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu có
                    alert('Error deleting brand.');
                }
            });
        }
    }
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