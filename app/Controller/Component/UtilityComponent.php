<?php

App::uses('Component', 'Controller');
App::uses('Security', 'Utility');
App::uses('Session', 'Utility');
App::import('Vendor', 'aws-autoloader', array('file' => 'aws' . DS . 'aws-autoloader.php'));
use Aws\Common\Aws;
class UtilityComponent extends Component {
  public $components = array('Session');
  /**
   * Create a random seed
   * @return int
   */
  public function uniqueSeed() {
    return uniqid(mt_rand(), true);
  }

  /**
   * Method to upload image to amazon s3
   * @return image s3 url
   */
  public function uploadImage($name, $tmp_name, $size, $limitsize = 4000000, $allowedExtension = array('jpg','gif','png')) {
    $aws = Aws::factory(array('key' => AWS_ACCESS_KEY_ID, 'secret' => AWS_BUCKET_KEY));
    $s3Client = $aws -> get('S3');
    
    $arrayName = explode('.', $name);
    $fileExtension = $arrayName[1];
    $name = Security::hash($this->uniqueSeed(),'sha1').'.'.$fileExtension;
    
    if(!in_array($fileExtension, $allowedExtension)){
      $this -> Session -> setFlash(__('File type is not supported'), 'alert/default', array('class' => 'alert'));
      return false;
    }
    
    if($size > $limitsize){
      $this -> Session -> setFlash(__('File size is too big'), 'alert/default', array('class' => 'alert'));
      return false;
    }
    
    
    if($upload = $s3Client -> putObject(array('Bucket' => AWS_BUCKET_KEY, 'Key' => $name, 'Body' => fopen($tmp_name, 'rb'), 'ACL' => 'public-read'))){
      return htmlspecialchars($upload -> get('ObjectURL'));
    }
    
    return false;
  }

  /**
   * Method to return datetime sql format
   * @param string $time string of date to convert
   * @return string in sql format datetime Y-m-d H:i:s
   */
  public function dateToSql($time = 'now') {
    return date('Y-m-d H:i:s', strtotime($time));
  }

  /**
   * Method to reorder multiple images uploaded.
   * @param array $files an array contains files uploaded
   * @return array array of files were re-ordered
   */
  public static function reorderImageArrayFiles($files) {
    if (is_null($files) || empty($files)) {
      return false;
    }
    $numberOfImages = count($files['name']);
    $reorderedImages = array();
    for ($i = 0; $i < $numberOfImages; $i++) {
      if (isset($files['name'][$i]) && isset($files['type'][$i]) && isset($files['tmp_name'][$i]) && $files['error'][$i] == 0) {
        $data['name'] = $files['name'][$i];
        $data['type'] = $files['type'][$i];
        $data['tmp_name'] = $files['tmp_name'][$i];
        $data['error'] = $files['error'][$i];
        $data['size'] = $files['size'][$i];
        $reorderedImages[] = $data;
      }
    }
    return $reorderedImages;
  }

  /**
   * Method to validate email address
   * @param string $email email address
   * @return boolean true or false
   */
  public static function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }
    return true;
  }

  /**
   * Method to check whether a website are real
   * @param string $url the website address
   * @return boolean true on success
   */
  public static function validateUrl($url) {
    $agent = "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_8; pt-pt) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27";
    // initializes curl session
    $ch = curl_init();
    // sets the URL to fetch
    curl_setopt($ch, CURLOPT_URL, $url);
    // sets the content of the User-Agent header
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // disable output verbose information
    curl_setopt($ch, CURLOPT_VERBOSE, false);

    // max number of seconds to allow cURL function to execute
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    curl_exec($ch);

    // get HTTP response code
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpcode >= 200 && $httpcode < 300)
      return true;
    else
      return false;
  }

  /**
   * Method to limit number of words
   * @param string $string of words
   * @param int $num_words number of word to appear
   */
  public static function limitWords($string, $num_words = 100) {
    //Pull an array of words out from the string (you can specify what delimeter you'd like)
    $array_of_words = explode(" ", $string);
    $output = "";
    //Loop the array the requested number of times and build an output, re-inserting spaces.
    for ($i = 0; $i <= $num_words; $i++) {
      if (isset($array_of_words[$i])) {
        $output .= $array_of_words[$i] . " ";
      }

    }
    return trim($output);
  }

}
?>