<?php
//import Controller Class
App::uses('AppController', 'Controller');

class SkatersController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
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
        $this -> Session -> write('Auth.User.username',$skaterData['Skater']['username']);
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
    if($this -> request -> is('post')){
      
    }
  }

}
