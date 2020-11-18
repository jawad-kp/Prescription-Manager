function SendForDel (e)
{
 	var nm = $(this).attr('value')
 	$.ajax(
		{
			type: "POST",
			url:"DelElems.php",
			data:{TbNm: nm},
			success:function (html)
			{
				$('#FetchData').html(html);
			}
		})		
}