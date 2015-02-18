<?php

class Admin extends Application {

    function __construct()
    {
	parent::__construct();
    }

    function index()
    {
	$this->data['pagebody'] = 'homepage';    // this is the view we want shown
	$this->render();
    }

}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */