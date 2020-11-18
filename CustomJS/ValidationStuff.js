function resetVals()
{
	document.getElementById('Tab-Name-Err').innerHTML = "";
	document.getElementById('Freq-Err').innerHTML = "";
	document.getElementById('Dosage-Err').innerHTML = "";

}
function MyValidator()
{
	var tbVal = document.getElementById('Tab-Name').value;
	var f = document.getElementById('Freq').value;
	var d = document.getElementById('Dosage').value;
	var stat = true;
	resetVals();
	if (!(tbVal))
	{
		document.getElementById('Tab-Name-Err').innerHTML = "Please enter a Name";
		return [false];
	}
	if (!(f))
	{
		
		document.getElementById('Freq-Err').innerHTML = "Please enter the Frequency";
		return [false];
		
	}
	if (!(d))
	{
		document.getElementById('Dosage-Err').innerHTML = "Please enter the dosage";
		return [false];
	}
	return[tbVal,f,d];
}