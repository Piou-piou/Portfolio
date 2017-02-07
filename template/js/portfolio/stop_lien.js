jQuery(document).ready(function() {

    jQuery(".card__content").css({"display": "none"});

    jQuery(".suite").click(function(e) {
        e.preventDefault();

        jQuery(".card__content").css({"display": "block"});

        jQuery(".masque").css({"z-index":1});
        jQuery(".img-presentation").css({
            "display":"block",
            "opacity": "100"
        });
    });

    jQuery(".projet img").click(function(e) {
        e.preventDefault();

        jQuery(".card__content").css({"display": "block"});

        jQuery(".masque").css({"z-index":1});
        jQuery(".img-presentation").css({
            "display":"block",
            "opacity": "100"
        });
    });

    jQuery(".card__btn-close").click(function() {
        jQuery(".masque").css({"z-index":20});

        jQuery(".img-presentation").delay(30000000).css({
            "opacity": "0",
            "transition": "4s"
        });
    })
});