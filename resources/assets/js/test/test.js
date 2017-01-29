define(['jquery', 'handlebars'],  function($, HB) {
  var Test = function(){
      this.show = function(){
        return $("body").html("asd");
      }
  }
  return Test;
});
