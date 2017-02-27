$(document).ready(function() {
    jQuery(".nav-responsive i").click(function(e) {
        e.preventDefault();
        $this = jQuery(this).parent();

        $this.toggleClass("active");

        $this.find("i").removeClass();
        if (($this).hasClass("active")) {
            $this.find("i").addClass("fa fa-times fa-3x");
        }
        else {
            $this.find("i").addClass("fa fa-bars fa-3x");
        }
    });
});