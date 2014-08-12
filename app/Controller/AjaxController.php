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
      $fields = array('Company.id','Company.name','Company.created_date','CompanyPostImage.url');
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Company.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $companies = $this -> Company -> find('all', array('conditions'=>$conditions,'fields'=>$fields));
        if(empty($companies)){
          $results = $errorMessage;
        } else {//rearrange the outcome
          $results = array();
          foreach($companies as $company){
            $company['Company']['url'] = 'http://colombo.vn/EStore/Market/skins/Colombo/images/no-image-news.gif';
            if(!empty($company['CompanyPostImage']['url'])){
              $company['Company']['url'] = $company['CompanyPostImage']['url'];
            }
            unset($company['CompanyPostImage']);
            $results[] = $company;
          }
        }
        $this -> set('results',$results);
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
      $fields = array('Video.id','Video.name','VideoPostImage.url');
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Video.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $videos = $this -> Video -> find('all', array('conditions'=>$conditions,'fields'=>$fields));
        if(empty($videos)){
          $results = $errorMessage;
        } else {//rearrange the outcome
          $results = array();
          foreach($videos as $video){
            $video['Video']['url'] = 'http://colombo.vn/EStore/Market/skins/Colombo/images/no-image-news.gif';
            if(!empty($video['VideoPostImage']['url'])){
              $video['Video']['url'] = $video['VideoPostImage']['url'];
            }
            unset($video['VideoPostImage']);
            $results[] = $video;
          }
        }
        $this -> set('results',$results);
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
      $fields = array('Skater.id','CONCAT(Skater.firstname," ",Skater.lastname) AS name','SkaterPostImage.url');
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Skater.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $skaters = $this -> Skater -> find('all', array('conditions'=>$conditions,'fields'=>$fields));
        if(empty($skaters)){
          $results = $errorMessage;
        } else {//rearrange the outcome
          $results = array();
          foreach($skaters as $skater){
            $skater['Skater']['url'] = 'http://colombo.vn/EStore/Market/skins/Colombo/images/no-image-news.gif';
            if(!empty($skater['SkaterPostImage']['url'])){
              $skater['Skater']['url'] = $skater['SkaterPostImage']['url'];
            }
            unset($skater['SkaterPostImage']);
            $results[] = $skater;
          }
        }
        $this -> set('results',$results);
      } catch(Exception $e){
        $this -> set('results',$errorMessage);
      }
    } else {
      $this -> set('results',$errorMessage);
    }
  }
}
