<?php
App::uses('AppModel', 'Model');

class Pedido extends AppModel {

    public $actsAs = array(
        'Containable'
    );

    public $belongsTo = array(
        'Cliente' => array(
            'className' => 'Cliente',
            'foreignKey' => 'cliente_id'
        )
    );

    public $hasMany = array('Items', 'Produtos');

    public function delete($id = null, $cascade = true) {
        $this->id = $id;
        $deleted = $this->saveField('deleted', date('Y-m-d h:i:s'));

        return $deleted;
    }


}