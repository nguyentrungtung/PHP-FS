<?php 
    
    echo "<div style=\"width:525px;\" class=\"row g-3\">";
    if($check){
        echo "<form action=\"".__Base_Uri."?cat=students&view=update&id=".$data['id']."\" class=\"needs-validation\" method=\"POST\">";
    }
    echo "<div class=\"input-group mb-3\">
        <span class=\"input-group-text\">Student ID</span>
        <input id=\"student_id\" readonly disabled  required type=\"text\" name=\"student_id\"  class=\"form-control\" value=\"".($data['id'])."\" aria-label=\"student_id\">
    </div>
    <div class=\"input-group mb-3\">
        <span class=\"input-group-text\">First and last name</span>
        <input ".($check?"":"readonly disabled")."  required name=\"first_name\" type=\"text\" value=\"".($data['first_name'])."\"  aria-label=\"First name\" class=\"form-control\">
        <input ".($check?"":"readonly disabled")."  required name=\"last_name\" type=\"text\" value=\"".($data['last_name'])."\" aria-label=\"Last name\" class=\"form-control\">
    </div>
    <div class=\"input-group mb-3\">
        <span class=\"input-group-text\">Date of Birth</span>
        <input ".($check?"":"readonly disabled")."  required name=\"date_of_birth\" type=\"text\" class=\"form-control\" value=\"".($data['date_of_birth'])."\" aria-label=\"date_of_birth\">
    </div>
    <div class=\"input-group mb-3\">
        <span class=\"input-group-text\">Phone Number</span>
        <input ".($check?"":"readonly disabled")."  required name=\"phone_number\" type=\"text\" class=\"form-control\" value=\"".($data['phone_number'])."\" aria-label=\"phone_number\">
    </div>
    <div class=\"input-group mb-3\">
        <span class=\"input-group-text\">GPA</span>
        <input ".($check?"":"readonly disabled")."  required name=\"gpa\" type=\"text\" class=\"form-control\" value=\"".($data['gpa'])."\" aria-label=\"gpa\">
    </div>
    <div class=\"input-group mb-3\">
        <span class=\"input-group-text\">Address</span>
        <textarea ".($check?"":"readonly disabled")." required name=\"address\" class=\"form-control\" aria-label=\"With textarea\">".($data['address'])."</textarea>
    </div>
    <div class=\"d-grid gap-".($check?"3":"2")." d-md-flex justify-content-md-start\">
        ".($check?"<a href=\"".__Base_Uri."?cat=students&view=detail&id=".$data['id']."\" class=\"btn btn-primary btn-sm\">Cancel</a>":"")."
        ".(!$check?"<a href=\"".__Base_Uri."?cat=students&view=change&id=".$data['id']."\" class=\"btn  btn-success btn-sm\">Change</a>":"")."
        ".($check?"<button type=\"submit\"  class=\"btn  btn-success btn-sm\">Update</button>":"")."
        <a onClick=\"deleteKey(".$data['id'].")\" id=\"delete\" class=\"btn btn-danger btn-sm ms-3\">Delete</a> 
    </div>";
    if($check){
        echo "</form>";
    }               
echo "</div>";
?>
