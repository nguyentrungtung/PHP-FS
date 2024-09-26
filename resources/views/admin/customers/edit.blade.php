@extends('admin.master-layout')
@section('content')
<div class="d-flex justify-content-start align-items-center">
    <a href="{{ route('admin.customers') }}" class="btn btn-primary mx-3">Customers</a>
    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">Create</a>
</div>
<div class="progress-bar" style="background: white;" >
    <form id="form" class=" d-flex flex-column justify-content-start align-items-start p-3"  method="POST" action="{{ route('admin.customers.update',['id'=>$customer->id]) }}">
        @csrf
        @method('PUT')
        <h4 class="text-start text-capitalize">Customer Detail</h4>
        <div class="d-flex flex-wrap justify-content-start align-items-start">
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
              <label for="catname" class="form-label">Customer name</label>
              <input value="{{$customer->customer_name}}" disabled name='customer_name' required type="text" class="form-control form_input" id="catname" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="emailname" class="form-label">Customer email</label>
                <input value="{{$customer->customer_email}}" disabled name='customer_email' required type="text" class="form-control form_input" id="emailname" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="phone" class="form-label">Customer phone</label>
                <input value="{{$customer->customer_phone}}" disabled name='customer_phone' required type="text" class="form-control form_input" id="phone" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="gender" class="form-label">Customer gender</label>
                <div class="d-flex justify-content start align-items-start">
                    <div class="form-check form-check-inline">
                        <input  disabled class="form-check-input form_input" name="customer_gender" {{ 'male' === $customer->customer_gender? 'checked' : '' }} type="radio" id="inlineradio1" value="male">
                        <label class="form-check-label" for="inlineradio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input disabled class="form-check-input form_input" name="customer_gender" {{ 'female' === $customer->customer_gender? 'checked' : '' }}  type="radio" id="inlineradio2" value="female">
                        <label class="form-check-label" for="inlineCheckbox2">Female</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="dob" class="form-label">Customer date of birth</label>
                <input value="{{$customer->date_of_birth}}" disabled name='date_of_birth' required type="date" class="form-control form_input" id="dob" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="country" class="form-label">Customer country</label>
                <select disabled style="width:200px;" name='country' class="form-select form_input z-100 text-dark" id="country" aria-label="Select parent customers">
                    <option value="{{Null}}" {{ 'Hoàng Mai' === $customer->country ? 'selected' : '' }}>Null</option>
                    <option value="Việt Nam" {{ 'Việt Nam' === $customer->country ? 'selected' : '' }}>Việt Nam</option>
                </select>
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="city" class="form-label">Customer city</label>
                <select style="width:200px;" disabled name='city' class="form-select form_input z-100 text-dark" id="city" aria-label="Select parent customers">
                    <option value="{{Null}}" {{ '' === $customer->city ? 'selected' : '' }}>Null</option>
                    <option value="Hà Nội" {{ 'Hà Nội' === $customer->city ? 'selected' : '' }}>Hà Nội</option>
                </select>
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="state" class="form-label">Customer state</label>
                <select style="width:200px;" disabled name='state' class="form-select form_input z-100 text-dark" id="state" aria-label="Select parent customers">
                    <option value="{{Null}}" {{ '' === $customer->state ? 'selected' : '' }}>Null</option>
                    <option  value="Hoàng Mai" {{ 'Hoàng Mai' === $customer->state ? 'selected' : '' }}>Hoàng Mai</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-start align-items-start flex-column mb-3 me-3 ">
            <label for="catname" class="form-label">Customer name</label>
            <textarea disabled name='customer_address' style="width:400px;height:200px" required  class="form-control form_input" id="catname" aria-describedby="catHelp">{{$customer->customer_address}}</textarea>
        </div>
        <button id="save" type="submit"  class="btn btn-success d-none">Save</button>
    </form>
    <div class="d-flex justify-content-start align-items-center mt-2">
        <button id="cancel" class="btn btn-secondary mx-1 d-none">Cancel</button>
        <button id="change" class="btn btn-primary mx-1">Change</button>
        <button onclick="confirmDelete({{ $customer->id }})" id="delete"  class="btn btn-danger mx-1">Delete</button>
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
        if (confirm('Are you sure you want to delete this customer?')) {
            $.ajax({
                url: '{{ url("admin/customers/delete") }}/' + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}' // Thêm CSRF token
                },
                success: function(result) {
                    // Nếu xóa thành công, làm mới trang hoặc xử lý kết quả
                    setTimeout(function() {
                        window.location.href = '{{url("admin/customers")}}'; // Reload trang
                    }, 500);
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu có
                    alert('Error deleting customer.');
                }
            });
        }
    }
</script>
@endsection