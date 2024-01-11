<?php 
 // wp-head template
 // Everything in this file will get echoed out at the bottom of the head.
?>
<script>
	var hashTarget = window.location.hash,
    hashTarget = hashTarget.replace('#', '');

	// delete hash so the page won't scroll to it
	window.location.hash = "";
</script>
<!-- Removing weekends from gf date picker -->
 <script>
	 	// shout out Hero for Gravity forms
        gform.addFilter(
            'gform_datepicker_options_pre_init',
            function( optionsObj ) {
                optionsObj.beforeShowDay = function( date ) {
                    var day = date.getDay();

                    var dmDate =
                        jQuery.datepicker.formatDate(
                            'dd/mm', date
                        );

                    return [
                        day != 0 /* Sunday */ &&
                        day != 6 /* Saturday */ &&
                        dmDate != '01/01' /* New Year */ &&
                        dmDate != '25/12' /* Christmas */
                    ];
                };

                return optionsObj;
            }
        );
    </script>