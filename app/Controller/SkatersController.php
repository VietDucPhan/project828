<?php
//import Controller Class
App::uses('AppController', 'Controller');

class SkatersController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> loadModel('SkaterSponsor');
    $this -> loadModel('SkaterVideo');
    $this -> loadModel('SkaterPostImage');
    $this -> Auth -> allow('profile','add');
  }
  
  /**
   * Method to show a skater profile
   */
  public function profile($id = ''){
    $url = Router::url('/',true);
    if(!empty($id)){
      $isOwned['isOwned'] = false;
      $skaterData = $this -> Skater -> findById($id);
      if(empty($skaterData)){
        $this -> Session -> setFlash(__('Skater is not exist'), 'alert/default', array('class' => 'alert'));
        return $this->redirect($url);
      }
      
      if($this -> Auth -> user('skater_id') === $id){
        $isOwned['isOwned'] = true;
      }
      //merge array toghether
      $data = array_merge($skaterData,
                          $isOwned
                          );
      //set data for view
      $this -> set('skaterData',$data);
    } elseif($this -> Auth -> user('id')) {//if user logedin redirect to their skater profile
      if($skaterData = $this -> Skater -> findByIsOwnedBy($this -> Auth -> user ('id'))){
        $url = Router::url(array('controller' => 'users','action' => 'profile', $skaterData['Skater']['id']),true);
      }
      return $this -> redirect($url);
    } else {//if not logedin user rediret them to homepage
      return $this -> redirect($url);
    }
  }

  /**
   * Method to create skater
   */
  public function add(){
    $url = Router::url('/',true);
    if($this -> request -> is('post')){
      $isCreatedBy = null;
      $alias = $this -> request -> data['Skater']['firstname'] . '_' . $this -> request -> data['Skater']['lastname'];
      $this -> request -> data['Skater']['alias'] = $this -> Utility -> stringUrlSafe($alias);
      $this -> Skater -> set($this -> request -> data);
      if($this -> Skater -> validates()){
        if(!empty($this -> request -> data['Skater']['profile_image']['name'])){
          $image = $this -> request -> data['Skater']['profile_image'];
          if($url_img = $this -> Utility -> upload($image['name'],$image['tmp_name'],$image['size'],array('jpg','png'))){
            $postImageData = array();
            $postImageData['SkaterPostImage']['url'] = $url_img;
            $postImageData['SkaterPostImage']['is_owned_by_skater'] = 0;
            $postImageData['SkaterPostImage']['posted_by_skater'] = $isCreatedBy;
            $postImageData['SkaterPostImage']['created_date'] = $this -> Utility -> dateToSql();
            if($this -> SkaterPostImage -> save($postImageData)){
              $this -> request -> data['Skater']['profile_img'] = $this -> SkaterPostImage -> getInsertID();
            }
          }
        }
        if($this -> Skater -> save($this -> request -> data)){
          //insert sponsors
          
          if(!empty($this -> request -> data['Skater']['sponsors'])){
            $sponsors = array_unique($this -> request -> data['Skater']['sponsors']);
            foreach($sponsors as $k => $v){
              $sponsorData = array();
              $sponsorData['SkaterSponsor']['id'] = 0;
              $sponsorData['SkaterSponsor']['company_id'] = $v;
              $sponsorData['SkaterSponsor']['is_created_by_skater'] = $isCreatedBy;
              $sponsorData['SkaterSponsor']['skater_id'] = $this -> Skater -> getInsertID();
              $sponsorData['SkaterSponsor']['created_date'] = $this -> Utility -> dateToSql();
              $this -> SkaterSponsor -> save($sponsorData);
            }
          }
          //insert videos
          
          if(!empty($this -> request -> data['Skater']['videos'])){
            $videos = array_unique($this -> request -> data['Skater']['videos']);
            foreach($sponsors as $key => $val){
              $videoData = array();
              $videoData['SkaterVideo']['id'] = 0;
              $videoData['SkaterVideo']['video_id'] = $v;
              $videoData['SkaterVideo']['is_created_by_skater'] = $isCreatedBy;
              $videoData['SkaterVideo']['skater_id'] = $this -> Skater -> getInsertID();
              $videoData['SkaterVideo']['created_date'] = $this -> Utility -> dateToSql();
              $this -> SkaterVideo -> save($videoData);
            }
          }
          //set image belong to the skater just created
          if($url_img){
            $this -> VideoPostImage -> save(array('VideoPostImage'=>array('is_owned_by_video'=>$this -> Video -> getInsertID())));
          }
        }
      } else {
        //data is invalid show error
        $this -> Session -> setFlash($this -> Skater -> validationErrors, 'alert/default', array('class' => 'alert'));
        return false;
      }
      //print_r($this -> request -> data);
      //echo $this -> Utility -> upload($this->request ->data['Skater']['profile_image']['name'],$this->request ->data['Skater']['profile_image']['tmp_name'],$this->request ->data['Skater']['profile_image']['size']);
      //print_r($this->request ->data);
    }
  }

}
