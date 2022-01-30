$(document).ready(() => {
    $('#hamburger-menu').click(() => {
        $('#hamburger-menu').toggleClass('active')
        $('#nav-menu').toggleClass('active')
    })

    // setting owl carousel

    let navText = ["<i class='bx bx-chevron-left'></i>", "<i class='bx bx-chevron-right'></i>"]

    $('#hero-carousel').owlCarousel({
        items: 1,
        dots: false, //Haalt dots weg.
        loop: true, //Loopt door de items heen.
        nav:true, //Voor navigatie arrows.
        navText: navText, //Navigatie text.
        autoplay: true, //Auto loopt door de items heen.
        autoplayHoverPause: true //Pauzeert zodra je er over hovert.
    })


    $('.movies-slide').owlCarousel({
        items: 2,
        dots: false,
        loop: true,
        nav:true,
        navText: navText,
        margin: 15,
        responsive: {
            500: {
                items: 2
            },
            1280: {
                items: 4
            },
            1600: {
                items: 6
            }
        }
    })
})

$("btn btn-hover").click(function () {
    $("#content").hide();
    $("#yt")[0].src += "?autoplay=1";
    setTimeout(function(){ $("#yt").show(); }, 200);
});



