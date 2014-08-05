$('document').ready(function(){
  function getCompanies (){
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
      // var result = JSON.parse(content);
      // for (var key in result) {
        // if (result.hasOwnProperty(key)) {
          // alert(result[key].id);
          // alert(result[key].msg);
        // }
      // }
      console.log(content);
    });
  }
  $('#SkaterSponsor').keyup(function(){
    getCompanies();
  });
  $('#searchCompany').click(function(){
    getCompanies();
    event.preventDefault();
  });
});
