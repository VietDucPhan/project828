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
    $this -> Auth -> allow('profile','add');
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
      
      $SkaterSponsor = $this -> SkaterSponsor -> find('all',array('conditions'=>array('SkaterSponsor.skater_id'=>$Skater['Skater']['id'])));
      //get all contents were posted by this skater or other skaters to this skater
      $contentBelongToSkater = $this -> ContentSkaterRelation -> getContentBelongToSkater($Skater['Skater']['id']);
      if($Skater['Skater']['stance'] == 0){
        $Skater['Skater']['stance'] = __('Regular');
      } else {
        $Skater['Skater']['stance'] = __('Goofy');
      }
      
      switch ($Skater['Skater']['status']) {
        case 0:
          $Skater['Skater']['status'] = __('Pro');
          break;
        case 1:
          $Skater['Skater']['status'] = __('Am');
          break;
        case 2:
          $Skater['Skater']['status'] = __('Flow');
          break;
        default:
          $Skater['Skater']['status'] = __('Just skater');
          break;
      }
      $this -> set('Skater',$Skater);
      $this -> set('AllPost',count($contentBelongToSkater));
    }
    catch(Exception $e) {
      print_r($e);
      $this -> layout = 'error';
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
          //$this -> Utility -> upload($image['name'],$image['tmp_name'],$image['size'],array('jpg','png')
          if($this -> request -> data['AllPostContent']['img_url'] = '/img/cake.power.gif'){
            
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

}
