<?php

/**
 * Our homepage. Show the most recently added quote.
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct()
    {
	parent::__construct();
    }

    //-------------------------------------------------------------
    //  Homepage: show a list of the orders on file
    //-------------------------------------------------------------

    function index()
    {
        $this->load->helper('directory');    
            
        // Build a list of orders
        $map = directory_map('./data/', 1);
        $orders = array();
        foreach ($map as &$f) {
            if ($this->startsWith($f, 'order') && $this->endsWith($f, '.xml')){
                $orders[] = array( 'href' => '/welcome/order/'.$f, 'file' => $f );
            }
        }
        
        $this->data['files'] = $orders;
        
        // Present the list to choose from
        $this->data['pagebody'] = 'homepage';
        
        $this->render();
        }
    
    //-------------------------------------------------------------
    //  Show the "receipt" for a specific order
    //-------------------------------------------------------------

    function order($filename)
    {
        $this->load->model('menu');
        // Build a receipt for the chosen order
	
        // Present the list to choose from
        $this->data['pagebody'] = 'justone';
        $this->render();
    }
    
    
    
    
    //can move this to a model later
    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
    
    function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }
}
