$('document').ready(function(){
  var flag = false;
  //show loading
  function showLoading(id){
    var prevHtml = $(id).html();
    $(id).html('loading...');
    return prevHtml;
  }
  //get url
  function isValidURL(url){
    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
 
    if(RegExp.test(url)){
       return true;
    }else{
       return false;
    }
  }
  //get video part
  function getContentAddSearch(dropDownPanelID){
    $('#'+dropDownPanelID).addClass('f-dropdown').css({left:0,top:'35px'});
    var searchContentName = $('#'+dropDownPanelID+'-search-input').val();
    var skaterid = $('#'+dropDownPanelID+'-search-input').data('id');
    var $i = 0;
    //console.log(searchContentName);
    $.ajax({
      type:"post",
      url:"/ajax/"+dropDownPanelID,
      data:{name:searchContentName,id:skaterid}
    }).done(function(content){
      var html = '';
      try {
        //console.log(content);
        var result = JSON.parse(content);
        var count = result.length;
        var name;
        var id;
        var logo;
        $.each(result, function (key, data) {
          $.each(data, function(key, value){
            $.each(value, function(k, v){
              switch(k){
                case 'name':
                  name = v;
                  break;
                case 'id':
                  id = v;
                  break;
                case 'logo':
                  logo = v;
                  break;
                
              }
            });
          });
          html += '<li><div class="imgContainer"><img src="'+logo+'" /></div><div class="name"><strong>' + name+ '</strong></div><a data-id="'+skaterid+'" data-sponsor="'+id+'" class="add-sponsor button radius" href="#">add</a></li>';
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
  function addsponsor(e){
    flag = true;
    var id = $(e).data('id');
    var sponsor = $(e).data('sponsor');
    //console.log(gotoNotIn);
    $.ajax({
      type:"post",
      url:"/ajax/addSponsor",
      data:{id:id,sponsor:sponsor}
    }).done(function(content){
      console.log(content);
      var result = JSON.parse(content);
      if(result.succeed == true){
        $('#sponsor_containment').append(result.html);
        $(e).parent().remove();
      }
    });
    flag = false;
    //console.log(window.resultCompany);
    //console.log(val);
  }
  //add sponsor
  $(document).on('click','.add-sponsor',function(){
    event.preventDefault();
    if(flag){
      return;
    }
    addsponsor(this);
  });
  //remove sponsor
  function removeButton(e){
    var idRemove = $(e).data('removeid');
    $(e).parent().fadeOut('slow').promise().done(function(){
      $(this).remove();
    });;
  }
  function removeSponsor(e){
    var href = $(e).data('href');
    $.ajax({
      type:'get',
      url:href
    }).done(function(content){
      if(content){
        $(e).parent().parent().remove();
      } else {
        alert('There was an error please try again latter');
      }
    });
  }
  $(document).on('click','.remove-sponsor',function(e){
    e.preventDefault();
    removeSponsor(this);
  });
  //get ajax metatags
  function getMetatags(link){
    showLoading('parsed_link_container');
    $.ajax({
      type:"get",
      url:"/ajax/getMetatags",
      data:{link:link}
    }).done(function(content){
      var result = JSON.parse(content);
      var htmlContent = '<div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns"><h4>'+result.og.title+'</h4></div><div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns"><p>'+result.og.description+'</p></div>'+result.og.embed;
      htmlContent += '<input type="hidden" name="data[Video][link_image]" value="'+result.og.image+'"/>';
      $('#parsed_link_container').html(htmlContent);
      $('#VideoName').val(result.og.title);
      $('#VideoDesc').val(result.og.description);
    });
  }
  //remove sponsor
  $(document).on('click','.removeButton',function(){
    event.preventDefault();
    removeButton(this);
  });
  //search content
  $(document).on('keyup','.ajax-search-data',function(){
    var dropdownPanelId = $(this).data('dropdown');
    //console.log(dropdownPanelId);
    showLoading('#'+dropdownPanelId);
    getContentAddSearch(dropdownPanelId);
  });
  //parse link
  $('.getMetatags').on('keyup', function(e){
    var link = $(this).val();
    if(e.keyCode == 86){
      if(isValidURL(link)){
        getMetatags(link);
      }
    }
  });
  //get ajax metatags
  function getForm(href,appendTo){
    var prevHtml = showLoading(appendTo);
    $.ajax({
      type:"get",
      url:href,
      success: function(content){
        $(appendTo).html(content);
      },
      error: function() {
        $(appendTo).html(prevHtml);
      }
    });
  }
  $(document).on('click','.ajax-reactivate',function(){
    event.preventDefault();
    $(document).foundation();
  });
  $(document).on('click','.reload',function(){
    event.preventDefault();
    location.reload();
  });
  $('.edit').click(function(){
    var href = $(this).data('ajax-href');
    var appendTo = $(this).data('html-append-to');
    getForm(href,appendTo);
  });
});
