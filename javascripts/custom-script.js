/// custom script ///
jQuery(document).ready(function($) {
  //Isotope|Masonry all blog items
  var $container = $('.blog-container');
  $container.imagesLoaded( function () {
    $('.blog-container').isotope({
      itemSelector: '.item-blog',
    });
  });



  //function to open up tab in about--------------------------------------
  function activaTab(tab){
      $('.nav-tabs a[href="#' + tab + '"]').tab('show');
  }

  // store the hash (DON'T put this code inside the $() function, it has to be executed
  // right away before the browser can start scrolling!
  var hash = window.location.hash,
      target = hash.replace('#', '');

  //open tab by getting hash of url
  activaTab(target);
  $('a#tab').text(target);
  //var tablink = window.location.href; obtain current url
  $('a#tab').attr('href','#');

  // delete hash so the page won't scroll to it
  window.location.hash = "";

  // now whenever you are ready do whatever you want
  $(window).load(function() {
      if (target) {
          window.scrollTo(0, 0);
      }
  });

  //store hash back for proper reload
  /*setTimeout(function(){
    window.location.hash = target;
  },3000);*/



  //put selected class on the selected person--------------------------
  if(window.location.href.indexOf('over-ons') > -1) {
    var path = window.location.pathname;
    var search = path.match("over-ons/(.*)/");
    var selected = '.' + search[1];
    console.log(selected);

    $(selected).addClass('selected');
  }

  $('a#tab').click(function(){
    $('html, body').animate({
       scrollTop: $(hash).offset().top
    }, 500);
  });

});
