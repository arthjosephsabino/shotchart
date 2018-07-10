$(function(){
	$('.hamburger').on('click',function(e){
             e.preventDefault();
        toggleMenu();
    });
    
    function toggleMenu(){
        $('body').toggleClass('nav-open');
    }
});
