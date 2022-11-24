<?php
$page='Consultation';
include('header.php');
include('Connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
    <li class="breadcrumb-item"><a href="SpecialtyDisplay.php">Find Doctor</a></li>
   
</ol>
</nav>
 	
            
    	<?php 
    	{
    		$select="Select * From Specialty";
    		$ret   =mysqli_query($connect,$select);
    		$count=mysqli_num_rows($ret);
    		for ($rows=0; $rows < $count ; $rows+=3)
    		{
    			echo"<div class='row'>";
    			$select2="Select * From Specialty LIMIT $rows,3";
    			$query2=mysqli_query($connect,$select2);
    			$subcount=mysqli_num_rows($query2);
    			for ($cols=0 ; $cols < $subcount ; $cols++)
                {
    			$data=mysqli_fetch_array($query2);
    			$specialtyID=$data['SpecialtyID'];
                echo "<div class='col-sm-4'>"; 
                echo "<div class='card my-sm-3 border border-success'>"; 
                echo "<img src='".$data['SpecialtyImage']."' class='card-img-top' width='300px' height='300px'>";
                echo "<div class='card-body'>";
                echo "<a href='DoctorDisplay.php?SPID=$specialtyID' class='text-dark'>
                ".$data['SpecialtyName']. "</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

    		}

    			echo"</div>";
    	}
    }
?>
		</tbody>
		</table>
	</div>

</div>
<?php
include('footer.php');
?>
</body>
</html>