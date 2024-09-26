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
    <a href="{{ route('admin.customers') }}" class="btn btn-primary mx-3">Customers</a>
    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">Create</a>
</div>
<div class="progress-bar" style="background: white;" >
    <form class=" d-flex flex-column justify-content-start align-items-start p-3"  method="POST" action="{{route('admin.customers.store')}}">
        @csrf
        <h4 class="text-start text-capitalize">Create Customer</h4>
        <div class="d-flex flex-wrap justify-content-start align-items-start">
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
              <label for="catname" class="form-label">Customer name</label>
              <input name='customer_name' required type="text" class="form-control" id="catname" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="emailname" class="form-label">Customer email</label>
                <input name='customer_email' required type="text" class="form-control" id="emailname" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="phone" class="form-label">Customer phone</label>
                <input name='customer_phone' required type="text" class="form-control" id="phone" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="gender" class="form-label">Customer gender</label>
                <div class="d-flex justify-content start align-items-start">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="customer_gender" type="radio" id="inlineradio1" value="male">
                        <label class="form-check-label" for="inlineradio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="customer_gender" type="radio" id="inlineradio2" value="female">
                        <label class="form-check-label" for="inlineCheckbox2">Female</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="dob" class="form-label">Customer date of birth</label>
                <input name='date_of_birth' required type="date" class="form-control" id="dob" aria-describedby="catHelp">
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="country" class="form-label">Customer country</label>
                <select style="width:200px;" name='country' class="form-select z-100 text-dark" id="country" aria-label="Select parent categories">
                    <option value="{{Null}}">Null</option>
                    <option value="Việt Nam">Việt Nam</option>
                </select>
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="city" class="form-label">Customer city</label>
                <select style="width:200px;" disabled name='city' class="form-select z-100 text-dark" id="city" aria-label="Select parent categories">
                    <option value="{{Null}}">Null</option>
                    <option value="Hà Nội">Hà Nội</option>
                </select>
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="state" class="form-label">Customer state</label>
                <select style="width:200px;" disabled name='state' class="form-select z-100 text-dark" id="state" aria-label="Select parent categories">
                    <option value="{{Null}}">Null</option>
                    <option value=" Hoàng Mai">Hoàng Mai</option>
                </select>
            </div>
            <div class="d-flex justify-content-start align-items-start flex-column mb-1 me-3 ">
                <label for="password" class="form-label">Customer state</label>
                <div class="d-flex justify-content-start align-items-center">
                    <input name='password' required type="password" class="form-control me-3" id="password" aria-describedby="catHelp">
                    <svg onclick="togglePassword()" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                      </svg>
                </div>
                
            </div>
        </div>
        <div class="d-flex justify-content-start align-items-start flex-column mb-3 me-3 ">
            <label for="catname" class="form-label">Customer name</label>
            <textarea name='address' style="width:400px;height:200px" required  class="form-control" id="catname" aria-describedby="catHelp"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded',()=>{
    const country=document.getElementById('country');
    const city=document.getElementById('city');
    const state=document.getElementById('state');
    // 
    country.addEventListener('change',(e)=>{
        if(e.target.value!==''){
            city.disabled=false;
        }else{
            city.disabled=true;
            city.value='';
            state.value='';
            state.disabled=true;
        }
    });
    city.addEventListener('change',(e)=>{
        if(e.target.value!==''){
            state.disabled=false;
        }else{
            state.value='';
            state.disabled=true;
        }
    })
})
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
}
</script>
@endsection