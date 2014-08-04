<?php
//import Controller Class
App::uses('AppController', 'Controller');
/**
 * Class for ajax request
 */
class AjaxController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> layout = 'ajax';
    $this -> loadModel('Company');
    $this -> Auth -> allow('getCompanies');
  }
  /**
   * Method to get all companies
   */
  public function getCompanies(){
    if($this -> request -> is('get')){
      //print_r($this -> request);
      // return false;
      $conditions = array('Company.company_name LIKE' => '%'.$this->request->query['name'].'%');
      $fields = array('Company.id','Company.company_name');
      if(!empty($this->request->query['notIn'])){
        $notIn['NOT'] = $this->request->query['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      if($companies = $this -> Company -> find('list', array('conditions'=>$conditions,'fields'=>$fields))){
        $this -> set('results',$companies);
      } else {
        $this -> set('results','Could not find what you are looking for');
      }
    } else {
      $this -> set('results','Could not find what you are looking for');
    }
  }
}
