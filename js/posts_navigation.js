$(function() {

  /////////////////////////////////////////////////////
  /////////////////// AJAX LOADING ////////////////////
  /////////////////////////////////////////////////////
  var postIsOpened = false;
  var postIsLoading = false;
  var keywordSelected = 'all';

  // INIT
  // $('.postsTable #'+firstId).nextAll().imagesLoaded().then(function(){
  //
  //  });;

   $(window).on("load", function() {
     launchMasonry();
      $('.post').fadeOut(0);
      $('.post').css('visibility', 'visible');
      $('.post').fadeIn(200);
   });
   // launchMasonry();

  // OPEN IN POPUP EVENT
  $('.open_in_popup').click(function(event){
    event.preventDefault();
    var that = this;
    openInPopup(that);
  });

  // OPEN IN POPUP FUNCTION
  function openInPopup(div){
    var postLink = $(div).attr("permalink");
    if(postLink=="" || typeof postLink == 'undefined'){
      postLink = $(div).attr("href");
    }

    // URLS
    previous_url = $(location).attr('href');
    var postId = $(div).attr("id");
    console.info(previous_url);
    console.info(postLink);
    if(previous_url!=postLink){
    	history.pushState({id: postId, open_in_popup: true}, '', postLink);
    }

    if(postIsLoading==false){
      postIsLoading=true;
      $("body,.post,.diplomeContainer").css("cursor", "progress");
      $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
          action: 'ajaxLoad',
          id: postId
        },
        success: function( result ) {
          postIsOpened=true;

          // ADJUST TOP POSITION (fonction de scrollTop) (inutile depuis que post_overlay se trouve dans post_overlay_under)
          // var scrollTop = $(window).scrollTop();
          // $("#post_overlay").css('top',scrollTop+25);

          // SCROLL INSIDE OVERLAY NOT BODY
          $("body").css('overflow-y', 'hidden');
          // qd on enlève le scroll le scroll sur le body, la scrollbar disparait -> body plus large, changement proportions
          // solution: on calcule la width de la scrollbar, qu'on rajoute en margin-right au body
          var scW = scrollbarWidth()+'px';
          $("body").css('margin-right', scW);

          // Content
          $("#post_overlay_content").empty();
          $("#post_overlay, #post_overlay_under").fadeOut(0);
          $("#post_overlay, #post_overlay_under").css('visibility', 'visible');
          $("#post_overlay_content").append(result);

          //ADD PREVIOUS URL TO CLOSE BUTTON ATTRIBUTES
          $("#post_overlay_close").attr('previous_url', previous_url);

          // MEDIA GESTION
          mediaGestion();

          // DISPLAY CONTENT
          $("#post_overlay, #post_overlay_under").fadeIn(200,function(){
            postIsLoading = false;
            $("body").css("cursor", "default");
            $(".post").css("cursor", "pointer");
            $(".diplomeContainer").css("cursor", "pointer");
          });
        }
      });
    }
  }

  // CLOSE POST NEW STYLE
  $("#post_overlay_under, #post_overlay_close").click(function(e) {
      if (e.target == this){
         history.back(); //This will fire the popstate event
      }
  });

  // CLOSE POST
  // $("#post_overlay_under, #post_overlay_close").click(function() {
  //   history.back(); //This will fire the popstate event
  // });

  $(document).keyup(function(e) {
     if (e.keyCode == 27) {
       history.back(); //This will fire the popstate event
    }
  });

  window.addEventListener("popstate", function(e) {

	// URL location
	var location = document.location;
	// state
	var state = e.state;
	console.log('state: '+state);
	if(state != null && state.open_in_popup){
		$("a[href='" + location + "']").click();
	}
	else{
	      $("#post_overlay, #post_overlay_under").fadeOut(100);
        $("#post_overlay_content").empty();
        $("body").css('overflow-y', 'scroll');
        $("body").css('margin-right', "0px");
	      postIsOpened=false;
	}

  });

  /////////////////////////////////////////////////////
  ////////////////// MEDIA GESTION ////////////////////
  /////////////////////////////////////////////////////

  mediaGestion();
  function mediaGestion(){
    $("#post_overlay_content").css('visibility', 'hidden');

    // ONCE EVERY IMG LOADED
    $('#post_overlay_content').imagesLoaded().then(function(){
      // APPLY CAROUSEL
      launchCarousel();
      // WRAPPER FOR VIDEO embeds (vimeo, youtube)
      $('iframe').wrap('<div class="videoWrapper" />');
      // WRAPPER FOR SOUNDCLOUD
       $("iframe[src*='soundcloud']").parent().removeClass('videoWrapper').addClass('audioWrapper');
       // IMAGE ORIENTATION
       $("#post_overlay_content img, .gallery img").each(function(index,div) {
         var h = $(div).height(); var w = $(div).width();
         if(w<h){ $(div).css('width', '50%');}
       });
       // DISPLAY CONTENT
       $("#post_overlay_content").css('visibility', 'visible');
       $("#post_overlay_content").fadeOut(0).fadeIn(200);
    });
  }


  /////////////////////////////////////////////////////
  /////////////////// KEYWORD SORT ////////////////////
  /////////////////////////////////////////////////////


  $(".filterDiv").click(function(){
    //style
    $('.filterText').removeClass('shadowed');
    //$('.filterCircle').html('○');
    $('.filterCircle').removeClass('active_filter');
    $(this).children('.filterText').addClass('shadowed');
    // $(this).children('.filterCircle').html('●');
    $(this).children('.filterCircle').addClass('active_filter');

    keywordSelected = $(this).attr("slug").trim();
    $(".post").fadeOut(200).promise().done(function(){
      $('.post').each(function(index,div){
        var keywords = $(div).attr('keywords').split(" ");
        // Remove doublons
        var keywordsNoDoubles =[];
        $.each(keywords, function(i, k) { if ($.inArray(k, keywordsNoDoubles) == -1) keywordsNoDoubles.push(k); });
        // check and show
        $.each(keywordsNoDoubles,function(index,keyword){
          if(keyword==keywordSelected){ $(div).css('visibility','visible'); $(div).fadeIn(200); }
        });
        if(keywordSelected=='all'){  $('.post').css('visibility','visible'); $('.post').fadeIn(200); }
        launchMasonry();
      });
    });
  });


  /////////////////////////////////////////////////////
  ///////////////////// MASONRY ///////////////////////
  /////////////////////////////////////////////////////

  function launchMasonry(){
    $('.postsTable').masonry({
      horizontalOrder: true,
      percentPosition: true,
      transitionDuration: '0s',
      columnWidth: '.grid-sizer', // si unset, prend la largeur du 1er item de la table
      gutter:'.gutter-sizer',
      itemSelector: '.post'
    });
  }

  /////////////////////////////////////////////////////
  ////////////////  FLICKITY CAROUSEL /////////////////
  /////////////////////////////////////////////////////
  function launchCarousel(){


    var $gallery = $('.gallery').flickity({
      // options
      cellAlign: 'left',
      pageDots: false,
      imagesLoaded: true,
      wrapAround: true,
      setGallerySize: false // calcule la hauteur de la galerie en fonction de l'image la plus haute
      // arrowShape: {x0: 10,x1: 60, y1: 50,x2: 65, y2: 45,x3: 20}
    });

    $('.flickity-viewport').css('padding-bottom', '62%'); // if setGallerySize: false, on set manuellement le ration de hauteur de la galerie

    // LEGEND
    $('.gallery').append('<div class="gallery-mycaption typo_zeta">My caption</div><div class="gallery-status typo_zeta"></div>');
    var $galleryStatus = $('.gallery-status');
    var $galleryMyCaption = $('.gallery-mycaption');
    var flkty = $gallery.data('flickity');
    function updateStatus() {
      // number
      var cellNumber = flkty.selectedIndex + 1;
      $galleryStatus.text( cellNumber + '/' + flkty.slides.length );
      // Caption
      var captionText = $(flkty.selectedElement).children('.gallery-caption').text();
      $galleryMyCaption.fadeOut(100,function(){
        $galleryMyCaption.text(captionText);
        $galleryMyCaption.fadeIn(100)
      });
    }
    // updateStatus();
    $gallery.on( 'select.flickity', updateStatus );

  }

  /////////////////////////////////////////////////////
  ////////////////////  LOAD MORE /////////////////////
  /////////////////////////////////////////////////////
  $('.loadMore').click(function(){
    // GET ID OF FIRST POST IN THE DOM
    var firstId = $(".post").last().attr('id');
    // STYLE LOAD BUTTON
    $('.loadMore .notWaiting').fadeOut(100,function(){ $('.loadMore .waiting').fadeIn(100); });
    // AJAX FUNCTION TO GET MORE POSTS
    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'ajaxLoadMore',
        firstId: firstId,
        category: category_Name
      },
      success: function( result ) {
        $(".postsTable").append(result);
        // DO ONCE EVERYTHING IS LOADED
        $('.postsTable #'+firstId).nextAll().imagesLoaded().then(function(){
          // SHOW SELECTION OR ALL
           if(keywordSelected!='all'){
             // Style Load Button
             $('.loadMore .waiting').fadeOut(100,function(){ $('.loadMore .notWaiting').fadeIn(100);});
             //
             $('.postsTable #'+firstId).nextAll().fadeOut(0);
             $('.postsTable #'+firstId).nextAll().each(function(index,div){
               var keywords = $(div).attr('keywords').split(" ");
               // Remove doublons
               var keywordsNoDoubles =[];
               $.each(keywords, function(i, k) { if ($.inArray(k, keywordsNoDoubles) == -1) keywordsNoDoubles.push(k); });
               // check and show
               $.each(keywordsNoDoubles,function(index,keyword){
                 if(keyword==keywordSelected){
                   $(div).fadeOut(0);
                   $(div).css('visibility', 'visible');
                   $(div).fadeIn(200);
                 }
               });
             });
           }else if(keywordSelected=='all'){
             // Style Load Button
             $('.loadMore .waiting').fadeOut(100,function(){ $('.loadMore .notWaiting').fadeIn(100);});
             //
             $('.postsTable #'+firstId).nextAll().fadeOut(0);
             $('.postsTable #'+firstId).nextAll().css('visibility', 'visible');
             $('.postsTable #'+firstId).nextAll().fadeIn(400);
           }
           //  MASONRY RELOAD
           $(".postsTable").masonry('reloadItems');
           $(".postsTable").masonry('layout');
         });;


        // OPEN IN POPUP STYLE
        $('.postsTable #'+firstId).nextAll().click(function(event){
          if($(this).hasClass('open_in_popup')){
            event.preventDefault();
            var that = this;
            openInPopup(that);
          }
        });
      } // end success
    }); // end ajax

  });

  /////////////////////////////////////////////////////
  /// JQUERY AJAX WAIT UNTIL ALL IMAGES ARE LOADED ////
  /////////////////////////////////////////////////////

  // Fn to allow an event to fire after all images are loaded
  $.fn.imagesLoaded = function () {
      // get all the images (excluding those with no src attribute)
      var $imgs = this.find('img[src!=""]');
      // if there's no images, just return an already resolved promise
      if (!$imgs.length) {return $.Deferred().resolve().promise();}
      // for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
      var dfds = [];
      $imgs.each(function(){
          var dfd = $.Deferred();
          dfds.push(dfd);
          var img = new Image();
          img.onload = function(){dfd.resolve();}
          img.onerror = function(){dfd.resolve();}
          img.src = this.src;
      });
      // return a master promise object which will resolve when all the deferred objects have resolved
      // IE - when all the images are loaded
      return $.when.apply($,dfds);
  }

  /////////////////////////////////////////////////////
  ///////////// CALCULATE SCROLLBAR WIDTH /////////////
  /////////////////////////////////////////////////////

  function scrollbarWidth() {
    var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>');
    // Append our div, do our calculation and then remove it
    $('body').append(div);
    var w1 = $('div', div).innerWidth();
    div.css('overflow-y', 'scroll');
    var w2 = $('div', div).innerWidth();
    $(div).remove();
    return (w1 - w2);
}





});
