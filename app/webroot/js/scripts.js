
jQuery(document).ready(function() {

    /*
        Background slideshow
    */
    $('.coming-soon').backstretch([
      "img/1.jpg"
    , "img/2.jpg"
    , "img/3.jpg"
    , "img/4.jpg"
    , "img/5.jpg"
    , "img/6.jpg"
    , "img/7.jpg"  
    , "img/8.jpg" 
    ], {duration: 6000, fade: 1500});

      /*
        Tooltips
    */
    $('.social a.facebook').tooltip();
    $('.social a.twitter').tooltip();
    $('.social a.dribbble').tooltip();
    $('.social a.googleplus').tooltip();
    $('.social a.pinterest').tooltip();
    $('.social a.flickr').tooltip();

    /*
        Subscription form
  
    $('.error-message').hide(); */
      
   
});

