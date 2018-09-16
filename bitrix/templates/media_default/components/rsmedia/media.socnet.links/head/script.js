$(document).ready(function () {
  var $soc = $('.b-head-social');

  var revealSocnetLinks = function () {
    var $target = $(this).find('.b-head-social__group').css({'opacity': 0});

    $target
      .velocity('stop')
      .velocity(
        'transition.slideDownIn', {
          duration: 250,
          delay: 0,
        }
      );
  };

  var concealSocnetLinks =  function () {
    var $target = $(this).find('.b-head-social__group');

    $target.velocity('stop').velocity(
      'transition.fadeOut', {
        duration: 100,
        delay: 0
      }
    );
  };

  $soc.on({
    mouseenter: revealSocnetLinks,
    mouseleave: concealSocnetLinks
  });
});
