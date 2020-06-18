	</div>
</body>
</html>
<script type="text/javascript">
	$('.drop').click(function(){
		if($('.dropdown').hasClass('active-drop')){
			$('.dropdown').removeClass('active-drop');
			$(this).removeAttr('style');
			$('.drop svg path').removeAttr('style');
		}else{
			$('.dropdown').addClass('active-drop');
			$(this).css({
				"background-color" : "#27496D",
				"color" : "#DAE1E7"
			});
		}
	});
</script>