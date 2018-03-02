<!DOCTYPE html>
<html>
<head>
	<title>Lihat maskapai</title>
</head>
<body>
	<div class="table-responsive">
		<table id="table_id" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>id</th>
					<th>Reservation code</th>
					<th>Reservation at</th>
					<th>reservation date</th>
					<th>customer id</th>
					<th>seat code</th>
					<th>rute id</th>
					<th>depart at</th>
					<th>price</th>
					<th>user id</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($show->result() as $tReservation)
				{?>
					<tr>
						<td><?php echo $tReservation->id ?></td>
						<td><?php echo $tReservation->reservation_code ?></td>
						<td><?php echo $tReservation->reservation_at ?></td>
						<td><?php echo $tReservation->reservation_date ?></td>
						<td><?php echo $tReservation->customerid ?></td>
						<td><?php echo $tReservation->seat_code ?></td>
						<td><?php echo $tReservation->ruteid ?></td>
						<td><?php echo $tReservation->depart_at ?></td>
						<td><?php echo $tReservation->price ?></td>
						<td><?php echo $tReservation->userid ?></td>
						<td>
							<!-- <div class="btn btn-warning"><?php echo anchor('admin/update_reservation/'.$tReservation->id,'Edit'); ?></div> -->
							<a class="btn btn-warning" href="<?php echo base_url('admin/update_reservation/'.$tReservation->id);?>">Edit</a> 	
							<button class="btn btn-danger" onclick="hapus_user(<?php echo $tReservation->id;?>)">Hapus</button>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>
		<script type="text/javascript">
	  		$(document).ready( function () {
	     	$('#table_id').DataTable();
	  		} );

	    	var save_method; //for save method string
	    	var table;

	    	function ngedit_user(id)
	    	{
	      		save_method = 'update';
	      		$('#form')[0].reset(); // reset form on modals

		      	//Ajax Load data from ajax
		      	$.ajax({
			        url : "<?php echo base_url('user/user/edit_profile/')?>/" + id,
			        type: "GET",
			        dataType: "JSON",
			        success: function(data)
			        {
			        	$('[name="id"]').val(data.id);
			        	$('[name="id"]').val(data.id);
			        	$('[name="username"]').val(data.username);	
			            $('[name="fullname"]').val(data.fullname);
			            $('[name="email"]').val(data.email);

			            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

		        },
	
	    		});
	    	}

	    	function hapus_user(id)
		    {
		      var url = "<?php echo base_url(''); ?>";
		      if(confirm('Anda yakin akan menghapus user dengan id ' + id + '?'))
		      {
		      	if (true) 
		      	{
		      		window.location = url+"admin/hapus_reservation/"+id;
		      	}
		      	else
		      	{
		      		return false;
		      	}
		      }
		    }

		    function save()
		    {
		    	var url;
		      	if (save_method == 'update')
		      	{
		       		url = "<?php echo base_url('admin/admin/update_user')?>";
		      	}

		       // ajax adding data to database
		          $.ajax({
		            url : url,
		            type: "POST",
		            data: $('#form').serialize(),
		            dataType: "JSON",
		            success: function(data)
		            {
		               //if success close modal and reload ajax table
		               $('#modal_form').modal('hide');
		              location.reload();// for reload a page
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                alert('Terjadi kesalahan!');
		            }
		        });
		    }
		</script>
</html>