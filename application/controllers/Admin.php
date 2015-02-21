<?php

class Admin extends Application {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('formfields');
    }

    function index()
    {
        $this->data['title'] = 'Quotations Maintenance';
        $this->data['quotes'] = $this->quotes->all();
        $this->data['pagebody'] = 'admin_list';    // this is the view we want shown
        $this->render();
    }
    
    //add a new quotation
    function add()
    {
        $quote = $this->quotes->create();
        $this->present($quote);
    }

    //builds the form using formfields helper
    function present($quote)
    {
        $this->data['fid'] = makeTextField('ID#', 'id', $quote->id);
        $this->data['fwho'] = makeTextField('Author', 'who', $quote->who);
        $this->data['fmug'] = makeTextField('Picture', 'mug', $quote->mug);
        $this->data['fwhat'] = makeTextField('Quote', 'what', $quote->what);
        $this->data['pagebody'] = 'quote_edit';
        $this->data['fsubmit'] = makeSubmitButton('Process Quote', "Click here to validate the quote data", 'btn-success');
        $this->render();
    }
    
    //confirms quote form
    function confirm()
    {
        $record = $this->quotes->create();
        $record->id = $this->input->post('id');
        $record->who = $this->input->post('who');
        $record->mug = $this->input->post('mug');
        $record->what = $this->input->post('what');
        if (empty($record->id)) 
            $this->quotes->add($record);
        else
            $this->quotes->update($record);
        redirect('/admin');
    }
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */