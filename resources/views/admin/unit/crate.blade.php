@extends('admin.master-layout')
@section('content')
<div class="d-flex justify-content-start align-items-center">
    <a href="{{ route('admin.units') }}" class="btn btn-primary mx-3">Units</a>
    <a href="{{ route('admin.units.create') }}" class="btn btn-primary">Create</a>
</div>
<div class="progress-bar" style="background: white;" >
    <form class="progress-bar d-flex flex-column justify-content-start align-items-start p-3" 
        style="width: 50%" method="POST" action="{{ route('admin.units.store') }}">
        @csrf
        <h4 class="text-start text-capitalize">Create Unit</h4>
        <div class="d-flex justify-content-start align-items-start flex-column mb-1 ">
          <label for="unitname" class="form-label">Unit name</label>
          <input name='name' required type="text" class="form-control" id="unitname" aria-describedby="catHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection