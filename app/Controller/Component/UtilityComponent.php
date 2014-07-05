<?php

App::uses('Component', 'Controller');

class UtilityComponent extends Component {
  /**
   * Create a random seed
   * @return int
   */
  public function uniqueSeed(){
    return uniqid(mt_rand(), true);
  }
  /**
   * Send confirmation email to user
   * @param string $to Receiver email
   * @param array $body Email content including username, activation url
   */
  public function sendConfirmationEmail($to,$body){
    $from = NOREPLY_EMAIL;
    $subject = 'User confirmation';
    //declare email class
    $email = new CakeEmail();
    //config email
    $email->from($from);
    $email->to($this->request->data['email']);
    $email->addBcc(BCC,'Admin');
    $email->subject($subject . ' - ' . SITENAME);
    $email->send($body);
  }
}
?>