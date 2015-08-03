<div id="container">
<div class="modal-dialog modal-lg">
	<div class="modal-content">	
		<?php echo form_open('', array('class'=>'form-horizontal', 'method'=>'POST'));?>
		
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Create</h4>
		</div>
		
		<div class="modal-body">
			<div class="alert error">
				<div id="error_message"></div>
			</div>
			<?php // print_r($user);?>			
			
			<div>				
				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Username</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="create_username" id="create_username" placeholder="Username" value=""  /></div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Password</label>
					<div class="col-sm-10"><input type="password" class="form-control" name="create_password" id="create_password" placeholder="Password" value=""  /></div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Confirm password</label>
					<div class="col-sm-10"><input type="password" class="form-control" name="create_passconf" id="create_passconf" placeholder="Confirm password" value=""  /></div>
				</div>				
						
				
				<div class="form-group">				
					<label class="col-sm-2 control-label center-text">Type</label>	
						<div class="col-sm-10">
							<select class="select form-control" name='create_role' id='create_role'>
								 <option value="">Select role</option>	
								 <option value="admin">Admin</option>
								 <option value="user">User</option>
							</select> 		 
						</div>	
				</div>	

				<div class="form-group">				
					<label class="col-sm-2 control-label center-text">Age category</label>	
						<div class="col-sm-10">
							<select class="select form-control" name='create_agecat' id='create_cat'>	
							 	<option value="0">Select age</option>						
								<?php foreach ($agecat as $age) { ?>								 
								 <option value="<?php print $age['id'];?>"><?php print $age['name'];?></option>
								<?php } ?>
							</select> 		 
						</div>	
				</div>	

				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Name</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="create_name" id="create_name" placeholder="Name" value=""  /></div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label center-text">E-mail</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="create_email" id="create_email" placeholder="E-mail" value=""  /></div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Phone</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="create_phone" id="create_phone" placeholder="Phone" value=""  /></div>
				</div>			
			
				<div class="form-group">			
					<label  class="col-sm-2 control-label center-text">Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" name="create_description" id="create_description"></textarea>
					</div>	
				</div>

			<!-- 	<div><input type='hidden' value='' name='id' id='id'></div> -->
			</div id="error_message">		
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
	 		var username = $('#create_username').val();  
	 		var type = $('#create_role').val();  
	 		var name = $('#create_name').val();  
	 		var email = $('#create_email').val(); 
	 		var agecat = $('#create_cat').val(); 
	 		var password = $('#create_password').val(); 
	 		var passwordconf = $('#create_passconf').val(); 
	 		var phone = $('#create_phone').val();  
	 		var description = $('#create_description').val();  
			
	 		$.ajax({  
	 			type: "POST",  
				url: "<?php print base_url();?>index.php/users/create",  
	 			cache: false,  
	 			dataType: "json",  
	 			data: 'id='+id+'&create_username='+username+'&create_role='+type+'&create_name='+name+'&create_password='+password+'&create_passconf='+passwordconf+'&create_email='+email+'&create_cat='+agecat+'&create_phone='+phone+'&create_description='+description,
							
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