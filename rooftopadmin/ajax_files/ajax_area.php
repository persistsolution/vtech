<?php 
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
include_once 'incuserdetails.php';
if($_POST['action'] == 'Add'){
$Name = addslashes(trim($_POST["Name"]));
$Status = $_POST["Status"];
$CountryId = $_POST["CountryId"];
$StateId = $_POST["StateId"];
$CityId = $_POST["CityId"];
$query = "SELECT * FROM tbl_area WHERE Name = '$Name' AND StateId='$StateId'";
$result = $conn->query($query);
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
  echo 0;
}
else{
$qx = "INSERT INTO tbl_area SET Name = '$Name',CountryId='1',StateId='$StateId',CityId='$CityId',Status='$Status'";
	$conn->query($qx);
	echo 1;
}
}

if($_POST['action'] == 'fetch_record'){
 $id = $_POST['id'];
    $query = "SELECT * FROM tbl_area WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo json_encode($row);


}

if($_POST['action'] == 'Edit') {
     $id = $_POST['id'];
$Name = addslashes(trim($_POST["Name"]));
$Status = $_POST["Status"];
$CountryId = $_POST["CountryId"];
$StateId = $_POST["StateId"];
$CityId = $_POST["CityId"];

$query = "SELECT * FROM tbl_area WHERE Name = '$Name' AND StateId='$StateId' AND id != '$id'";
$result = $conn->query($query);
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
  echo 0;
}
else{
  $query2 = "UPDATE tbl_area SET Name = '$Name',CountryId='1',StateId='$StateId',CityId='$CityId',Status='$Status' WHERE id = '$id'";
 	$conn->query($query2);
  echo 1;
}
}

  if($_POST['action'] == 'delete') {
   
      $id = $_POST['id'];
      $query = "DELETE FROM tbl_area WHERE id = '$id'";
      $conn->query($query);
      echo "Delete Successfully";

  }


  if($_POST['action']=='view'){?>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
              <th>#</th>
              <th>Country</th>
               <th>State</th>
                 <th>City</th>
                 <th>Area</th>
               <th>Status</th>
                <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
               <th>Action</th>
               <?php } ?>
            </tr>
        </thead>
        <tbody>
          <?php 
 $srno = 1;
  $sql = "SELECT ct.Name As City,c.Name As Country,s.Name As State,sb.* FROM tbl_area sb LEFT JOIN tbl_state s ON s.id=sb.StateId 
    LEFT JOIN tbl_country c ON c.id=sb.CountryId 
    LEFT JOIN tbl_city ct ON ct.id=sb.CityId ORDER BY sb.id DESC";
   $rx = $conn->query($sql);
  while($nx = $rx->fetch_assoc()){

  ?>
           <tr>
             <td><?php echo $srno; ?></td>
             <td><?php echo $nx['Country']; ?></td>
              <td><?php echo $nx['State']; ?></td>
                <td><?php echo $nx['City']; ?></td>
                <td><?php echo $nx['Name']; ?></td>
             <td><?php if($nx['Status']=='1'){echo "<span style='color:green;'>Active</span>";} else { echo "<span style='color:red;'>Inactive</span>";} ?></td>
             <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
             <td>
                   <?php if(in_array("10", $Options)){?>
                 <a data-id="<?php echo $nx['id']; ?>" href='javascript:void(0);' data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" class="update"><i class="lnr lnr-pencil mr-2"></i></a>&nbsp;&nbsp;
                  <?php } if(in_array("11", $Options)){?>
                 <a data-id="<?php echo $nx['id']; ?>" href='javascript:void(0);' data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete" class="delete" id="bootbox-confirm"><i class="lnr lnr-trash text-danger"></i></a>
                  <?php } ?>
             </td><?php } ?>
            </tr>
             <?php $srno++;} ?>
        </tbody>
    </table>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#example').DataTable( {
        responsive: true
      });
      });
    </script>
 <?php }
?>