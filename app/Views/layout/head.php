<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phrases1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Optional JavaScript và các thư viện phụ trợ -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./public/main.js"></script>
</head>
<style>
    body{
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        color: #343a40;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
    }
</style>
<body>
  
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
        <?php
            echo "
              <li class=\"nav-item ".($method==='index'?'active':'')."\">
                  <a class=\"nav-link\" href=\"".__Base_Uri."?cat=".$name."&view=index&page=1\">Home <span class=\"sr-only\">(current)</span></a>
                </li>
                <li class=\"nav-item ".($method==='create'?'active':'')."\">
                  <a class=\"nav-link\" href=\"".__Base_Uri."?cat=".$name."&view=create\">Create <span class=\"sr-only\">(current)</span></a>
                </li>
                <li class=\"nav-item ".($name==='students'?'active':'')."\">
                  <a class=\"nav-link\" href=\"".__Base_Uri."?cat=students&view=index&page=1\">Students <span class=\"sr-only\">(current)</span></a>
                </li>
                <li class=\"nav-item ".($name==='_students'?'active':'')."\">
                  <a class=\"nav-link\" href=\"".__Base_Uri."?cat=_students&view=index&page=1\">_Students<span class=\"sr-only\">(current)</span></a>
                </li>
                
            ";
          ?>
        </ul>

        <?php
        echo "<p style=\"color: #a3a5a6;
    font-size: 14px;\" >".($name==='_students'?'Using core model':'Using model Eloquent ORM')."</p>";
          echo "
                <div style=\"width:550px;\" class=\"input-group \">
                <input id=\"hide_name\" value=\"$name\" type=\"hidden\"/>
                <input type=\"text\" class=\"form-control\" id=\"search\" placeholder=\"Searching id, name or date of birth of ".$name."\" aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                <button  class=\"btn btn-outline-secondary\"  type=\"submit\" id=\"search-btn\">Search</button>
              </div>"
        ?>
      </div>
    </nav>
    <hr class="border border-primary border-3 opacity-75">