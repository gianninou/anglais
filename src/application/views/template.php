<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTDxhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
       
    </head>
    <body>
        <header>
            <h1>TITLE(TODO)</h1>
            <nav class="navbar navbar-default" role="navigation">
                <ul>
                    <?php  if ($this->session->userdata('id') == true) { ?>
                        <li><a href="#">List</a></li>
                        <li><a href="#">Groups</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Logout</a></li>
                    <?php }else{ ?>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
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
