$(function() {

  /////////////////////////////////////////////////////
  ////////////////// POPUP HOMEPAGE ///////////////////
  /////////////////////////////////////////////////////

  // STARTER
  $(window).on("load", function() {
    var windowWidth = $(window).width();
    if((window.location.hash.substring(1)!='actu')&&(windowWidth>600)){
      launchPopup();
    }
  });

  function launchPopup(){
    // INIT
    randomPositions();
    $(".actuImage").addClass('grey');
    $(".popup").fadeOut(0);
    $(".popup").css('visibility', 'visible');
    $(".popup").fadeIn(400);

    // RANDOM POSITIONS (attention, à faire une fois que toutes les images sont chargées)
    function randomPositions(){
      var w = window.innerWidth;
      var h = window.innerHeight;
      $(".popup").each(function(index,div){
        var thisWidth = $(div).outerWidth(true);
        var thisHeight = $(div).outerHeight(true);
        var newLeft = Math.abs(randomIntFromInterval(w*0.10,w-thisWidth-w*0.05));
        var newTop = Math.abs(randomIntFromInterval(h*0.05,h-thisHeight-h*0.05)); //si une img est + haute que la hauteur, elle ne se retrouve pas à un top <0
        $(div).css({top:newTop, left:newLeft});
        $(div).css({width:thisWidth});// re-set width, cause bug de width non définie & image qui diminue sa taille quand on drag vers la droite
        // console.log('image width '+thisWidth);
        // console.log('window width '+w);
        // console.log((w*0.10)+' < '+newLeft+' < '+(w-thisWidth-w*0.05));
      });
    }

    // DRAGGABLE FANCY QUI EVITE LES MINI DRAG
    var initDragX, initDragY;
    $(".popup").draggable(
      // {containment: "window"},
      {
      start: function(event, ui){
       initDragX = event.clientX;
       initDragY = event.clientY;
      //  $(this).css('z-index',100);
      },
      stop: function(event, ui){
        var moveX = Math.abs(initDragX-event.clientX);
        var moveY = Math.abs(initDragY-event.clientY);
        if((moveX<4)&&(moveY<4)){
          $(this).click();
        }
      }
    });

    // DISAPPEAR ON CLICK
    $(".popup").click(function(){
      if($('.popup').length==1){
        $(".actuImage").removeClass('grey');
         window.location.hash = 'actu';
      }
      $(this).fadeOut(150,function(){
        $(this).remove();
      });
    });

    // DISAPPEAR ALL (CLICK MENU OR ACTU)
    $('.actu,.filterDiv').click(function(){

        $('.popup').fadeOut(150,function(){
          $('.popup').remove();
          $(".actuImage").removeClass('grey');
          //window.location.hash = 'actu';
        });
    });

  }


  function randomIntFromInterval(min,max)
  {
    return Math.floor(Math.random()*(max-min+1)+min);
  }







});
