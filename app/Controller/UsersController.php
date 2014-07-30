<?php
//import Controller Class
App::uses('AppController', 'Controller');

class UsersController extends AppController {

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this -> loadModel('Skater');
    $this -> Auth -> allow('login','add','changePass','reset','logout','activate','skater');
  }
  
  /**
   * Method to show a skater profile
   */
  public function skater($id = ''){
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
        $url = Router::url(array('controller' => 'users','action' => 'skater', $skaterData['Skater']['id']),true);
      }
      return $this -> redirect($url);
    } else {//if not logedin user rediret them to homepage
      return $this -> redirect($url);
    }
  }

  /**
   * Controller method to login a user
   */
  public function login() {
    if ($this -> request -> is('post')) {
      $conditions = array('User.block' => 0, 'User.activation' => '0');
      if($this -> User -> find ('count',array('conditions' => $conditions)) === 1) {
        if ($this -> Auth -> login()) {
          //add to session username if exist
          if($skaterData = $this -> Skater -> findByIsOwnedBy($this -> Auth -> user ('id'))){
            $this -> Session -> write('Auth.User.username',$skaterData['Skater']['username']);
            $this -> Session -> write('Auth.User.skater_id',$skaterData['Skater']['id']);
          }
          
          $loginData = array();
          $loginData ['User'] ['id'] = $this -> Auth -> user ('id');
          $loginData ['User'] ['lastvisitDate'] = $this -> Utility -> dateToSql();
          $this -> User ->save($loginData);
          return $this -> redirect($this -> Auth -> redirectUrl());
        } else {
          $this -> Session -> setFlash(__('Username or password is incorrect'), 'alert/default', array('class' => 'alert'));
        }
      } else {
        return $this -> redirect($this -> Auth -> redirectUrl());
      }
    }
  }

  public function logout() {
    return $this -> redirect($this -> Auth -> logout());
  }

  /**
   * Controller function to register a user
   */
  public function add() {
    $skaterData = array('Skater');
    //only working with post data
    $url = Router::url('/', true);
    if ($this -> request -> is('post')) {

      //set data to user model
      $this -> User -> set($this -> request -> data);
      //attempt to validate data
      if ($this -> User -> validates()) {

        //hash password with sha1
        $this -> request -> data ['User'] ['password'] = Security::hash($this -> request -> data ['User'] ['password'], 'blowfish', false);
        $this -> request -> data ['User'] ['registerDate'] = $this -> Utility -> dateToSql();
        $this -> request -> data ['User'] ['activation'] = Security::hash($this -> Utility -> uniqueSeed());
        //prevent unwanted user data
        unset($this -> request -> data ['User'] ['block']);
        unset($this -> request -> data ['User'] ['sendEmail']);
        //data is safe to insert to databse
        if ($this -> User -> save($this -> request -> data)) {
          $username = explode('@', $this -> request -> data ['User'] ['email']);
          $skaterData ['Skater'] ['isOwnedBy'] = $this -> User -> getInsertID();
          $skaterData ['Skater'] ['username'] = $username[0];
          $skaterData ['Skater'] ['created_date'] = $this -> Utility -> dateToSql();
          $this -> Skater -> save($skaterData);
          $activateLink = Router::url(array('controller' => 'users', 'action' => 'activate', $this -> request -> data ['User'] ['activation']), true);
          //send email
          $this -> Email -> confirm($this -> request -> data ['User'] ['email'], $activateLink);
        }
      } else {
        //data is invalid show error
        $this -> Session -> setFlash($this -> User -> validationErrors, 'alert/default', array('class' => 'alert'));
        $this -> redirect($url);
        return false;
      }
    } else {
      $this -> Session -> setFlash(__('There is something happened while register, Please do it again later'), 'alert/default', array('class' => 'alert'));
      $this -> redirect($url);
    }

  }

  /**
   * Method to reset password
   */
  public function reset() {
    $url = Router::url('/', true);
    //is post
    if ($this -> request -> is('post')) {

      if ($this -> Utility -> validateEmail($email = $this -> request -> data ['User'] ['email'])) {

        if ($userData = $this -> User -> findByEmail($email)) {
          $resetData['id'] = $userData['User']['id'];
          $resetData['resetCode'] = Security::hash($this -> Utility -> uniqueSeed(), 'md5', true);
          $resetData['lastResetTime'] = $this -> Utility -> dateToSql();

          $resetLink = Router::url(array('controller' => 'users', 'action' => 'changePass', $resetData['resetCode']), true);

          if ($this -> User -> save($resetData)) {
            $this -> Email -> reset($userData['User']['email'], $resetLink);
          } else {
            $this -> Session -> setFlash(__('Could not reset your password right now. Please try again latter'), 'alert/default', array('class' => 'alert'));
            $this -> redirect($url);
            return false;
          }

        } else {
          $this -> Session -> setFlash(__('Email doese not exist!'), 'alert/default', array('class' => 'alert'));
          $this -> redirect($url);
          return false;
        }

      } else {
        $this -> redirect($url);
        $this -> Session -> setFlash(__('Please enter email correctly'), 'alert/default', array('class' => 'alert'));
        return false;
      }
    }
    $this -> Session -> setFlash(__('An Error occured, please try again'), 'alert/default', array('class' => 'alert'));
    $this -> redirect($url);
    return false;
  }

  /**
   * Method to activate a user
   */
  public function activate($code = '') {
    $editUser = array();
    $url = Router::url('/', true);
    if ($userData = $this -> User -> findByActivation($code)) {
      $editUser['id'] = $userData['User']['id'];
      $editUser['activation'] = 0;
      if ($this -> User -> save($editUser)) {
        $this -> Session -> setFlash(__('Congratulation, Your account have been activated!'), 'alert/default', array('class' => 'notice'));
        $this -> redirect($url);
        return true;
      }
    }
    $this -> Session -> setFlash(__('Could not activate your account, please try again latter'), 'alert/default', array('class' => 'alert'));
    $this -> redirect($url);
    return false;
  }

  /**
   * Method to change password
   */
  public function changePass($code = '') {
    $url = Router::url('/', true);

    if ($this -> request -> is('post')) {
      $this -> User -> set($this -> request -> data);
      $conditions = array('User.resetCode' => $this -> request -> data['User']['resetCode'], 'User.lastResetTime <' => 'date_sub(now(), 24 hours)');
      if ($userData = $this -> User -> find('first', array('conditions' => $conditions))) {
        if ($this -> User -> validates(array('fieldList' => array('password', 'resetCode')))) {
          $data['id'] = $userData['User']['id'];
          $data['password'] = Security::hash($this -> request -> data['User']['password'], 'blowfish', false);
          $data['resetCode'] = '';
          $data['lastResetTime'] = '0000-00-00 00:00:00';

          //save data
          if ($this -> User -> save($data)) {

            $this -> Session -> setFlash(__('Congratulation, you have successfully updated your password'), 'alert/default', array('class' => 'notice'));
            $this -> redirect($url);
            return true;
          }
        } else {
          $this -> Session -> setFlash(__('Please input the correct password or use the correct link'), 'alert/default', array('class' => 'alert'));
          $this -> redirect($url);
          return false;
        }
      } else {
        $this -> Session -> setFlash(__('Sorry your request can\'t be procceded, Please request another code'), 'alert/default', array('class' => 'alert'));
        $this -> redirect($url);
        return false;
      }
    } else {
      $this -> set('code', $code);
      return true;
    }
  }

}
