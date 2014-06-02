<?php

class Product extends CActiveRecord {

    public $image;

    public function rules() {
        return array(
            array('image', 'file', 'types' => 'jpg, gif, png'),
        );
    }

}
