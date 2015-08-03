<?php if ($notification) { ?>
  <div class="alert alert-success"><?php print $notification; ?></div>
<?php } ?>


<?php if ($this->session->userdata('loggedin_user')->role==1) { ?>
<div class="col-sm-12 pull-left">
  <div class="panel panel-default">
    <div class="panel-heading"><h4>User List</h4></div>
    <div class="panel-body">
    <div class="col-sm-12">
      <div class="row">
        <div class="">
        <?= form_open('', array('class' => 'navbar-form pull-left', 'id'=>'quick_search')) ?>         
        <div class="form-group"><input type="text" class="form-control .js_search" placeholder="Cautare" name="search" value="<?php if(isset($search)) print $search; ?>">  </div>     
        <button type="submit" class="btn btn-default">Cauta user</button>
        <?= form_close() ?>
        </div>
        <div class="btn btn-default pull-right margin_8t" onclick="load_create_ajax()">Add new user</div>
      </div>         
         
      <div class="margin_20b">
      </div>

      <div class="row">
        <table id="table_list" class="display js_search_results">
          <thead>
            <tr>
              <th class="col-sm-3">Username</th>      
              <th class="col-sm-2">Email</th>
              <th class="col-sm-3">Name</th>
              <th class="col-sm-2">Type</th>          
            </tr>
          </thead>
          <tbody>        
          	<?php foreach ($users as $user) { ?>
        	  	<tr onclick="load_data_ajax(<?php print $user['id'];?>)">
        	      <td><span data-toggle="tooltip" data-container="body" class="mytool" data-placement="right" title="<?php print $user['description'];?>"><span><?php print $user['username']; ?></span></span></td>
                <td rel="<?php print $user['id'];?>" id="modal_<?php print $user['id'];?>" data-toggle="modal" 
                        data-target=".orderModal"><?php print $user['email']; ?></td>
        	      <td><?php print $user['name']; ?></td>
        	      <td><?php print $user['role']; ?></td>
        	   </tr>
          	<?php } ?>
          </tbody>
        </table>
      </div>
      <div class="row">
       <div class="btn btn-default pull-right margin_20t" onclick="load_create_ajax()">Add new user</div>
      </div> 
    </div>
    </div>
  </div>
</div> 
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
<?php } ?>


<?php if ($this->session->userdata('loggedin_user')->role==2) { ?>
<div class="col-sm-12 pull-left">
  <div class="panel panel-default">
    <div class="panel-heading"><h4>My profile</h4></div>
    <div class="panel-body">
    <div class="col-sm-12">
  <?php foreach ($users as $user) { ?>
    <?php if($user['id']==$this->session->userdata('loggedin_user')->id){?>   
                
        <div class="row form-group">
         <a href="<?=site_url()?>/users/editmyuser/<?php print $user['id']; ?>" class="btn btn-default pull-right margin_20b">Edit my user</a>
        </div>       

        <div class="row form-group">
          <label class="col-sm-2 control-label center-text">Username:</label>
            <div class="col-sm-10"><?php echo $user['username']; ?></div>
        </div>

        <div class="row form-group">
          <label class="col-sm-2 control-label center-text">Type:</label>
            <div class="col-sm-10"><?php echo $user['role']; ?></div>
        </div>

        <div class="row form-group">
          <label class="col-sm-2 control-label center-text">Name:</label>
            <div class="col-sm-10"><?php echo $user['name']; ?></div>
        </div>

        <div class="row form-group">
          <label class="col-sm-2 control-label center-text">E-mail:</label>
            <div class="col-sm-10"><?php echo $user['email']; ?></div>
        </div>

        <div class="row form-group">
          <label class="col-sm-2 control-label center-text">Phone:</label>
            <div class="col-sm-10"><?php echo $user['phone']; ?></div>
        </div>

        <div class="row form-group">
          <label class="col-sm-2 control-label center-text">Description:</label>
            <div class="col-sm-10"><?php echo $user['description']; ?></div>
        </div>  
      
    <?php } ?>
  <?php } ?>
    </div>
    </div>
  </div>
</div>

<?php } ?>


<script>
$(document).ready(function() {
  $('#table_list').DataTable();
  // $('[data-toggle="tooltip"]').tooltip({
  //     placement : 'top'
  // });
});

var controller = 'users';
var base_url = '<?php echo site_url(); ?>';

function load_data_ajax(id) {  
  $.ajax({
    'url' : base_url + '/' + controller + '/getuser',
    'type' : 'POST', 
    'data' : {'id':id},     
    success : function(data) { 
      $("#myModal").html(data);
      $("#myModal").modal('show');        
    },
    error: function() {
      alert('ajax did not succeed');
    }
  });
}

function load_create_ajax(){
  $.ajax({
    'url' : base_url + '/' + controller + '/createuser',
    success : function(data) {
      $("#myModal").html(data);
      $("#myModal").modal('show');
    },
    error: function() {
      alert('ajax did not succeed');
    }
  });
}

function load_editmy_ajax(id){
  $.ajax({
    'url' : base_url + '/' + controller + '/editmyuser',
    'type' : 'POST',
    'data' : {'id':id},
    success : function(data) {
      $("#myModal").html(data);
      $("#myModal").modal('show');
    },
    error: function() {
      alert('ajax did not succeed');
    }
  });
}

// $('body').on('keyup', 'input', function(e) {
//   if (e.keyCode == 13) {
//     e.preventDefault()
//     newSearch();
//   }
// });
// function newSearch() {

//   var previous;
//   $('#table_list').DataTable({
//       "ajax": 'index.php?' + $('#quick_selection').serialize(),
//       "processing": true,
//       "serverSide": true,
     
//       "columns": [
//             { "data": "username" },
//             { "data": "email" },
//             { "data": "name" },
//             { "data": "type" }

//         ],
      
//     }); 
   
//   }
</script>