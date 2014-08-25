<?php
//import Controller Class
App::uses('AppController', 'Controller');

class TricksController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> loadModel('Skater');
    $this -> loadModel('CompanyPostImage');
    $this -> loadModel('SkaterSponsor');
    $this -> loadModel('CompanyVideo');
    $this -> Auth -> allow('add');
  }
  /**
   * Method to add more company to database
   */
  public function add(){
    $isCreatedBy = null;
    if($this -> request -> is('post')){
    }
  }
}
