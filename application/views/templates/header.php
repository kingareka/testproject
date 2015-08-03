<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>User Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php print asset_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php print asset_url('css/main.css'); ?>" rel="stylesheet">
    <link href="<?php print asset_url('css/chosen.css'); ?>" rel="stylesheet">
    <link href="<?php print asset_url('css/jquery-ui-1.10.3.custom.min.css'); ?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body> 
  <?php if ($this->session->userdata('loggedin')) { ?>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php print site_url()?>">User Management</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            
          </ul>

          <p class="navbar-text navbar-right">
            Salut <a href="<?php site_url()?>/users/edit/<?php print $this->current_user->id?>"><?php $this->current_user->name?></a>
            <a href="<?php print site_url()?>/sessions/logout">Logout</a>
          </p>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  <?php } ?>

  <div class="container" id="body">

    <?php
    $notification = $this->session->userdata('notification');
    $this->session->unset_userdata('notification');
    ?>

    <?php if ($notification) { ?>
      <div class="alert alert-success"><?php print $notification?></div>
    <?php } ?>
