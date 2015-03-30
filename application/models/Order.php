<?php

class Order extends CI_Model {

    protected $xml = null;

    // Constructor
    public function __construct($orderfile = null) {
        parent::__construct();
        
        if ($orderfile ==  null) return;
        
        //load necessary files to process an order
        $this->xml = simplexml_load_file(DATAPATH . $orderfile);
        $this->load->model('menu');
        $this->customer = (string) $this->xml->customer;
        $this->ordertype = (string) $this->xml['type'];
        
        $this->special = null;
        if ($this->xml->special != null) {
            $this->special = (string) $this->xml->special;
        }
        
        $this->allburgers = array();
        foreach ($this->xml->burger as $b) {
            $bcost = 0.00;
            $nextburger = array();   
           
            //deal with patties
            $nextburger['patty'] = (string) $b->patty['type'];
            $bcost += $this->menu->pattyCost((string) $b->patty['type']);
           
            //deal with cheeses
            $nextburger['topcheese'] = "none";
            $nextburger['bottomcheese'] = "none";
            $toppings = array(); 
            $sauces = array(); 
            if ($b->cheeses['top'] != null) { 
                $nextburger['topcheese'] = $b->cheeses['top'];
                $bcost += $this->menu->cheeseCost((string) $b->cheeses['top']);
            }
            if ($b->cheeses['bottom'] != null) { 
                $nextburger['bottomcheese'] = $b->cheeses['bottom'];
                $bcost += $this->menu->cheeseCost((string) $b->cheeses['bottom']);
            }
           
            //deal with toppings
            foreach ($b->topping as $t) { 
                array_push($toppings, array("type" => (string) $t['type']));
                $bcost += $this->menu->toppingCost((string) $t['type']);
            }
            $nextburger['toppings'] = $toppings;
            
            //deal with sauces
            foreach ($b->sauces as $s) { 
                array_push($sauces, array("type" => (string) $s['type']));
            }
            $nextburger['sauces'] = $sauces;
            $nextburger['subtotal'] = $bcost;

            array_push($this->allburgers, $nextburger);
        }  
        
        //calculate the cost of the burger 
        $this->ordertotal = 0.00;
        foreach ($this->allburgers as $burger) {
            $this->ordertotal += $burger['subtotal'];
        }
    }
    
    public function getCustomerName($orderfile) {
        $this->xml = simplexml_load_file(DATAPATH . $orderfile);
        $c = $this->xml->customer;
        return (string) $c;
    }
}

