$(document).ready(function() {
    var contador = 1;
    $('#menu').click(function() {
        if (contador == 1) {
            $('.navbar').animate({
                left: '0px' // Muestra el navbar
            });
            
            contador = 0;
        } else {
            contador = 1;
            $('.navbar').animate({
                left: '-160px' // Oculta el navbar
            });
            
        }
    });
});