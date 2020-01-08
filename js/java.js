var chosen = 0;
var page = 0;

function scrollDiv() {
  $(".thumbs").animate({
    scrollLeft:300*page
  })
}
function showImage(){
  var chose = $(".thumb-images img").eq(chosen);
  $(".big-image img").attr({src:chose.attr("src")})
  chose.addClass("active").siblings().removeClass("active")
}


$(".thumb-images img").on("click",function(){
  chosen = $(this).index();
  showImage();
})
$(".thumb-images .arrow.right").on("click",function(){
  console.log(page)
  var max = Math.floor($(".thumb-images img").length/4);
  page<max?page++:page; scrollDiv();
})
$(".thumb-images .arrow.left").on("click",function(){
  console.log(page)
  page>0?page--:page; scrollDiv();
})
$(".big-image .arrow.right").on("click",function(){
  var max = $(".thumb-images img").length;
  chosen<max?chosen++:chosen; showImage();
})
$(".big-image .arrow.left").on("click",function(){
  console.log(chosen)
  chosen>0?chosen--:chosen; showImage();
})