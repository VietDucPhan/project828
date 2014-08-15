<?php
//import Controller Class
App::uses('AppController', 'Controller');

class CompaniesController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> loadModel('Skater');
    $this -> Auth -> allow('add');
  }
  /**
   * Method to add more company to database
   */
  public function add(){
    if($this -> request -> is('post')){
      print_r($this->request->data);
    }
  }
}
