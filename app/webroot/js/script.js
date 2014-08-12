$('document').ready(function(){
  var flag = false;
  //show loading
  function showLoading(id){
    $('#'+id).html('loading...');
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
      url:"/ajax/getCompanies",
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
      url:"/ajax/getVideos",
      data:{name:videopart,notIn:notIn}
    }).done(function(content){
      var html = '';
      try {
        //console.log(content);
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
  //get video part
  function getContentAddSearch(dropDownPanelID,controller,action){
    $('#'+dropDownPanelID).addClass('f-dropdown open').css('left',0);
    var searchContentName = $('#'+dropDownPanelID+'-searchInput').val();
    var notIn = [];
    var $i = 0;
    //console.log(dropDownPanelID);
    $('.'+dropDownPanelID+"-notIn").each(function() {
        notIn[$i++] = $(this).val();
    });
    //console.log(searchContentName);
    $.ajax({
      type:"post",
      url:"/ajax/"+dropDownPanelID,
      data:{name:searchContentName,notIn:notIn}
    }).done(function(content){
      var html = '';
      try {
        //console.log(content);
        
        var result = JSON.parse(content);
        
        window.result = result;
        var count = result.length;
        var name;
        var id;
        $.each(result, function (key, data) {
          $.each(data, function(key, value){
            $.each(value, function(k, v){
              //console.log(k);
              switch(k){
                case 'name':
                name = v;
                break;
                case 'id':
                id = v;
                break;
                
              }
            });
          });
          html += '<li><div class="imgContainer"><img src="http://www.rankopedia.com/CandidatePix/58763.gif" /></div><div class="name"><strong>' + name+ '</strong></div><a data-controller="'+controller+'" data-action="'+action+'" data-goto="'+dropDownPanelID+'-notIn'+'" data-value="' + id + '" data-name="' + name + '" class="addButton button radius" href="#">add</a></li>';
        });
        $("#"+dropDownPanelID).html(html);
      }
      catch(e){
        html = content;
        $("#"+dropDownPanelID).html(html);
      }
    });
  }
  //add sponsor
  function addToNotIn(e){
    flag = true;
    var val = $(e).data('value');
    var name = $(e).data('name');
    var gotoNotIn = $(e).data('goto');
    var controller = $(e).data('controller');
    var action = $(e).data('action');
    //console.log(gotoNotIn);
    var html = '<li><div class="imgContainer"><img src="http://www.rankopedia.com/CandidatePix/58763.gif" /></div><div class="name"><strong>'+name+'</strong></div><input class="'+gotoNotIn+'" type="hidden" name="data['+controller+']['+action+'][]" value="'+val+'" /><span class="close_x removeButton">×</span></li>';
    $(e).parent().fadeOut('fast');
    $('#'+gotoNotIn).append(html).promise().done(function(){
      flag = false;
    });
    //console.log(window.resultCompany);
    //console.log(val);
  }
  //add sponsor
  $(document).on('click','.addButton',function(){
    event.preventDefault();
    if(flag){
      return;
    }
    addToNotIn(this);
  });
  //remove sponsor
  function removeButton(e){
    var idRemove = $(e).data('removeid');
    $(e).parent().fadeOut('slow').promise().done(function(){
      $(this).remove();
    });;
  }
  
  //remove sponsor
  $(document).on('click','.removeButton',function(){
    event.preventDefault();
    removeButton(this);
  });
  //search content
  $('.ajaxContentAddSearch').keyup(function(){
    var dropdownPanelId = $(this).data('dropdown');
    var action = $(this).data('action');
    var controller = $(this).data('controller');
    showLoading(dropdownPanelId);
    getContentAddSearch(dropdownPanelId,controller,action);
  });
});
