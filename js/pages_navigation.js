$(function() {

  /////////////////////////////////////////////////////
  ///////////////////  ACCORDEON  /////////////////////
  /////////////////////////////////////////////////////

  // IF ACCORDEON EXISTS
  if ($(".accordeon")[0]){

    $(".anneeTitle").click(function(){
      //toggle
      $(this).next('.anneeContent').slideToggle();
      //arrows
      if($(this).children('.arrowRight').hasClass('arrowDown')){
          $(this).children('.arrowLeft').removeClass('arrowDown').html('→');
          $(this).children('.arrowRight').removeClass('arrowDown').html('←');
      }else{
        $(this).children('.arrowLeft').addClass('arrowDown').html('↓');
        $(this).children('.arrowRight').addClass('arrowDown').html('↓');
      }
    });

  }

  /////////////////////////////////////////////////////
  ///////////////////  DEROULEUR  /////////////////////
  /////////////////////////////////////////////////////

  if($(".texte_deroulable")[0]){

    // hide texte deroulable (on fait pas ca en css sinon on voit plus le texte dans l'éditeur front)
    $(".texte_deroulable").css('display','none');

    $(".texte_deroulable").each(function(index,div){
      // Add
      var derouleur = $('<div>').addClass('texte_derouleur').html('Lire la suite →');
      $(div).before(derouleur);
      // Apply same text style than texte_deroulable
      var textSize = $(div).css('font-size');
      var textFont = $(div).css('font-family');
      derouleur.css({'font-size':textSize,'font-family':textFont});

    });

    $(".texte_derouleur").click(function(){
      $(this).next(".texte_deroulable").slideToggle();
      // Style derouleur
      // if($(this).hasClass("openedText")){
      //     $(this).removeClass("openedText");
      //     $(this).html("Lire la suite →")
      // }else{
      //   $(this).addClass("openedText");
      //   $(this).html("Replier ←");
      // }
    });

  }






});
