<?php if(!empty($PostContent['AllPostContent']['img_url'])){
  echo $this->element('content/content_image',array('PostContent'=>$PostContent));
} else {
  echo $this->element('content/content_video',array('PostContent'=>$PostContent));
}