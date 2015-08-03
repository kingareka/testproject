<div class="col-sm-6 center-block float_none">
  <div class="panel panel-default">
    <div class="panel-heading"><h4>Setare Parola</h4></div>
    <div class="panel-body">

      <?php echo validation_errors(); ?>

      <?php echo form_open('user/set_password', array('class' => 'form-horizontal')); ?>

      <div class="form-group">
        <?php echo form_label('Parola', 'passowrd', array('class' => 'col-sm-4 control-label')); ?>
        <div class="col-sm-8">
          <?php echo form_password(array(
            'name' => 'password', 
            'id' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Parola'
          )); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo form_label('Confirmare Parola', 'passconf', array('class' => 'col-sm-4 control-label')); ?>
        <div class="col-sm-8">
          <?php echo form_password(array(
            'name' => 'passconf', 
            'id' => 'passconf',
            'class' => 'form-control',
            'placeholder' => 'Confirmare Parola'
          )); ?>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-default'), 'Seteaza Parola'); ?>
        </div>
      </div>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>