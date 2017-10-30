<?php

class Svn extends CI_Controller{    
    function update(){
       $output = shell_exec('svn update 2>&1');
       echo "<pre>".$output."</pre>";
    }
}