$('document').ready(function(){
  $('#SkaterSponsor').keyup(function(){
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
      console.log(content);
    });
  });
});
