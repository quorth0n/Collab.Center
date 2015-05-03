$("#toggle").html('&#9679;<br>&#9679;<br>&#9679;<br>');
//Child iFrame Function
function changeUrl(url) {
  $('iframe').attr('src', url);
}
$("#toggle").toggle(
  function () {
    $("#sidebar").animate({left: 0});
    $("#toggle").animate({left: '25.8%'});
  }, function () {
    $("#sidebar").animate({left: '-16.5em'});
    $("#toggle").animate({left: 0});
  }
);
