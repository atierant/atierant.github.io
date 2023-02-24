import 'scssRootDir/404.scss';

$(function () {
  const x = $('#myAudio')[0];

  function playAudio() {
    x.play();
    $('.play').hide();
    $('.pause').show();
  }

  function pauseAudio() {
    x.pause();
    $('.play').show();
    $('.pause').hide();
  }

  $('.play').on('click', function () {
    playAudio();
  });

  $('.pause').on('click', function () {
    pauseAudio();
  });

});
