@extends('admin.master-layout')
@section('content')
<h4 class="text-start text-capitalize">Categories index</h4>
<div class="d-flex justify-content-start align-items-center">
  <a href="{{ route('admin.categories') }}" class="btn btn-primary mx-3">Categories</a>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create</a>
</div>
<div style="background: white" >
    <table class="table table-striped-columns table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Category name</th>
            <th scope="col">Category parent ID</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cats as $cat)
            <tr style="height: 30px;">
              <th scope="row">{{$cat->id}}</th>
              <td>{{$cat->categories_name}}</td>
              <td style="width: 30px;" >{{$cat->categories_parent_id}}</td>
              <td>
                <div class="d-flex justify-content-evenly align-items-center">
                  <button onclick="confirmDelete({{ $cat->id }})" class="btn btn-danger">Delete</button>
                  <a href="{{ route('admin.categories.edit',['id'=>$cat->id]) }}" class="btn btn-primary">Detail</a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
<div class="d-flex align-items-center justify-content-center">
  {{ $cats->links('pagination::bootstrap-4') }}
</div>
<script>
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
                  window.location.reload(); // Làm mới trang
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