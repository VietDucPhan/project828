<?php
//import Controller Class
App::uses('AppController', 'Controller');

class SkatersController extends AppController {
  
  public $noImage = 'http://colombo.vn/EStore/Market/skins/Colombo/images/no-image-news.gif';
  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> loadModel('AllPostContent');
    $this -> loadModel('SkaterSponsor');
    $this -> loadModel('ContentSkaterRelation');
    $this -> loadModel('Status');
    $this -> Auth -> allow('profile','add','edit','addVideo');
  }
  
  /**
   * Method to show a skater profile
   */
  public function profile($alias = null){
    try {
      if(is_numeric($alias)){
        if(!$skaterData = $this -> Skater -> find('first',array('conditions'=>array('Skater.id'=>$alias)))){
          throw new Exception(__('This skater id does not exist'));
        }
        $url = Router::url('/skater/'.$skaterData['Skater']['alias'],true);
        $this -> redirect($url);
      }
      
      if(!$Skater = $this -> Skater -> find('first',array('conditions'=>array('Skater.alias'=>$alias)))){
        throw new Exception(__('Cannot find skater'));
      }
      
      $SkaterSponsor = $this -> SkaterSponsor -> getAllSkaterSponsor($Skater['Skater']['id']); //$this -> SkaterSponsor -> find('all',array('conditions'=>array('SkaterSponsor.skater_id'=>$Skater['Skater']['id'])));
      //get all contents were posted by this skater or other skaters to this skater
      $contentBelongToSkater = $this -> Skater -> getContentBelongToSkater($Skater['Skater']['id']);
      
      if($Skater['Skater']['stance'] == 0){
        $Skater['Skater']['stance'] = __('Regular');
      } else {
        $Skater['Skater']['stance'] = __('Goofy');
      }
      
      //print_r($result);
      $this -> set('Skater',$Skater);
      $this -> set('SkaterSponsors',$SkaterSponsor);
      $this -> set('AllPostCount',count($contentBelongToSkater));
      //print_r($contentBelongToSkater);
    }
    catch(Exception $e) {
      //return print_r($e->getMessage());
      $this -> layout = 'error';
    }
  }

  /**
   * Method to create skater
   */
  public function add(){
    $url = Router::url('/',true);
    $this->set('Status',$this->Status->find('list',array('fields' => array('Status.id', 'Status.status_title_en'),)));
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
          $img_url = $this -> Utility -> upload($image['name'],$image['tmp_name'],$image['size'],array('jpg','png'));
          if($this -> request -> data['AllPostContent']['img_url'] = $img_url){
            
            if($this -> AllPostContent -> save($this -> request -> data) ){
              $this -> request -> data['Skater']['profile_img_id'] = $this -> AllPostContent -> getInsertID();
            }
          } else {
            
            $this -> Session -> setFlash(__('There are some problems while uploading, please try again.'), 'alert/default', array('class' => 'alert'));
          }
        }
        
        if($this -> Skater -> save($this -> request -> data)){
          
          $this -> request -> data['ContentSkaterRelation']['skater_id'] = $this -> Skater -> getInsertID();
          $this -> request -> data['ContentSkaterRelation']['content_id'] = $this -> AllPostContent -> getInsertID();
          if($this -> ContentSkaterRelation -> save($this -> request -> data)){
            
            $url = Router::url('/skater/'.$this -> request -> data['Skater']['alias'] ,true);
            return $this -> redirect($url);
          } else {
            
            return $this -> Session -> setFlash(__('There is error while trying to save skater and image'), 'alert/default', array('class' => 'alert'));
          }
        } else {
          
          return $this -> Session -> setFlash(__('There is error while trying to save skater, Please try again.'), 'alert/default', array('class' => 'alert'));
        }
      } else {
        
        return $this -> Session -> setFlash($this -> Skater -> validationErrors, 'alert/default', array('class' => 'alert'));
      }
    }
  }
  
  /**
   * Method to edit skater information
   */
   public function edit($id = null){
     if(is_null($id)){
       throw new NotFoundException();
     }
     if($this -> request -> is('post') || $this -> request -> is('put')){
       $conditions['Skater.id'] = $id;
       if($this -> Auth -> user ('skater_id') != $id){
         $conditions['Skater.allowed_publish_edit'] = 1;
       }
      
       if(!$this -> Skater -> find('all',array('conditions' => $conditions))){
         $url = Router::url('/skater/'.$id ,true);
         $this->redirect($url);
       }
      
      
       $this -> request -> data['Skater']['id'] = $id;
       //validate skater data, prepair to insert into database
       if($this -> Skater -> save($this -> request -> data)){
         $url = Router::url('/skater/'.$id ,true);
         $this->redirect($url);
       } else {
         return $this -> Session -> setFlash($this -> Skater -> validationErrors, 'alert/default', array('class' => 'alert'));
       }
     }
   }
   
   /**
    * Method to add video
    */
   public function addVideo(){
     if($this -> request -> is('post')){
       if($og = $this -> Utility -> getMetatags($this -> request -> data['AllPostContent']['video_link'])){
         //return print_r($og);
         //get video image
         
         
         if(!empty($this -> request -> data['AllPostContent']['img_url']['name'])){
           $image = $this -> request -> data['AllPostContent']['img_url'];
           if(!$this -> request -> data['AllPostContent']['img_url'] = $this -> Utility -> upload($image['name'],$image['tmp_name'],$image['size'],array('jpg','png'))){
             $this -> request -> data['AllPostContent']['img_url'] = $og['og']['image'];
           }
         } else {
           $this -> request -> data['AllPostContent']['img_url'] = $og['og']['image'];
         }
         
         //get video desc
         if(empty($this -> request -> data['AllPostContent']['desc'])){
           $this -> request -> data['AllPostContent']['desc'] = $og['og']['description'];
         }

         $this -> request -> data['AllPostContent']['video_embed'] = $og['og']['embed'];
         $this -> request -> data['AllPostContent']['video_title'] = $og['og']['title'];
         $this -> request -> data['AllPostContent']['is_added_by_skater'] = 0;
         $this -> request -> data['AllPostContent']['content_type'] = 2;
         $this -> request -> data['AllPostContent']['created_date'] = $this -> Utility -> dateToSql();
         
         if($this -> AllPostContent -> save($this -> request -> data)){
           $this -> request -> data['ContentSkaterRelation']['content_id'] = $this -> AllPostContent -> getInsertID();
           if($this -> ContentSkaterRelation -> save($this -> request -> data)){
             $url = Router::url('/skater/'.$this -> request -> data['ContentSkaterRelation']['skater_id'] ,true);
             return $this -> redirect($url);
           }
         }
       }
     }
   }
   

}
