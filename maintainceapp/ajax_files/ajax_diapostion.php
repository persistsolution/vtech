<?php 
session_start();
include_once '../config.php';
include_once 'incuserdetails.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'Add'){
$Name = addslashes(trim($_POST["Name"]));
$CatId = addslashes(trim($_POST["CatId"]));
$Color = addslashes(trim($_POST["Color"]));
$SrNo = addslashes(trim($_POST["SrNo"]));
$Negative = addslashes(trim($_POST["Negative"]));
$Status = $_POST["Status"];
$query = "SELECT * FROM tbl_diapostion WHERE CatId='$CatId' AND Name = '$Name'";
$result = $conn->query($query);
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
  echo 0;
}
else{
$qx = "INSERT INTO tbl_diapostion SET Name = '$Name',CatId='$CatId',Color='$Color',SrNo='$SrNo',Status='$Status',Negative='$Negative'";
	$conn->query($qx);
	echo 1;
}
}

if($_POST['action'] == 'fetch_record'){
 $id = $_POST['id'];
    $query = "SELECT * FROM tbl_diapostion WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo json_encode($row);


}

if($_POST['action'] == 'Edit') {
     $id = $_POST['id'];
$Name = addslashes(trim($_POST["Name"]));
$CatId = addslashes(trim($_POST["CatId"]));
$Color = addslashes(trim($_POST["Color"]));
$SrNo = addslashes(trim($_POST["SrNo"]));
$Negative = addslashes(trim($_POST["Negative"]));
$Status = $_POST["Status"];
$query = "SELECT * FROM tbl_diapostion WHERE CatId='$CatId' AND Name = '$Name' AND id != '$id'";
$result = $conn->query($query);
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
  echo 0;
}
else{
  $query2 = "UPDATE tbl_diapostion SET Name = '$Name',CatId='$CatId',Color='$Color',SrNo='$SrNo',Status='$Status',Negative='$Negative' WHERE id = '$id'";
 	$conn->query($query2);
  echo 1;
}
}

  if($_POST['action'] == 'delete') {
   
      $id = $_POST['id'];
      $query = "DELETE FROM tbl_diapostion WHERE id = '$id'";
      $conn->query($query);
      echo "Delete Successfully";

  }


  if($_POST['action']=='view'){?>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
              <th>#</th>
              
              <th>Industry</th>
              <th>Diapostion</th>
              <th>Color</th>
             
               <th>Status</th>
               <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
               <th>Action</th>
               <?php } ?>
            </tr>
        </thead>
        <tbody>
          <?php 
 $srno = 1;
  $sql = "SELECT * FROM tbl_diapostion ORDER BY id DESC";
   $rx = $conn->query($sql);
  while($nx = $rx->fetch_assoc()){

  ?>
           <tr>
             <td><?php echo $srno; ?></td>
            <td><?php echo $nx['CatId']; ?></td>
             <td><?php echo $nx['Name']; ?></td>

               <td><a href="javascript:void(0)" class="badge badge-info" style="background-color:<?php echo $nx['Color']; ?>"><?php echo $nx['Color']; ?></a></td>
            
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
        "scrollX": true
      });
      });
    </script>
 <?php }
?>