<?php
//import Controller Class
App::uses('AppController', 'Controller');
/**
 * Class for ajax request
 */
class AjaxController extends AppController {
  public $noImage = 'http://colombo.vn/EStore/Market/skins/Colombo/images/no-image-news.gif';
  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> layout = 'ajax';
    $this -> loadModel('Company');
    $this -> loadModel('Video');
    $this -> loadModel('Skater');
    $this -> Auth -> allow('getCompanies','getVideos','getSkaters','getMetatags');
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
      $fields = array('Company.id','Company.name',"IFNULL(CompanyPostImage.url,'$this->noImage') AS url");
      $joins = array(
        array(
          'table' => 'company_post_images',
          'alias' => 'CompanyPostImage',
          'type' => 'LEFT',
          'conditions' => array(
            'Company.profile_img_id = CompanyPostImage.id',
          )
        )
       );
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Company.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $companies = $this -> Company -> find('all', array('conditions'=>$conditions,'fields'=>$fields,'joins'=>$joins));
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
      $fields = array('Video.id','Video.name',"IFNULL(VideoPostImage.img_url,'$this->noImage') AS url");
      $joins = array(
        array(
          'table' => 'video_post_images',
          'alias' => 'VideoPostImage',
          'type' => 'LEFT',
          'conditions' => array(
            'Video.profile_img_id = VideoPostImage.id',
          )
        )
       );
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Video.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $videos = $this -> Video -> find('all', array('conditions'=>$conditions,'fields'=>$fields,'joins'=>$joins));
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
      $fields = array('Skater.id','Skater.name',"IFNULL(SkaterPostImage.url,'$this->noImage') AS url");
      $joins = array(
        array(
          'table' => 'skater_post_images',
          'alias' => 'SkaterPostImage',
          'type' => 'LEFT',
          'conditions' => array(
            'Skater.profile_img = SkaterPostImage.id',
          )
        )
       );
      if(!empty($this->request->data['notIn'])){
        $notIn['NOT']['Skater.id'] = $this->request->data['notIn'];
        $conditions = array_merge($conditions,$notIn);
      }
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $skaters = $this -> Skater -> find('all', array('conditions'=>$conditions,'joins'=>$joins,'fields'=>$fields));
        if(empty($skaters)){
          $skaters = $errorMessage;
        } 
        $this -> set('results',$skaters);
      } catch(Exception $e){
        $this -> set('results',$errorMessage);
      }
    } else {
      $this -> set('results',$errorMessage);
    }
  }
  
  /**
   * Method to get meta og tags
   */
  public function getMetatags(){
    $result = array();
    $url = $this->request -> query['link'];
    if($this -> request -> is('get')){
      $result = $this -> Utility -> getMetatags($url);
    }
    
    $this -> set('results',$result);
  }
  /**
   * Method to get edit form of information
   */
  public function getEditInfoForm(){
    
  }
}
