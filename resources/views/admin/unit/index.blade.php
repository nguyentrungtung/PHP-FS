@extends('admin.master-layout')
@section('content')
<h4 class="text-start text-capitalize">Units index</h4>
<div class="d-flex justify-content-start align-items-center">
  <a href="{{ route('admin.units') }}" class="btn btn-primary mx-3">Units</a>
  <a href="{{ route('admin.units.create') }}" class="btn btn-primary">Create</a>
</div>
<div style="background: white" >
    <table class="table table-striped-columns table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Unit name</th>
            <th scope="col">Create at</th>
            <th scope="col">Update at</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($units as $unit)
            <tr style="height: 30px;">
              <th scope="row">{{$unit->id}}</th>
              <td>{{$unit->unit_name}}</td>
              <td>{{$unit->create_at}}</td>
              <td>{{$unit->update_at}}</td>
              <td>
                <div class="d-flex justify-content-evenly align-items-center">
                  <button onclick="confirmDelete({{ $unit->id }})" class="btn btn-danger">Delete</button>
                  <a href="{{ route('admin.units.edit',['id'=>$unit->id]) }}" class="btn btn-primary">Detail</a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
<div class="d-flex align-items-center justify-content-center">
  {{ $units->links('pagination::bootstrap-4') }}
</div>
<script>
  // 
  function confirmDelete(id) {
      // Hiển thị hộp thoại xác nhận
      if (confirm('Are you sure you want to delete this unit?')) {
          $.ajax({
              url: '{{ url("admin/units/delete") }}/' + id,
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
                  alert('Error deleting unit.');
              }
          });
      }
  }
</script>
@endsection