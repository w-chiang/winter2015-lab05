<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data.
 * This would be considered a "mock database" model.
 *
 * @author jim
 */
class Menu extends CI_Model {

    protected $xml = null;
    protected $patty_names = array();
    protected $patties = array();
    protected $cheeses = array();
    protected $toppings = array();

    // Constructor
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'menu.xml');

        // build the list of patties - approach 1
        foreach ($this->xml->patties->patty as $patty) {
            $patty_names[(string) $patty['code']] = (string) $patty;
        }

        // build a full list of patties - approach 2
        foreach ($this->xml->patties->patty as $patty) {
            $record = new stdClass();
            $record->code = (string) $patty['code'];
            $record->name = (string) $patty;
            $record->price = (float) $patty['price'];
            $patties[$record->code] = $record;
        }       
        foreach ($this->xml->cheeses->cheese as $cheese) {
            $record = new stdClass();
            $record->name = (string) $cheese;
            $record->code = (string) $cheese['code'];
            $record->price = (float) $cheese['price'];
            $this->cheeses[$record->code] = $record;
        } 
        foreach ($this->xml->toppings->topping as $topping) {
            $record = new stdClass();
            $record->name = (string) $topping;
            $record->code = (string) $topping['code'];
            $record->price = (float) $topping['price'];
            $this->toppings[$record->code] = $record;
        }
    }

    // retrieve a list of patties, to populate a dropdown, for instance
    function patties() {
        return $this->patty_names;
    }

    // retrieve a patty record, perhaps for pricing
    function pattyCost($code) {
        if (isset($this->patties[$code]))
        {
            $record = $this->patties[$code];
            return $record->price;
        }
        else
            return null;
    }
    
    function cheeseCost($code) {
        if (isset($this->cheeses[$code]))
        {
            $record = $this->cheeses[$code];
            return $record->price;
        }
        else
            return null;
    }
    
    function toppingCost($code) {
        if (isset($this->toppings[$code]))
        {
            $record = $this->toppings[$code];
            return $record->price;
        }
        else
            return null;
    }

}
