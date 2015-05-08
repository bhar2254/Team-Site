$(window).on('load', function (){
  var right_width = $(".gallery-container").width() - 205;
  $("div.content,span.image-wrapper,div.caption,div.controls,div.caption-container").css("width",right_width + "px");
});
$(window).on('load', function (){
  $(window).on('resize', function (){
    var right_width = $(".gallery-container").width() - 205;
    $("div.content,span.image-wrapper,div.caption,div.controls,div.caption-container").css("width",right_width + "px");
  });
});