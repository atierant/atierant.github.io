import '../scss/sticky-note.scss';

$(document).ready(function () {
    $('.note-big-shadow').each(function () {
        let note = $(this).find('.note').first();
        let orientation = note.data('orientation') ?? 0;
        $(this).css('transform', 'rotate3d(1, 1, 1, ' + orientation + 'deg)');
    });
});
