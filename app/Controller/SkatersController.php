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
    $this -> loadModel('AllPostContent');
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
      $firstname = $this -> request -> data['Skater']['firstname'];
      $middlename = $this -> request -> data['Skater']['middlename'];
      $lastname = $this -> request -> data['Skater']['lastname'];
      
      $this -> request -> data['Skater']['alias'] = $this -> Utility -> stringURLSafe($firstname.'_'.$lastname);
      $this -> request -> data['Skater']['created_date'] = $this -> Utility -> dateToSql();
      
      $this -> Skater -> set($this -> request -> data);
      //validate skater data, prepair to insert into database
      if($this -> Skater -> validates()){
        //check whether there is a photo to be uploaded
        if(!empty($this -> request -> data['AllPostContent']['cover_photo']['name'])){
          
          $image = $this -> request -> data['AllPostContent']['cover_photo'];
          
          if($this -> request -> data['AllPostContent']['img_url'] = $this -> Utility -> upload($image['name'],$image['tmp_name'],$image['size'],array('jpg','png'))){
            
            if($this -> AllPostContent -> save($this -> request -> data) ){
              $this -> request -> data['Skater']['profile_img_id'] = $this -> AllPostContent -> getInsertID();
            }
          } else {
            
            $this -> Session -> setFlash(__('There are some problems while uploading, please try again.'), 'alert/default', array('class' => 'alert'));
          }
        }
        
        if($this -> Skater -> save($this -> request -> data)){
          
          
        } else {
          
          return $this -> Session -> setFlash(__('There is error while trying to save skater, Please try again.'), 'alert/default', array('class' => 'alert'));
        }
      } else {
        
        return $this -> Session -> setFlash($this -> Skater -> validationErrors, 'alert/default', array('class' => 'alert'));
      }
    }
  }

}
