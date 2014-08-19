<?php
//import Controller Class
App::uses('AppController', 'Controller');

class VideosController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> Auth -> allow('add');
  }
  /**
   * Method to add more company to database
   */
  public function add(){
    $isCreatedBy = null;
    if($this -> request -> is('post')){
      $this -> request -> data['Video']['alias'] = $this -> Utility -> stringURLSafe($this -> request -> data['Video']['name']);
      $this -> Video -> set($this -> request -> data);
      //print_r($this -> request -> data);
      if($this -> Video -> validates()){
        print_r($this -> request -> data);
      } else {
        return $this -> Session -> setFlash($this -> Video -> validationErrors, 'alert/default', array('class' => 'alert'));
      }
    }
  }
}
