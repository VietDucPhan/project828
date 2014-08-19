<?php
//import Controller Class
App::uses('AppController', 'Controller');

class VideosController extends AppController {

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
      
      $this -> request -> data['Company']['alias'] = $this -> Utility -> stringURLSafe($this -> request -> data['Company']['name']);
      $this -> request -> data['Company']['launched_year'] = $this -> request -> data['Company']['launched_year']['year'];
      $this -> request -> data['Company']['closed_year'] = $this -> request -> data['Company']['closed_year']['year'];
      $this -> request -> data['Company']['created_date'] = $this -> Utility -> dateToSql();
      $this -> Company -> set($this -> request -> data);
      if($this -> Company -> validates()){
        if(!empty($this -> request -> data['Company']['profile_image']['name'])){
          $image = $this -> request -> data['Company']['profile_image'];
          if($url_img = $this -> Utility -> upload($image['name'],$image['tmp_name'],$image['size'],array('jpg','png'))){
            $postImageData = array();
            $postImageData['CompanyPostImage']['url'] = $url_img;
            $postImageData['CompanyPostImage']['is_owned_by_company'] = 0;
            $postImageData['CompanyPostImage']['posted_by_skater'] = $isCreatedBy;
            $postImageData['CompanyPostImage']['created_date'] = $this -> Utility -> dateToSql();
            if($this -> CompanyPostImage -> save($postImageData)){
              $this -> request -> data['Company']['profile_img_id'] = $this -> CompanyPostImage -> getInsertID();
            }
          }
        }
        if($this -> Company -> save($this -> request -> data)){
          //insert sponsors
          
          if(!empty($this -> request -> data['Company']['sponsors'])){
            $sponsors = array_unique($this -> request -> data['Company']['sponsors']);
            foreach($sponsors as $k => $v){
              $sponsorData = array();
              $sponsorData['SkaterSponsor']['id'] = 0;
              $sponsorData['SkaterSponsor']['company_id'] = $this -> Company -> getInsertID();
              $sponsorData['SkaterSponsor']['is_created_by_skater'] = $isCreatedBy;
              $sponsorData['SkaterSponsor']['skater_id'] = $v;
              $sponsorData['SkaterSponsor']['created_date'] = $this -> Utility -> dateToSql();
              $this -> SkaterSponsor -> save($sponsorData);
            }
          }
          
          if(!empty($this -> request -> data['Company']['videos'])){
            $sponsors = array_unique($this -> request -> data['Company']['videos']);
            foreach($sponsors as $k => $v){
              $videoData = array();
              $videoData['CompanyVideo']['id'] = 0;
              $videoData['CompanyVideo']['company_id'] = $this -> Company -> getInsertID();
              $videoData['CompanyVideo']['is_created_by_skater'] = $isCreatedBy;
              $videoData['CompanyVideo']['video_id'] = $v;
              $videoData['CompanyVideo']['created_date'] = $this -> Utility -> dateToSql();
              $this -> CompanyVideo -> save($videoData);
            }
          }

          if($url_img){
            $arrayCompanyPostImage['CompanyPostImage']['is_owned_by_company'] = $this -> Company -> getInsertID();
            $this -> CompanyPostImage -> save($arrayCompanyPostImage);
          }
        }
      }
    }
  }
}
