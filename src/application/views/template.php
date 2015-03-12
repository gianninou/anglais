<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTDxhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-theme.css' ; ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ; ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.css' ; ?>"/>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.min.js' ; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ; ?>"></script>
</head>
<body>
    <header>
        <h1 id="banniere"><a href="<?php echo base_url().'index.php'; ?>"><img src="<?php echo base_url() . 'assets/img/banniere.jpg' ; ?>"/></a></h1>
        
        <nav class="navbar navbar-default" role="navigation">
            
            <?php  if ($this->session->userdata('user') == true) { ?>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Lists<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url().'index.php/wlist/myLists'; ?>">My lists</a></li>
                            <li><a href="<?php echo base_url().'index.php/wlist/triedLists'; ?>">Tried lists</a></li>
                            <li><a href="<?php  echo base_url().'index.php/wlist/add'; ?>">Add</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Groups<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url().'index.php/group/myGroups'; ?>">My groups</a></li>
                            <li><a href="<?php echo base_url().'index.php/group/myGroupsShared'; ?>">Groups share with me</a></li>
                            <li><a href="<?php  echo base_url().'index.php/group/add'; ?>">Create a new group</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="navbar-right"><a href="<?php  echo base_url().'index.php/welcome/logout'; ?>">Logout&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                </ul>
            <?php }else{ ?>
                <ul class="nav navbar-nav">
                    <li><a href="<?php  echo base_url().'index.php/welcome/login'; ?>">Login</a></li>
                    <li><a href="<?php  echo base_url().'index.php/welcome/register'; ?>">Register</a></li>
                </ul>
            <?php } ?>
            
        </nav>
    </header>

    <div id="content">
        <?php echo $content; ?>
    </div>
    <footer>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <p class="navbar-text">Developed by Damien CUPIF and Valentin GIANNINI</p>
            </div>
        </nav>
    </footer>
</body>
</html>
