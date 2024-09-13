<div style="width:525px;" class="justify-content-sm-center">
    <form action="<?php echo __Add_Uri ?>" class="row g-3 needs-validation" method="POST">
        <div class="input-group mb-3">
            <span class="input-group-text">Student ID</span>
            <input id="student-id" required type="text" name="student_id" class="form-control" placeholder="00000000" aria-label="student_id">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">First and last name</span>
            <input required name="first_name" type="text" aria-label="First name" class="form-control">
            <input required name="last_name" type="text" aria-label="Last name" class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Date of Birth</span>
            <input required name="date_of_birth" type="text" class="form-control" placeholder="YYYY/MM/DD" aria-label="date_of_birth">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Phone Number</span>
            <input required name="phone_number" type="text" class="form-control" placeholder="+84 0*********" aria-label="phone_number">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">GPA</span>
            <input required name="gpa" type="text" class="form-control" placeholder="GPA" aria-label="gpa">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Address</span>
            <textarea required name="address" class="form-control" aria-label="With textarea"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>                         
</div>
