$('document').ready(function(){
  var flag = false;
  //show loading
  function showLoading(id){
    $('#'+id).html('loading...');
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
        var url;
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
                case 'url':
                  url = v;
                  break;
                
              }
            });
          });
          html += '<li><div class="imgContainer"><img src="'+url+'" /></div><div class="name"><strong>' + name+ '</strong></div><a data-controller="'+controller+'" data-action="'+action+'" data-goto="'+dropDownPanelID+'-notIn'+'" data-value="' + id + '" data-name="' + name + '" data-url="'+url+'" class="addButton button radius" href="#">add</a></li>';
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
    var url = $(e).data('url');
    //console.log(gotoNotIn);
    var html = '<li><div class="imgContainer"><img src="'+url+'" /></div><div class="name"><strong>'+name+'</strong></div><input class="'+gotoNotIn+'" type="hidden" name="data['+controller+']['+action+'][]" value="'+val+'" /><span class="close_x removeButton">×</span></li>';
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
  //get ajax metatags
  function getMetatags(link){
    $.ajax({
      type:"get",
      url:"/ajax/getMetatags",
      data:{link:link}
    }).done(function(content){
       var result = JSON.parse(content);
       console.log(result);
    });
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
  //parse link
  $('.getMetatags').on('keyup', function(e){
    var link = $(this).val();
    if(e.keyCode == 86){
      if(isValidURL(link)){
        getMetatags(link);
      }
    }
  });
});
