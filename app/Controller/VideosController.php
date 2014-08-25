<?php
//import Controller Class
App::uses('AppController', 'Controller');

class VideosController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> loadModel('VideoPostImage');
    $this -> loadModel('CompanyVideo');
    $this -> loadModel('SkaterVideo');
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
      //return print_r($this -> request -> data);
      //print_r($this -> request -> data);
      if($this -> Video -> validates()){
        $url_img = '';
        $videoImageData = array();
        $videoImageData['VideoPostImage']['is_owned_by_video'] = 0;
        $videoImageData['VideoPostImage']['posted_by_skater'] = $isCreatedBy;
        $videoImageData['VideoPostImage']['desc'] = $this -> request -> data['Video']['desc'];
        
        $videoImageData['VideoPostImage']['created_date'] = $this -> Utility -> dateToSql();
        
        if(!empty($this -> request -> data['Video']['link_image'])){
          $url_img = $this -> request -> data['Video']['link_image'];
          $videoImageData['VideoPostImage']['img_url'] = $url_img;
        } 
        
        if(!empty($this -> request -> data['Video']['profile_image']['name'])){
          $image = $this -> request -> data['Video']['profile_image'];
          if($url_img = $this -> Utility -> upload($image['name'],$image['tmp_name'],$image['size'],array('jpg','png'))){
            $videoImageData['VideoPostImage']['img_url'] = $url_img;
          }
        }
        
        if(!empty($url_img)){
           if($this -> VideoPostImage -> save($videoImageData)){
              $this -> request -> data['Video']['profile_img_id'] = $this -> VideoPostImage -> getInsertID();
            }
        }
        if($this -> Video -> save($this -> request -> data)){
          if(!empty($this->data['Video']['companies'])){
            $videoCompanies = array_unique($this->data['Video']['companies']);
            $companyVideo['CompanyVideo']['id'] = 0;
            $companyVideo['CompanyVideo']['video_id'] = $this->Video->getInsertID();
            $companyVideo['CompanyVideo']['created_date'] = $this -> Utility -> dateToSql();
            $companyVideo['CompanyVideo']['is_created_by_skater'] = $isCreatedBy;
            foreach($videoCompanies as $k => $v){
              $companyVideo['CompanyVideo']['company_id'] = $v;
              $this -> CompanyVideo -> save($companyVideo);
            }
          }
          
          if(!empty($this->data['Video']['skaters'])){
            $videoSkaters = array_unique($this->data['Video']['skaters']);
            $skaterVideo['SkaterVideo']['id'] = 0;
            $skaterVideo['SkaterVideo']['video_id'] = $this->Video->getInsertID();
            $skaterVideo['SkaterVideo']['created_date'] = $this -> Utility -> dateToSql();
            $skaterVideo['SkaterVideo']['is_created_by_skater'] = $isCreatedBy;
            foreach($videoSkaters as $key => $val){
              $skaterVideo['SkaterVideo']['skater_id'] = $val;
              $this -> SkaterVideo -> save($skaterVideo);
            }
          }
          if(!empty($url_img)){
            $this -> VideoPostImage -> save(array('VideoPostImage'=>array('is_owned_by_video'=>$this->Video->getInsertID())));
          }
        }
      } else {
        return $this -> Session -> setFlash($this -> Video -> validationErrors, 'alert/default', array('class' => 'alert'));
      }
    }
  }
}
