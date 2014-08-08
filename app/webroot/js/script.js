$('document').ready(function(){
  var flag = false;
  //show loading
  function showLoading(id){
    $(id).html('loading...');
  }
  //show brands
  function getCompanies (){
    $('#searchCompanyPanel').addClass('f-dropdown open').css('left',0);
    var brand_company = $('#SkaterSponsor').val();
    var notIn = [];
    var $i = 0;
    $(".notIn").each(function() {
        notIn[$i++] = $(this).val();
    });
    //console.log(notIn);
    $.ajax({
      type:"post",
      url:"/project828/ajax/getCompanies",
      data:{name:brand_company,notIn:notIn}
    }).done(function(content){
      var html = '';
      try {
        //console.log(content);
        window.resultCompany = JSON.parse(content);
        var result = window.resultCompany;
        var count = result.length;
        
        for(var i = 0; i < count; i++){
          html += '<li id="li-sponsor-' + i + '"><div class="imgContainer"><img src="http://www.rankopedia.com/CandidatePix/58763.gif" /></div><div class="name"><strong>' + result[i].Company.name + '</strong></div><a data-value="' + i + '" class="addButton addCompany button radius" href="#">add</a></li>';
        }
        $("#searchCompanyPanel").html(html);
      }
      catch(e){
        html = content;
        $("#searchCompanyPanel").html(html);
      }
    });
  }
  //get video part
  function getVideos(){
    $('#searchVideoPartPanel').addClass('f-dropdown open').css('left',0);
    var videopart = $('#SkaterVideoPart').val();
    var notIn = [];
    var $i = 0;
    $(".notInVideo").each(function() {
        notIn[$i++] = $(this).val();
    });
    //console.log(notIn);
    $.ajax({
      type:"post",
      url:"/project828/ajax/getVideos",
      data:{name:videopart,notIn:notIn}
    }).done(function(content){
      var html = '';
      try {
        console.log(content);
        //console.log(content);
        window.resultVideo = JSON.parse(content);
        var result = window.resultVideo;
        var count = result.length;
        
        for(var i = 0; i < count; i++){
          html += '<li id="li-video-' + i + '"><div class="imgContainer"><img src="http://www.rankopedia.com/CandidatePix/58763.gif" /></div><div class="name"><strong>' + result[i].Video.name + '</strong></div><a data-value="' + i + '" class="addButton addVideo button radius" href="#">add</a></li>';
        }
        $("#searchVideoPartPanel").html(html);
      }
      catch(e){
        html = content;
        $("#searchVideoPartPanel").html(html);
      }
    });
  }
  //add sponsor
  function addSponsor(e){
    flag = true;
    var val = $(e).data('value');
    $result = window.resultCompany;
    
    var html = '<li id="sponsor-'+$result[val].Company.id+'"><div class="imgContainer"><img src="http://www.rankopedia.com/CandidatePix/58763.gif" /></div><div class="name"><strong>'+$result[val].Company.name+'</strong></div><input class="notIn" type="hidden" name="data[Skater][sponsors][]" value="'+$result[val].Company.id+'" /><span data-removeid="'+$result[val].Company.id+'" class="close_x removeButton">×</span></li>';
    $('#li-sponsor-'+val).fadeOut('fast');
    $('#sponsorshipContainer').append(html).promise().done(function(){
      flag = false;
    });
    //console.log(window.resultCompany);
    //console.log(val);
  }
  //add video
  function addVideo(e){
    flag = true;
    var val = $(e).data('value');
    var result = window.resultVideo;
    
    var html = '<li id="video-'+result[val].Video.id+'"><div class="imgContainer"><img src="http://www.rankopedia.com/CandidatePix/58763.gif" /></div><div class="name"><strong>'+result[val].Video.name+'</strong></div><input class="notInVideo" type="hidden" name="data[Skater][videos][]" value="'+result[val].Video.id+'" /><span data-removeid="'+result[val].Video.id+'" class="close_x removeButton">×</span></li>';
    $('#li-video-'+val).fadeOut('fast');
    $('#videoPartContainer').append(html).promise().done(function(){
      flag = false;
    });
    //console.log(window.resultCompany);
    //console.log(val);
  }
  //remove sponsor
  function removeButton(e){
    var idRemove = $(e).data('removeid');
    $(e).parent().fadeOut('slow').promise().done(function(){
      $(this).remove();
    });;
  }
  //add sponsor
  $(document).on('click','.addCompany',function(){
    event.preventDefault();
    if(flag){
      return;
    }
    addSponsor(this);
  });
  
  //add sponsor
  $(document).on('click','.addVideo',function(){
    event.preventDefault();
    if(flag){
      return;
    }
    addVideo(this);
  });
  
  //remove sponsor
  $(document).on('click','.removeButton',function(){
    event.preventDefault();
    removeButton(this);
  });
  //search video
  $('#SkaterVideoPart').keyup(function(){
    showLoading("#searchVideoPartPanel");
    getVideos();
  });
  //search company
  $('#SkaterSponsor').keyup(function(){
    showLoading("#searchCompanyPanel");
    getCompanies();
  });
  $('#searchCompany').click(function(){
    showLoading("#searchCompanyPanel");
    getCompanies();
    event.preventDefault();
  });
});
