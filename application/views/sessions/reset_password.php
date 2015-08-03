<div class="col-sm-6 center-block float_none">
  <div class="panel panel-default">
    <div class="panel-heading"><h4>Reset your password</h4></div>
    <div class="panel-body">

      <?php echo validation_errors(); ?>

      <?php echo form_open('user/reset_password', array('class' => 'form-horizontal')); ?>

      <div class="form-group">
        <?php echo form_label('Email', 'email', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo form_input(array(
            'name' => 'email', 
            'id' => 'email',
            'class' => 'form-control',
            'placeholder' => 'Email'
          )); ?>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-default'), 'Reset your password'); ?>
        </div>
      </div>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>