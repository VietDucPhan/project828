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
    $this -> loadModel('SkaterSponsor');
    $this -> loadModel('Status');
    $this -> Auth -> allow('getCompanies','getVideos','getSkaters','getMetatags','getEditInfoForm','getEditSponsorForm','addSponsor','removeSponsor');
  }
  /**
   * Method to get all companies
   */
  public function getCompanies(){
    $errorMessage = __('No results');
    
    if($this -> request -> is('post')){
      //print_r($this -> request);
      // return false;
      $notIn = $this -> SkaterSponsor -> find('list',array('conditions'=>array('SkaterSponsor.skater_id'=>$this->request->data['id']),
                  'fields'=>array('SkaterSponsor.company_id')));
      $conditions = array('Company.name LIKE' => '%'.$this->request->data['name'].'%',
            'NOT' => array('Company.id'=>$notIn));
      $fields = array('Company.id','Company.name','Company.logo');
      $joins = array(
        array(
          'table' => 'all_post_contents',
          'alias' => 'logo',
          'type' => 'LEFT',
          'conditions' => array(
            'Company.profile_img_id = logo.id',
          )
        )
       );
      //print_r($conditions);
      //print_r($this->request->query);
      try{
        $this -> Company -> virtualFields['logo'] = "IFNULL(`logo`.`img_url`,'$this->noImage')";
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
  public function getEditInfoForm($id = null){
    if(is_null($id)){
      throw new NotFoundException();
    }
    if(!$Skater = $this -> Skater -> find('first',array('conditions'=>array('Skater.id'=>$id)))){
      throw new NotFoundException(__('Cannot find skater'));
    }
    $this -> request -> data = $Skater;
    $this->set('Status',$this->Status->find('list',array('fields' => array('Status.id', 'Status.status_title_en'),)));
    $this -> set('Skater',$Skater);
  }
  /**
   * Method to edit sponsors
   */
  public function getEditSponsorForm($id = null){
    if(is_null($id)){
      throw new NotFoundException();
    }
    $this -> set('skaterid',$id);
    $this -> set('SkaterSponsors',$this -> SkaterSponsor -> getAllSkaterSponsor($id));
  }
  /**
   * add sponsor
   */
  public function addSponsor(){
    
    if($this -> request -> is('post')){
      //echo $this -> SkaterSponsor -> find('count',array('conditions'=>array('SkaterSponsor.skater_id'=>$this -> request -> data['id'],'SkaterSponsor.company_id'=>$this -> request -> data['sponsor'])));
      if($this -> SkaterSponsor -> find('count',array('conditions'=>array('SkaterSponsor.skater_id'=>$this -> request -> data['id'],'SkaterSponsor.company_id'=>$this -> request -> data['sponsor']))) === 0){
        
        if($this -> SkaterSponsor -> save(array('SkaterSponsor'=>array('company_id'=>$this -> request -> data['sponsor'],'skater_id'=>$this -> request -> data['id'])))){
          $Comapny = $this -> Company -> find('first',array('conditions'=>array('Company.id'=>$this -> request -> data['sponsor'])));
          return $this -> set('result',array('succeed'=>true, 'html'=>'<div class="row"><div class="large-9 medium-9 small-9 columns">'.$Comapny['Company']['name'].'</div><div class="large-3 medium-3 small-3 columns"><span class="remove-sponsor button radius" data-id="'.$this -> request -> data['id'].'" data-sponsor="'.$this -> request -> data['sponsor'].'" href="'.Router::url('/ajax/removeSponsor/'.$this -> request -> data['id'].'/'.$this -> request -> data['sponsor']).'">delete</span></div></div>'));
        } else {
          return $this -> set('result',array('succeed'=>false));
        }
        
      } else {
        return $this -> set('result',array('succeed'=>false));
      }
    }
    return $this -> set('result',array('succeed'=>false));
  }
  /**
   * Method remove skater sponsor 
   * @param int $skater_id
   * @param int $company_id
   */
  public function removeSponsor($skater_id,$company_id){
    $result = false;
    if($this -> request -> is('get')){
      if($this -> SkaterSponsor -> deleteAll(array('skater_id'=>$skater_id,'company_id'=>$company_id),false)){
        $result = true;
      }
    }
    return $this -> set('result',$result);
  }
}
