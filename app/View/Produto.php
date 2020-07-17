<?php
App::uses('AppModel', 'Model');

class Produto extends AppModel {

    public $actsAs = array(
        'Containable'
    );

    public $hasAndBelongsToMany = array(
        'Pedidos'
    );

    public function delete($id = null, $cascade = true) {
        $this->id = $id;
        $deleted = $this->saveField('deleted', date('Y-m-d h:i:s'));

        return $deleted;
    }

}