<?php

App::uses('Component', 'Controller');
App::uses('Security', 'Utility');
App::uses('Session', 'Utility');
App::import('Vendor', 'aws-autoloader', array('file' => 'aws' . DS . 'aws-autoloader.php'));
use Aws\Common\Aws;
class UtilityComponent extends Component {
  public $components = array('Session');
  /**
   * public function get file content using curl
   * @param string $url
   * @return file content
   */
  public function file_get_contents_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    
    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
  }
  /**
   * Get metatags from a link
   * @param string $url 
   * @return array on success, false otherwise
   */
  public function getMetatags($url) {
    $metaTags = array(
      'og' => array('description'=>'')
    );
    if(!$html = $this->file_get_contents_curl($url)){
      return false;
    }
    //parsing begins here:
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');

    //get and display what you need:
    $title = $nodes->item(0)->nodeValue;
    $metas = $doc->getElementsByTagName('meta');
    
    for ($i = 0; $i < $metas->length; $i++){
      $meta = $metas->item($i);
      switch ($meta -> getAttribute('property')) {
        case 'og:site_name':
          $metaTags['og']['site_name'] = utf8_decode($meta->getAttribute('content'));
          break;
        case 'og:description':
          $metaTags['og']['description'] = utf8_decode($meta->getAttribute('content'));
          break;
        case 'og:title':
          $metaTags['og']['title'] = utf8_decode($meta->getAttribute('content'));
          break;
        case 'og:type':
          $metaTags['og']['type'] = $meta->getAttribute('content');
          break;
        case 'og:url':
          $metaTags['og']['url'] = $meta->getAttribute('content');
          break;
        case 'og:image':
          $metaTags['og']['image'] = $meta->getAttribute('content');
          break;
        case 'og:video':
          $metaTags['og']['video'] = $meta->getAttribute('content');
          break;
      }
    }
    if(empty($metaTags['og']['site_name'])){
      $metaTags['og']['site_name'] = $title;
    }
    switch (strtolower($metaTags['og']['site_name'])) {
      case 'youtube':
        parse_str( parse_url( $metaTags['og']['url'], PHP_URL_QUERY ), $my_array_of_vars );
        $metaTags['og']['embed'] = '<div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns"><div class="flex-video"><iframe src="//www.youtube.com/embed/'.$my_array_of_vars['v'].'" frameborder="0" allowfullscreen></iframe></div></div>';
        break;
        
      case 'vimeo':
        $vimeoId = (int) substr(parse_url($metaTags['og']['url'], PHP_URL_PATH), 1);
        $metaTags['og']['embed'] = '<div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns"><div class="flex-video"><iframe src="//player.vimeo.com/video/'.$vimeoId.'" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div></div>';
        break;
      default:
        $metaTags['og']['embed'] = "<div class='large-9 medium-9 small-12 large-centered medium-centered small-centered columns'><img src='".$metaTags['og']['image']."'/></div>";
        break;
    }
    return $metaTags;
  }
  /**
   * Create a random seed
   * @return int
   */
  public function uniqueSeed() {
    return uniqid(mt_rand().time(), true);
  }
  
  /**
   * This method processes a string and replaces all accented UTF-8 characters by unaccented
   * ASCII-7 "equivalents", whitespaces are replaced by hyphens and the string is lowercase.
   *
   * @param   string  $string  String to process
   *
   * @return  string  Processed string
   */
  public static function stringURLSafe($string) {
    $unwanted_array = array('á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'đ' => 'd', 'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'Á' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'Ầ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A', 'Ă' => 'A', 'Ắ' => 'A', 'Ằ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Đ' => 'D', 'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O', 'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y');
    $str = str_replace(' ', '_', $string);
    $str = strtr($str, $unwanted_array);
    $str = trim(strtolower($str));
    $str = preg_replace('/(\s|[^A-Za-z0-9\_])+/', '', $str);
    $str = trim($str, '-');
    $str = trim($str, '_');
    return $str;
  }

  /**
   * Method to upload image to amazon s3
   * @return image s3 url
   */
  public function upload($name, $tmp_name, $size, $allowedExtension = array('jpg','gif','png'), $limitsize = 4000000) {
    $regex = array('#(\.){2,}#', '#[^A-Za-z0-9\.\_\- ]#', '#^\.#');
    $aws = Aws::factory(array('key' => KEY_ID, 'secret' => SECRET_ACCESS_KEY));
    $s3Client = $aws -> get('S3');
    
    $name = rtrim($name, '.');
    $name = preg_replace($regex, '', $name);
    $dot = strrpos($name, '.') + 1;
    $fileExtension = substr($name, $dot);
    $name = Security::hash($this->uniqueSeed(),'sha1') . '_' . Security::hash($this->uniqueSeed(),'sha1'). '.' .$fileExtension;
    
    if(!in_array($fileExtension, $allowedExtension)){
      $this -> Session -> setFlash(__("File type: $fileExtension is not supported"), 'alert/default', array('class' => 'alert'));
      return false;
    }
    
    if($size > $limitsize){
      $this -> Session -> setFlash(__('File size is too big'), 'alert/default', array('class' => 'alert'));
      return false;
    }
    
    
    if($upload = $s3Client -> putObject(array('Bucket' => BUCKET_KEY, 'Key' => $name, 'Body' => fopen($tmp_name, 'rb'), 'ACL' => 'public-read'))){
      return htmlspecialchars($upload -> get('ObjectURL'));
    }
    $this -> Session -> setFlash(__('An error occured while uploading photo please try again latter.'), 'alert/default', array('class' => 'alert'));
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