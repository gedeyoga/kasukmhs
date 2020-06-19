	</div>
</body>
</html>
<script type="text/javascript">
	$('.drop').click(function(){
		if($('.dropdown').hasClass('active-drop')){
			$('.dropdown').removeClass('active-drop');
			$(this).removeClass('active');
		}else{
			$('.dropdown').addClass('active-drop');
			$('.sidebar ul li a').removeClass('active');
			$(this).addClass('active');

		}
	});
</script>