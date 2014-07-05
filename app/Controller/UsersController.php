<?php
//import Controller Class
App::uses('AppController', 'Controller');

class UsersController extends AppController {
  /**
   * Controller function to register a user
   */
  public function register(){
    //only working with post data
    $url = Router::url('/',true);
    if($this->request->is('post')){
      //hash password with sha1
      $this->request->data['password'] = Security::hash($this->request->data['password'],'sha1',true);
      $this->request->data['registerDate'] = date('d-m-Y H:i:s');
      $this->request->data['activation'] = Security::hash($this->Utility->uniqueSeed());
      //set data to user model
      $this->User->set($this->request->data);
      //attempt to validate data
      if($this->User->validates()){
        //data is safe to insert to databse
        if($this->User->save($this->request->data)){
          
        }
      } else {
        //data is invalid show error
        $this->Session->setFlash($this->User->validationErrors,'alert/default',array('class'=>'alert'));
      }
    } else {
      $this->Session->setFlash(__('There is something happened while register, Please do it again later'),'alert/default',array('class'=>'alert'));
      $this->redirect($url);
    }
    
  }
}
