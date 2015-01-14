<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTDxhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-theme.css' ; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ; ?>"/>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ; ?>"></script>
    </head>
    <body>
        <header>
            <h1>TITLE(TODO)</h1>
            <nav class="navbar navbar-default" role="navigation">
                <ul class="nav navbar-nav">
                    <?php  if ($this->session->userdata('user') == true) { ?>
                        <li><a href="#">List</a></li>
                        <li><a href="#">Groups</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="<?php  echo base_url().'index.php/welcome/logout'; ?>">Logout</a></li>
                    <?php }else{ ?>
                        <li><a href="<?php  echo base_url().'index.php/welcome/login'; ?>">Login</a></li>
                        <li><a href="<?php  echo base_url().'index.php/welcome/register'; ?>">Register</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </header>

        <div id="content">
            <?php echo $content; ?>
        </div>
        <footer>
            
        </footer>
    </body>
</html>
