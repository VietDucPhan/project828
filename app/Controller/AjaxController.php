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
    $this -> loadModel('Video');
    $this -> loadModel('Skater');
    $this -> Auth -> allow('getCompanies','getVideos','getSkaters');
  }
  /**
   * Method to get all companies
   */
  public function getCompanies(){
    $errorMessage = __('No results');
    if($this -> request -> is('post')){
      //print_r($this -> request);
      // return false;
      $conditions = array('Company.name LIKE' => '%'.$this->request->data['name'].'%');
      $fields = array('Company.id','Company.name','Company.created_date');
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Company.id'] = $this->request->data['notIn'];
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
  /**
   * Method to get all video
   */
  public function getVideos(){
    $errorMessage = __('No results');
    if($this -> request -> is('post')){
      //print_r($this -> request);
      // return false;
      $conditions = array('Video.name LIKE' => '%'.$this->request->data['name'].'%');
      $fields = array('Video.id','Video.name');
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Video.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $videos = $this -> Video -> find('all', array('conditions'=>$conditions,'fields'=>$fields));
        if(empty($videos)){
          $videos = $errorMessage;
        }
        $this -> set('results',$videos);
      } catch(Exception $e){
        $this -> set('results',$errorMessage);
      }
    } else {
      $this -> set('results',$errorMessage);
    }
  }
  /**
   * Method to get all skaters
   */
  public function getSkaters(){
    $errorMessage = __('No results');
    if($this -> request -> is('post')){
      //print_r($this -> request);
      // return false;
      $conditions = array('CONCAT(Skater.firstname," ",Skater.lastname) LIKE' => '%'.$this->request->data['name'].'%');
      $fields = array('id','CONCAT(Skater.firstname," ",Skater.lastname) AS name');
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Skater.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $Skaters = $this -> Skater -> find('all', array('conditions'=>$conditions));
        if(empty($Skaters)){
          $Skaters = $errorMessage;
        }
        $this -> set('results',$Skaters);
      } catch(Exception $e){
        $this -> set('results',$errorMessage);
      }
    } else {
      $this -> set('results',$errorMessage);
    }
  }
}
