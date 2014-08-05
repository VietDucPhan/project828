$('document').ready(function(){
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
    $.ajax({
      type:"get",
      url:"/project828/ajax/getCompanies",
      data:{name:brand_company,notIn:notIn}
    }).done(function(content){
      var html = '';
      try {
        var result = JSON.parse(content);
        var count = result.length;
        
        for(var i = 0; i < count; i++){
          html += '<li><div class="row"><div class="nameSponsor small-8 columns">' + result[i].Company.name + '</div><div class="addButtonSponsor small-4 columns"><a data-value="' + result[i].Company.id + '" class="button radius" href="#">add</a></div></div></li>';
        }
        $("#searchCompanyPanel").html(html);
      }
      catch(e){
        html = content;
        $("#searchCompanyPanel").html(html);
      }
    });
  }
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
