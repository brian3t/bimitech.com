/**
 *
 * Template  frontend scripts
 *
 **/

//Boxed layout//
jQuery(document).ready(function () {
    "use strict";
    if ($Esense_LAYOUT == 'boxed') {
        if (jQuery(window).width() <= $Esense_TABLET_WIDTH) {
            jQuery("body").removeClass("boxed");
        }
        jQuery(window).resize(function () {
            if (jQuery(window).width() <= $Esense_TABLET_WIDTH) {
                jQuery("body").removeClass("boxed");
            }
            if (jQuery(window).width() > $Esense_TABLET_WIDTH) {

                jQuery("body").addClass("boxed");
            }

        });
    }

    var $subscribe_button = $($('span:contains(Subscribe)').parent('a'));
    $subscribe_button.click(function (e) {
        var email_val = $('input[name="email"]').attr('value');
        $.get(
            "/save_email",
            {email: email_val},
            function (data) {
                try {
                    data = JSON.parse(data);
                    if (data.status == "success"){
                        $subscribe_button.parents('div.vc_row.vc_inner').html("Thanks for subscribing. We will get back to you soon");
                    }

                }
                catch (e) {
                    console.log("Error: ");
                    console.log(e);
                }
            }
        )
    });
});
