</div>


<footer class="text-center" id="footer">&copy; Copyright 2018-2020 Mike's Logistics</footer>

<style>
	#footer{
		margin-top: 50px;
	}
</style>


<script>
	jQuery(window).scroll(function (){
		var vscroll = jQuery(this).scrollTop();
		jQuery('#logotext').css({
			"transform" : "translate(0px, "+vscroll/2+"px)"
		});

		var vscroll = jQuery(this).scrollTop();
		jQuery('#back-flower').css({
			"transform" : "translate(0px, -"+vscroll/12+"px)"
		});

		var vscroll = jQuery(this).scrollTop();
		jQuery('#for-flower').css({
			"transform" : "translate(0px, -"+vscroll/2+"px)"
		});
	});

	function detailsmodal(id){
		// alert(id);
		var data = {"id" : id};
		jQuery.ajax({
		url : '/projectpgd/includes/detailsmodal.php',
		method : "post",
		data : data,
		success: function(data){
			jQuery('body').append(data);
			jQuery('#details-modal').modal('toggle');
		},
		error: function(){
			alert("Something went wrong!");
		},
	  });
	}
</script>
</body>
</html>