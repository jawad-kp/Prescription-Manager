function SendValAndRedirect()
{
	var nm = $(this).attr('value')
 	$.ajax(
		{
			type: "POST",
			url:"SetUpPresc.php",
			data:{Press: nm},
			success:function ()
			{
				window.location.href = "PrescPage.php";
			}
		})
}