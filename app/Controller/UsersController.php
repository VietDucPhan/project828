<?php
//import Controller Class
App::uses('AppController', 'Controller');

class UsersController extends AppController {
  public function beforeSave($options = array()) {
    if (isset($this -> data[$this -> alias]['password'])) {
      $passwordHasher = new SimplePasswordHasher();
      $this -> data[$this -> alias]['password'] = $passwordHasher -> hash($this -> data[$this -> alias]['password']);
    }
    return true;
  }

  /**
   * Method to authorize access
   */
  public function beforeFilter() {
    $this -> Auth -> allow('login');
  }

  /**
   * Controller method to login a user
   */
  public function login() {
    if ($this -> request -> is('post')) {
      if ($this -> Auth -> login()) {
        return $this -> redirect($this -> Auth -> redirectUrl());
        // Prior to 2.3 use
        // `return $this->redirect($this->Auth->redirect());`
      } else {
        $this -> Session -> setFlash(__('Username or password is incorrect'), 'alert/default', array('class' => 'alert'));
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
    //only working with post data
    $url = Router::url('/', true);
    if ($this -> request -> is('post')) {

      //set data to user model
      $this -> User -> set($this -> request -> data);
      //attempt to validate data
      if ($this -> User -> validates()) {
        //hash password with sha1
        $this -> request -> data['password'] = Security::hash($this -> request -> data['password'], 'blowfish', false);
        $this -> request -> data['registerDate'] = $this -> Utility -> dateToSql();
        $this -> request -> data['activation'] = Security::hash($this -> Utility -> uniqueSeed());
        //data is safe to insert to databse
        if ($this -> User -> save($this -> request -> data)) {

          $activateLink = Router::url(array('controller' => 'users', 'action' => 'activate', $this -> request -> data['activation']), true);
          //send email
          $this -> Email -> confirm($this -> request -> data['email'], $activateLink);
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

      if ($this -> Utility -> validateEmail($email = $this -> request -> data['email'])) {

        if ($userData = $this -> User -> findByEmail($email)) {
          $resetData['id'] = $userData['User']['id'];
          $resetData['resetCode'] = Security::hash($this -> Utility -> uniqueSeed(), 'md5', true);
          $resetData['lastResetTime'] = $this -> Utility -> dateToSql();

          $resetLink = Router::url(array('controller' => 'users', 'action' => 'recover', $resetData['resetCode']), true);

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
      $editUser['activation'] = '0';
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
  public function recover($code = '') {
    $url = Router::url('/', true);

    if ($this -> request -> is('post')) {
      $this -> User -> set($this -> request -> data['User']);
      $conditions = array('User.resetCode' => $this -> request -> data['User']['resetCode'], 'User.lastResetTime <' => 'date_sub(now(), 24 hours)');
      if ($userData = $this -> User -> find('first', array('conditions' => $conditions))) {
        if ($this -> User -> validates(array('fieldList' => array('password', 'resetCode')))) {
          $data['id'] = $userData['User']['id'];
          $data['password'] = Security::hash($this -> request -> data['User']['password'], 'sha1', true);
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
