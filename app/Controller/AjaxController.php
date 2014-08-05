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
    $errorMessage = __('No results');
    if($this -> request -> is('get')){
      //print_r($this -> request);
      // return false;
      $conditions = array('Company.name LIKE' => '%'.$this->request->query['name'].'%');
      $fields = array('Company.id','Company.name','Company.created_date');
      if(!empty($this->request->query['notIn'])){
        $notIn['NOT'] = $this->request->query['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $companies = $this -> Company -> find('all', array('conditions'=>$conditions,'fields'=>$fields));
        if(empty($companies)){
          $companies = $errorMessage;
        }
        $this -> set('results',$companies);
      } catch(Exception $e){
        $this -> set('results',$errorMessage);
      }
    } else {
      $this -> set('results',$errorMessage);
    }
  }
}
