
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if("<?php echo $timezone; ?>".length==0){
           var timezone_offset_minutes = new Date().getTimezoneOffset();
	        timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

			// Timezone difference in minutes such as 330 or -360 or 0
			console.log(timezone_offset_minutes); 
            $.ajax({
                type: "GET",
                url: "http://praxisnation.com/waf/timezone.php",
                data: 'time='+ timezone_offset_minutes,
                success: function(result){
                	$('#timezone').val(result);
                    //location.reload();
                }
            });
        }
    });
</script>