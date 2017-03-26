// установливаем обработчик события resize
$( window ).resize(function() {
  $( "#width" ).text( $( window ).width() );
  $( "#height" ).text( $( window ).height() );
});

// вызовем событие resize
$(window).resize();