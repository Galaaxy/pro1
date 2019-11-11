/**
 * Created by Haubold Media
 * Author: Frédéric Haubold
 * Date:  11.07.2017.
 */

window.sr = ScrollReveal();

/*sr.reveal("div.carousel-inner .active .carousel-caption",{duration: 2000});
sr.reveal(".startTextBox .row",{duration: 2000});
sr.reveal(".fewoContent .thumbnail",{duration: 2000});
sr.reveal(".galleryBoxTitle h2",{duration: 2000});
sr.reveal(".galleryBoxContent > div",{duration: 2000});
sr.reveal(".hostBox div.container > div h2",{duration: 2000});
sr.reveal(".hostBox div.container div.row div",{duration: 2000, delay: 500});
sr.reveal(".gTextBox div.container div img",{duration: 2000});
sr.reveal(".ueberUnsText",{duration: 2000, delay: 500});
sr.reveal(".contactHeader",{duration: 2000});
sr.reveal(".contactContent",{duration: 2000, delay: 500});*/


$(".advSelect").on("click",function(){

    var selector = $(this).find("img");
    var imagePath = "http://"+window.location.hostname+"/wp-content/plugins/fewo-manager/images/";

    if($(selector).attr("src") == imagePath+"triangle-down.png"){
        $(selector).attr("src",imagePath+"triangle-up.png");
    }else{
        $(selector).attr("src",imagePath+"triangle-down.png");
    }

});


$(document).ready(function(){

    $("#carousel").carousel({
        wrap: false
    });

    $(".lightbox").magnificPopup({
        type: 'image',
        gallery: {
            enabled: true, // set to true to enable gallery

            preload: [0,2], // read about this option in next Lazy-loading section

            navigateByImgClick: true,

            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

            tPrev: 'Back (Linke Pfeil Taste)', // title for left button
            tNext: 'Next (Rechte Pfeil Taste)', // title for right button
            tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
        }
    })
    $(".lightboxTeam").magnificPopup({
        type: 'image',
        gallery: {
            enabled: true, // set to true to enable gallery

            preload: [0,2], // read about this option in next Lazy-loading section

            navigateByImgClick: true,

            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

            tPrev: 'Back (Linke Pfeil Taste)', // title for left button
            tNext: 'Next (Rechte Pfeil Taste)', // title for right button
            tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
        }
    })

});