//Navbar animation
window.onscroll = function(){scrollFunction()};

function scrollFunction(){
    if(document.body.scrollTop > 50 || document.documentElement.scrollTop > 50){
        document.querySelector(".nav-con").classList.add('shadow');
    }else{
        document.querySelector(".nav-con").classList.remove('shadow');
    }
}

// Prevent right clicking on image
$('img').bind('contextmenu', function(e) {
    return false;
});

// Prevent dragging image
$('img').on('dragstart', function(event) { event.preventDefault(); });
