<?php if(isset($_COOKIE['login']))
{	
	require("../../root/db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
     <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  
    
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- data tables -->
    <script src="js/jquery.dataTables.min.js"></script>
	
	
</head>
<body>
    <div id="wrapper">
		<?php     	include("header.php");      	?>
        <div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">
						<h4 align="center"><strong>Manage Download Master</strong></h4><hr>
						
						
						 <ol class="breadcrumb">
                          
                                    <li class="active">
                                        <a href="download_master.php"><i class="fa fa-dashboard"></i> Download Master</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_download_master.php"><i class="fa fa-dashboard"></i> Manage Download</a>
                                    </li>
							
                        </ol>
						<br>
					</div>	
						
                    
      				<div style="clear:both;"></div>
                    <div class="col-lg-12">
					
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                	<th>Course Name</th>
                                    <th>Title</th>
                                    
                                    <th>Document</th>
									<th>URL</th>
									
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $query=$db->query("
SELECT *,(select c_title from course_master where id=dw_c_id) as c_name from download_master ORDER BY id desc
") or die(""); $i=0;
	while($result=$query->fetch(PDO::FETCH_ASSOC)){ $i++;

 ?>
							<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $result['c_name']; ?></td>
								<td>
								
								<?php echo $result['dw_title']; ?>
								
								</td>
                                
                                <td>
								
								<a  download href="../../download_master_doc/<?php echo $result['id'].".".$result['dw_file'];  ?>"><strong>view</strong></a>
								
								</td>
                                
                                
								
								<td><?php echo $result['dw_link']; ?></td>
								
								<td>
								
								<?php if($result['flag']=='true'){ ?>
								
									<button id="<?php echo $result['id']; ?>" class="btn btn-sm btn-info btn_edit">Edit</button>
						
						
									<?php if($result['e_d_optn']=='true'){

?>
<button class="btn btn-sm btn-success btn_disable" id="<?php echo $result['id']; ?>">Enable</button>
<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $result['id']; ?>">Delete</button>
<?php									} else {
?>
<button class="btn btn-sm btn-danger enable_btn" id="<?php echo $result['id']; ?>">Disable</button>

<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $result['id']; ?>">Delete</button>


<?php
	} ?>
									
<?php } else { ?>								
									
		<button class="btn btn-sm btn-default btn_restore" id="<?php echo $result['id']; ?>">Restore</button>
		
<?php } ?>
								</td>
							</tr>
	<?php } ?>
                            </tbody>
                        </table>	
                    </div>                    
				</div>
			</div>
		</div>
</div>
    
<script type="text/javascript">    
	$(function () {
	  
		$('#example1').DataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		   dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        ]
		});
	  });
	  

	$(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("download_master.php?id="+cur_id);
	});

$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_download_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});

$(".btn_restore").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"restore_download_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	$(".enable_btn").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"enable_download_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_download_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	

	
	
	
	  
</script>  
</body>
</html>
<?php } else{
	header("location:../index.php");	
}
?>