</div>
<footer class="text-center" id="footer">&copy; Copyright 2018-2020 Mike's Logistics</footer>

<style>
	#footer{
		margin-top: 50px;
	}
</style>
<script>
	function updateSizes(){
		var sizeString = '';
		for(var i=1;i<=12;i++){
			if(jQuery('#size'+i).val() != ''){
				sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
			}
		}
		jQuery('#sizes').val(sizeString);
	}

	function get_child_options(){
		var parentID = jQuery('#parent').val();
		jQuery.ajax({
			url: '/projectpgd/admin/parsers/child_categories.php',
			type: 'POST',
			data: {parentID : parentID},
			success: function(data){
				jQuery('#child').html(data);
			},
			error: function(){alert("Something went wrong with the child options.")},
		});
	}
	jQuery('select[name="parent"]').change(get_child_options);
</script>
</body>
</html>