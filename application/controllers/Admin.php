<?php

class Admin extends Application {

    function __construct()
    {
	parent::__construct();
    }

    function index()
    {
        $this->data['title'] = 'Quotations Maintenance';
        $this->data['quotes'] = $this->quotes->all();
        $this->data['pagebody'] = 'admin_list';    // this is the view we want shown
        $this->render();
    }
    
    function add()
    {
        
    }

}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */