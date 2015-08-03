<div id="container">
<div class="modal-dialog modal-lg">
	<div class="modal-content">				
		<?php echo form_open('', array('class'=>'form-horizontal', 'method'=>'POST'));?>
		
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Edit</h4>
		</div>
		
		<div class="modal-body">
			<div class="alert error">
				<div id="error_message"></div>
			</div>
			

			<?php if(isset($user) && count($user)) : ?>
			<?php foreach($user as $row) : ?>			
			<div>
				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Username</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="edit_username" id="edit_username" placeholder="Username" value="<?php echo $row->username; ?>" disabled="disabled" /></div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Type</label>
					<div class="col-sm-10">
						<select class="select form-control" name='edit_role' id='edit_role'>
							<option value="">Select role</option>	
							<option value="admin"<?php if($row->role==1) print "selected"; ?>>Admin</option>
							<option value="user" <?php if($row->role==2) print "selected"; ?>>User</option>
						</select> 
					</div>
				</div>

				<div class="form-group">				
					<label class="col-sm-2 control-label center-text">Age category</label>	
						<div class="col-sm-10">
							<select class="select form-control" name='edit_agecat' id='edit_cat'>			
								<option value="0">Select age</option>					
								<?php foreach ($agecat as $age) { ?>								 
								 <option value="<?php print $age['id'];?>"><?php print $age['name'];?></option>
								<?php } ?>
							</select> 		 
						</div>	
				</div>	
				
				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Name</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="edit_name" id="edit_name" placeholder="Name" value="<?php echo $row->name; ?>" /></div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label center-text">E-mail</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="edit_email" id="edit_email" placeholder="E-mail" value="<?php echo $row->email; ?>" /></div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Phone</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="edit_phone" id="edit_phone" placeholder="Phone" value="<?php echo $row->phone; ?>" /></div>
				</div>
							
				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Description</label>
					<div class="col-sm-10"><textarea class="form-control" name="edit_description" id="edit_description"><?php echo $row->description; ?></textarea></div>
				</div>	

				<div><input type='hidden' value='<?php echo $row->id; ?>' name='id' id='id'></div>

			</div id="error_message">						
			<?php endforeach; ?> 

			<?php else : ?>
				<h3>No results found!</h3>
			<?php endif; ?>
			
		</div>
		
		<div class="modal-footer">
			<button type="submit" class="btn btn-default" >OK</button>	
			<button class="btn btn-default" data-dismiss="modal">Cancel</button>		
		</div>
		
		<?php form_close(); ?>
		
	</div>		
</div>	
</div>

<script type="text/javascript">  
 	$(document).ready(function() {     	 
 		$(".btn.btn-default").click(function( e ) {  
	 		e.preventDefault();  
	 		var id = $('#id').val();  
	 		var username = $('#edit_username').val();  
	 		var type = $('#edit_role').val();  
	 		var name = $('#edit_name').val();  
	 		var email = $('#edit_email').val();  
	 		var age = $('#edit_cat').val(); 
	 		var phone = $('#edit_phone').val();  
	 		var description = $('#edit_description').val();  
		
	 		$.ajax({  
	 			type: "POST",  
				url: "<?php print base_url();?>index.php/users/edit",  
	 			cache: false,  
	 			dataType: "json",  
	 			data: 'id='+id+'&edit_username='+username+'&edit_role='+type+'&edit_name='+name+'&edit_email='+email+'&edit_phone='+phone+'&edit_cat='+age+'&edit_description='+description,
							
	 			success: function(result) {  
	 				if(result.error) {  					
	 					$("#error_message").html("<div class='alert alert-danger'>"+result.message+"</div>");  
	 				} 
	 				else {   
	 				    $("#error_message").html("<div class='alert alert-success'>"+result.message+"</div>"); 
	 				    setTimeout("window.location.href='<?php echo base_url() ?>index.php/';",2000); 
						//$(location).attr('href','<?php echo base_url() ?>index.php/list_user/');        
	 				}  
	 			 }  
	 		});  
 		});  
  });
</script>