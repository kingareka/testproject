<div class="col-sm-12 pull-left">
  <div class="panel panel-default">
    <div class="panel-heading"><h4>Edit</h4></div>
    <div class="panel-body">
    <div class="col-sm-6">    	
		<?php echo form_open('users/myedit/'.$user["list"]->id, array('class'=>'form-horizontal', 'method'=>'POST'));?>	
			
			<div id="error_message"><?php echo validation_errors(); ?></div>
					
			<?php if(isset($user) && count($user)) : ?>
			<?php foreach($user as $row) : ?>						
			<div>
				<div class="form-group">
					<label class="col-sm-2 control-label center-text">Username</label>
					<div class="col-sm-10"><input type="input" class="form-control" name="edit_myusername" id="edit_myusername" placeholder="Username" value="<?php echo $row->username; ?>" disabled="disabled" /></div>
				</div>						
				
				<div class="form-group">				
					<label class="col-sm-2 control-label center-text">Type</label>	
						<div class="col-sm-10">
							<select class="select form-control" name='edit_myrole' id='edit_myrole'>
								 <option value="admin"<?php if($row->role==1) print "selected"; ?>>Admin</option>
								 <option value="user" <?php if($row->role==2) print "selected"; ?>>User</option>
							</select> 		 
						</div>	
				</div>

				<div class="form-group">			
					<label class="col-sm-2 control-label center-text">Name</label>
					<div class="col-sm-10"><input type="text" class="form-control" name="edit_myname" id="edit_myname" value="<?php echo $row->name; ?>">
					</div>	
				</div>

				<div class="form-group">			
					<label class="col-sm-2 control-label center-text">E-mail</label>
					<div class="col-sm-10"><input type="text" class="form-control" name="edit_myemail" id="edit_myemail" value="<?php echo $row->email; ?>">
					</div>	
				</div>

				<div class="form-group">			
					<label class="col-sm-2 control-label center-text">Phone</label>
					<div class="col-sm-10"><input type="text" class="form-control" name="edit_myphone" id="edit_myphone" value="<?php echo $row->phone; ?>">
					</div>	
				</div>

				<div class="form-group">			
					<label class="col-sm-2 control-label center-text">Description</label>
					<div class="col-sm-10"><textarea class="form-control" name="edit_mydescription" id="edit_mydescription"><?php echo $row->description; ?></textarea>
					</div>	
				</div>

				<div><input type='hidden' value='<?php echo $row->id; ?>' name='id' id='id'></div>
			</div id="error_message">
						
			<?php endforeach; ?> 
			<?php else : ?>
				<h3>No results found!</h3>
			<?php endif; ?>
			
			<div class="pull-right">
				<button type="submit" class="btn btn-default" >OK</button>	
				<button class="btn btn-default" >Cancel</button>		
			</div>
		
		<?php form_close(); ?>
		</div>
		<div class="col-sm-6"></div>
	</div>
		
	</div>		
</div>	

