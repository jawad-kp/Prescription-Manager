function SetValAndRedirect()
{
	var nm = $(this).attr('value')
 	$.ajax(
		{
			type: "POST",
			url:"SetUpFindPresc.php",
			data:{Press: nm},
			success:function ()
			{
				window.location.href = "ViewDetailedHistory.php";
			}
		})
}