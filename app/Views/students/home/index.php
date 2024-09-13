<div class="d-flex flex-column align-items-center py-3 justify-content-center">
    <table class="table table-sm table-bordered table-hover" style="font-size: 14px;">
      <thead>
        <tr>
          <th scope="col">Student ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Date of Birth</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <?php 
            foreach ($data as $row){
                echo "<tr>
                 <td>".$row['id']."</td>
                 <td>".$row['first_name']."</td>
                 <td>".$row['last_name']."</td>
                 <td>".$row['date_of_birth']."</td>
                 <td style=\"width:250px\" >
                    <a class=\" btn btn-primary link\" href=\"".__Base_Uri."?cat=students&view=detail&id=".$row['id']."\" >Detail</a>
                    <a id=\"delete\" onClick=\"deleteKey(".$row['id'].")\" class=\" btn btn-danger link\"  >Delete</a>
                  </td>
                 </tr>";
            }
        ?>
      </tbody>
    </table>
</div>
<!--  -->