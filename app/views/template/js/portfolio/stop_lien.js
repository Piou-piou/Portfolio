jQuery(document).ready(function() {

    jQuery(".card__content").css({"display": "none"});

    jQuery(".suite").click(function(e) {
        e.preventDefault();

        jQuery(".card__content").css({"display": "block"});
    
        jQuery("body").css("overflow-y", "hidden");

        jQuery(".masque").css({"z-index":1});
        jQuery(".img-presentation").css({
            "display":"block",
            "opacity": "100"
        });
    });

    jQuery(".projets div img, .projets  div .masque").click(function(e) {
        e.preventDefault();

        jQuery(".card__content").css({"display": "block"});
    
        jQuery("body").css("overflow-y", "hidden");

        jQuery(".masque").css({"z-index":1});
        jQuery(".img-presentation").css({
            "display":"block",
            "opacity": "100"
        });
    });

    jQuery(".card__btn-close").click(function() {
        jQuery(".masque").css({"z-index":20});
    
            jQuery("body").css("overflow-y", "auto");

        jQuery(".img-presentation").delay(30000000).css({
            "opacity": "0",
            "transition": "4s"
        });
    })
});