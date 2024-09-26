@extends('admin.master-layout')
@section('content')
<div class="d-flex justify-content-start align-items-center">
    <a href="{{ route('admin.categories') }}" class="btn btn-primary mx-3">Categories</a>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create</a>
</div>
<div class="progress-bar" style="background: white;" >
    <form id="form" class="progress-bar d-flex flex-column justify-content-start align-items-start p-3" 
        style="width: 50%" method="POST" action="{{ route('admin.categories.update',['id'=>$cat->id]) }}">
        @csrf
        @method('PUT')
        <h4 class="text-start text-capitalize">Category Detail</h4>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
          <label for="catname" class="form-label">Category name</label>
          <input disabled value="{{$cat->categories_name}}" name='name' required type="text" class="form-control form_input" id="catname" aria-describedby="catHelp">
          <div id="catHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
            <label for="cat_parent" class="form-label">Parent Category</label>
            <select disabled name='parent_id' value="{{$cat->categories_parent_id}}"  class="form-select z-100 text-dark form_input" id="cat_parent" aria-label="Select parent categories">
                <option value="{{Null}}">Null</option>
                @foreach ($cats as $parent)
                    <option value="{{ $parent->id }}" 
                        {{ $parent->id == $cat->categories_parent_id ? 'selected' : '' }}>
                        {{ $parent->categories_name}}
                    </option>
                @endforeach
            </select>
            <div id="emailHelp" class="form-text">Choose the parent category if this not a parent node.</div>
        </div>
        <button id="save" type="submit"  class="btn btn-success d-none">Save</button>
    </form>
    <div class="d-flex justify-content-start align-items-center mt-2">
        <button id="cancel" class="btn btn-secondary mx-1 d-none">Cancel</button>
        <button id="change" class="btn btn-primary mx-1">Change</button>
        <button onclick="confirmDelete({{ $cat->id }})" id="delete"  class="btn btn-danger mx-1">Delete</button>
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
        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                url: '{{ url("admin/categories/delete") }}/' + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}' // Thêm CSRF token
                },
                success: function(result) {
                    // Nếu xóa thành công, làm mới trang hoặc xử lý kết quả
                    setTimeout(function() {
                        window.location.href = '{{url("admin/categories")}}'; // Reload trang
                    }, 500);
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu có
                    alert('Error deleting category.');
                }
            });
        }
    }
</script>
@endsection