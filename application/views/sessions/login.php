<div class="col-sm-6 center-block float_none">
  <div class="panel panel-default">
    <div class="panel-heading"><h4>Login</h4></div>
    <div class="panel-body">
      <?php if ($notification) { ?>
        <div class="alert alert-success"><?php print $notification; ?></div>
      <?php } ?>

      <?php if ($login_notification) { ?>
        <div class="alert alert-danger"><?php print $login_notification; ?></div>
      <?php } ?>

      <?php echo form_open('sessions/authenticate', array('class' => 'form-horizontal')); ?>

      <div class="form-group">
        <?php echo form_label('Username', 'user_username', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo form_input(array(
            'name' => 'user[username]', 
            'id' => 'user_username',
            'class' => 'form-control',
            'placeholder' => 'Username',
            'value' => set_value('user[user_name]')
          )); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo form_label('Password', 'user_password', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo form_password(array(
            'name' => 'user[password]', 
            'id' => 'user_password',
            'class' => 'form-control',
            'placeholder' => 'Password'
          )); ?>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-default'), 'Sign in'); ?>
          <a href="<?php print site_url(); ?>/user/reset_password">Forgot your password?</a>
        </div>
      </div>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>