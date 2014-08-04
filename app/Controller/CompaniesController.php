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
    $this -> Auth -> allow('ajaxCompanies');
  }
}
