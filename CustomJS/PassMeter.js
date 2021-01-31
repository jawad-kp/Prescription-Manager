var strength = {
  0: "Worst",
  1: "Bad",
  2: "Weak",
  3: "Good",
  4: "Strong"
};
var password = document.getElementById('pass');
var meter = document.getElementById('password-strength-meter');
var text = document.getElementById('password-strength-text');
var Pass_Warn = document.getElementById('pass-warn');
var Pass_Sugg  = document.getElementById('pass-sugg');

password.addEventListener('input', function() {
  var val = password.value;
  var result = zxcvbn(val);

  // Update the password strength meter
  meter.value = result.score;
  text.pers = result.score;

  // Update the text indicator
  if (val !== "")
  {
    text.innerHTML = "Strength: " + strength[result.score];
    
	console.log(result);
	if(result.feedback.warning != "")
	{
		Pass_Warn.innerHTML = "Warning: "+result.feedback.warning;
	}
	else
	{
		Pass_Warn.innerHTML = "";
	}

	if (result.feedback.suggestions.length != 0)
	{
		Pass_Sugg.innerHTML = "Suggestion: "+result.feedback.suggestions;
	}
	else
	{
		Pass_Sugg.innerHTML = "";
	}

    
  }
  else
  {
    text.innerHTML = "";
    Pass_Warn.innerHTML = "";
    Pass_Sugg.innerHTML = "";
  }
});