(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 $(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
$('.cedimgloader').hide();
$('.ced_del_order').click(function() {
    var current_order_id = this.id;
    var ajaxurl = my_ajax_object.ajax_url;
  //  var user_fname = jQuery("input[name='account_first_name']").val();
  $('.cedimgloader').show();
	jQuery.ajax({
		method : "POST",
		url : ajaxurl,
		data : { 'action' : 'deleteorder' , 'current_order_id' : current_order_id}
	})
	.done(function(response){
		console.log(response);
		location.reload(true);
		$('.cedimgloader').hide();
	})
	.fail(function(data){
		console.log("Failed AJAX /// FAILED OBJECT"+ data);
	});
});


$(document).ready(function() {
    $('#mytable').DataTable( {
        "pagingType": "full_numbers",
        "paging": true,
   		"lengthMenu": [10, 25, 50, 75, 100]
    } );
} );


});


})( jQuery );
