
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$("#toggleFilter").click(function() {
    if($('#filter').css('display') == 'none'){
        $("#filter").slideDown();
        $('#filterarrow').removeClass("fa-arrow-circle-right");
        $('#filterarrow').addClass( "fa-arrow-circle-down" );        
    }else{
        $("#filter").slideUp();
        $('#filterarrow').removeClass("fa-arrow-circle-down");
        $('#filterarrow').addClass( "fa-arrow-circle-right" );
    }    
});
