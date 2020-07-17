<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Cliente extends AppModel {

    public $actsAs = array(
        'Containable'
    );
    
    public function delete($id = null, $cascade = true) {
        $this->id = $id;
        $deleted = $this->saveField('deleted', date('Y-m-d h:i:s'));

        return $deleted;
    }

    public function beforeSave($options = array()) {
        if (!empty($this->data['Cliente']['senha'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data['Cliente']['senha'] = $passwordHasher->hash($this->data['Cliente']['senha']
        );
    }

        return true;
    }

    public function afterSave($created, $options = array()) {
        if (!empty($this->data['Cliente']['aro_parent_id'])) {
            $this->aroSave();
        }
    }

    public function aroSave() {
        $Aro = ClassRegistry::init('Aro');
        $aro = $Aro->findByForeignKey($this->data['Cliente']['id']);
        $saveAro = array(
            'model' => 'Cliente',
            'foreign_key' => $this->data['Cliente']['id'],
            'parent_id' => $this->data['Cliente']['aro_parent_id']
        );
        if (empty($aro)) {
            $Aro->create();
        } else {
            $Aro->id = $aro['Aro']['id'];
        }
        $Aro->save($saveAro);        
    }

}