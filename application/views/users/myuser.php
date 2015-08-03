<div>
        <div class="form-group">      
          <label for="email" class="col-sm-2 ">Username</label>
          <div class="col-sm-10">
            <label for="my_email" ><?php echo $row->username; ?></lable>
          </div>  
        </div>        
        
        <div class="form-group">        
          <label for="type" class="col-sm-2 ">Type</label>  
            <div class="col-sm-10">
              <label for="my_type"></lable>    
            </div>  
        </div>                      
        <div class="form-group">      
          <label for="name" class="col-sm-2 ">Name</label>
          <div class="col-sm-10">
            <label for="my_name" ><?php echo $row->name; ?></label>
          </div>  
        </div>
        <div class="form-group">      
          <label for="email" class="col-sm-2 ">E-mail</label>
          <div class="col-sm-10">
            <label for="my_email" ><?php echo $row->email; ?></label>
          </div>  
        </div>
        <div class="form-group">      
          <label for="phone" class="col-sm-2 ">Phone</label>
          <div class="col-sm-10">
            <span id="my_phone" ><?php echo $row->phone; ?></label>
          </div>  
        </div>
        <div class="form-group">      
          <label for="email" class="col-sm-2 ">Description</label>
          <div class="col-sm-10">
            <span id="my_description" ><?php echo $row->description; ?></label>
          </div>  
        </div>
      </div>