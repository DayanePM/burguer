<?php
App::uses('AppModel', 'Model');

class Item extends AppModel {

    public $actsAs = array(
        'Containable'
    );

}