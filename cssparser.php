<?php

class Stylesheet {
    function __construct($file) {
        $rawdoc = file_get_contents($file);
        $rawrules = explode('}', $rawdoc);
        foreach($rawrules as $rawrule) {
            $newrule = new Rule($rawrule);
            array_push($this->rules, $newrule);
        }
    }
    //Maybe this will be how we define the output back into the .css file?
    function __toString() {
        
    }
    public $rules = array();
}
class Rule {
    function __construct($chunk) {
        $this->selector = trim(substr($chunk,0,strpos($chunk, '{')));
        $chunk = substr($chunk,(strpos($chunk,'{')+1));
        $chunk = trim(preg_replace('/\s\s+/',' ',$chunk));
        $properties = explode(';',$chunk);
        array_pop($properties);
        foreach($properties as $property) {
            $dec = new Property(trim($property));
            array_push($this->declarations, $dec);
        }
    }
    //Output all properties contained within a rule
    //TODO Write a similar method that writes to file
    public function formatProperties() {
        foreach($this->declarations as $dec) {
            echo $dec;
        }
    }
    public $declarations = array();
    public function addDeclaration($name, $value) {
        
    }
    public function removeDeclaration($name){}
}

class Property {
    function __construct($chunk) {
        $this->name = substr($chunk,0,strpos($chunk,':'));
        $this->value = trim(substr($chunk,(strpos($chunk,':')+1)));
    }
    //The below method allows the property to be output in proper CSS syntax when an instance of this object is called as a string
    function __toString() {
        return $this->name.' : '.$this->value.';\r\n';
    }
}
?>