@extends('admin.master-layout')
@section('content')
<h4 class="text-start text-capitalize">Brands index</h4>
<div class="d-flex justify-content-start align-items-center">
  <a href="{{ route('admin.brands') }}" class="btn btn-primary mx-3">Brands</a>
  <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Create</a>
</div>
<div style="background: white" >
    <table class="table table-striped-columns table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Brand name</th>
            <th scope="col">Brand logo</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($brands as $brand)
            <tr style="height: 30px;">
              <th scope="row">{{$brand->id}}</th>
              <td>{{$brand->brand_name}}</td>
              <td><img style="width: 80px;
                        object-fit: fill;" src="{{asset($brand->brand_logo)}}" alt=""></td>
              <td>
                <div class="d-flex justify-content-evenly align-items-center">
                  <button onclick="confirmDelete({{ $brand->id }})" class="btn btn-danger">Delete</button>
                  <a href="{{ route('admin.brands.edit',['id'=>$brand->id]) }}" class="btn btn-primary">Detail</a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
<div class="d-flex align-items-center justify-content-center">
  {{ $brands->links('pagination::bootstrap-4') }}
</div>
<script>
  // 
  function confirmDelete(id) {
      // Hiển thị hộp thoại xác nhận
      if (confirm('Are you sure you want to delete this category?')) {
          $.ajax({
              url: '{{ url("admin/brands/delete") }}/' + id,
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