@extends('admin.master-layout')
@section('content')
<h4 class="text-start text-capitalize">Customers index</h4>
<div class="d-flex justify-content-start align-items-center">
  <a  class="btn btn-primary mx-3">Customers</a>
  <a  class="btn btn-primary">Create</a>
</div>
<div style="background: white" >
    <table class="table table-striped-columns table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Customer name</th>
            <th scope="col">Customer email</th>
            <th scope="col">Customer phone</th>
            <th scope="col">Customer gender</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($customers as $customer)
            <tr style="height: 30px;">
              <th scope="row">{{$customer->id}}</th>
              <td>{{$customer->customer_name}}</td>
              <td>{{$customer->customer_email}}</td>
              <td>{{$customer->customer_phone}}</td>
              <td>{{$customer->customer_gender}}</td>
              <td>{{$customer->date_of_birth}}</td>
              <td>
                <div class="d-flex justify-content-evenly align-items-center">
                  <button  class="btn btn-danger">Delete</button>
                  <a  class="btn btn-primary">Detail</a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
<div class="d-flex align-items-center justify-content-center">
  {{ $customers->links('pagination::bootstrap-4') }}
</div>
<script>
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
                  window.location.reload(); // Làm mới trang
              },
              error: function(xhr) {
                  // Xử lý lỗi nếu có
                  alert('Error deleting brand.');
              }
          });
      }
  }
</script>
@endsection