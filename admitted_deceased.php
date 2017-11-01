
<?php

        session_start();
        require ('dblogin.php');
        if(!isset($_SESSION['mort_login'])){
            header('Location:staff_login.php');
        }
		?>
<!Doctype html>
<html>
<head>
    <title>Edit Patient Details</title>
    <link rel="stylesheet" type="text/css" href="bandaricss.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, init-scale=1">
</head>
<body>
         <h3 class="text-center">	
		     <b>
		 <?php 
		 include 'header.php';
require_once ('dblogin.php');
           $query="SELECT COUNT(*) FROM deceased WHERE Status='admitted'";
                $queryResult=mysqli_query($connection,$query);

                $resultArray=mysqli_fetch_array($queryResult);
              echo $resultArray[0].' Admitted Deceased.';
                        ?>
					</b>
						
				</h3>
 <style>
            .displaystaff_content table,th,td {
    padding:6px;
    border: 1px solid #2E4372;
   border-collapse: collapse;
}
#button{
    border:none;
}
</style>
  
<div class="container">
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for deceased..enter a letter in name" title="Type in a name" class="form-control input-md">
    <form  action="" method="post">
     <div class="form-group">
    <table  class="table table-hover" id="myTable">
        <caption align='center' style='color:#2E4372'><h3><u>Deceased Details</u></h3></caption>

        <th></th>
        <th> NAME</th>
        <th>CARD NUMBER</th>
        <th>GENDER</th>
		 <th>NATIONAL ID</th>
		 <th>BIRTH CERTIFICATE</th>
        <th>DATE OF BIRTH</th>
		 <th>DATE OF DEATH</th>
        <th>AGE</th>
        <th>DATE ADMITTED</th>
        
        <?php

      
      
            $search="SELECT name,cardnumber,gender,nationalid,birthcert,birthdate,deathdate,age,post_date FROM deceased WHERE Status='admitted'"; 

            $query=mysqli_query($connection,$search);
            while($rows=mysqli_fetch_array($query)){


                echo "<tr><td><input type='radio' name='patients_id' value='".$rows[1]."'></td><td>$rows[0]</td><td>$rows[1]</td><td>$rows[2]</td><td>$rows[3]</td><td>$rows[4]</td><td>$rows[5]</td><td>$rows[6]</td><td>$rows[7]</td><td>$rows[8]</td></tr>";
            }

        ?>
    </table>
                         
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<?php
                        require'Connection.php';
                       @$id=  mysqli_real_escape_string($connection,$_REQUEST['patients_id']);
                       if(isset($_REQUEST['post'])){
                        $updateQuery="UPDATE deceased SET Status='Discharged' WHERE CardNumber='".$_REQUEST['patients_id']."'";
						mysqli_query($connection,$updateQuery);
                           echo"<p class='alert alert-success'>Deceased Discharged succesfully</p>";
                          }
						  
                        ?>
            <input type="submit" name="post" value="Discharge Deceased" class="btn btn-primary btn-lg">
			<h3 ><a href="mortuary.php">Back</a></h3>
        </div>
    </form>
</div>

</body>
</html>