<?php

class Drink{
    public $id;
    public $name;
    public $image_url;
    public $rating;
    public $instruction;

    public function __construct($id, $name, $image_url, $instruction){
        $this->id = $id;
        $this->name = $name;
        $this->image_url = $image_url;
        $this->instruction = $instruction;
    }

    public function get_name(){
        return $this->name;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_image_url() {
        return $this->image_url;
    }

    public function get_instruction() {
        return $this->instruction;
    }

};