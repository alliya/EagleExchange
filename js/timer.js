var timing = new Array();
var ticker = new Array(); 
function startTimer(secs, element) {
var timeInSecs;

    timing[element] = secs;
	timeInSecs = parseInt(secs)-1;
	ticker[element] = setInterval("tick("+ timing[element] +", \""+element+"\")", 1000);   // every second
}

function looper(secs,element) { 
    secs = tick(secs,element);
}

function tick(secs, element) {
	if (secs>0) {
		secs--;
		timing[element]--;
	}
	else {
		clearInterval(ticker[element]);
		//auction change

	}
    var sec_num = parseInt(timing[element], 10); // don't forget the second parm
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    var time = hours+'hrs '+minutes+'mins '+seconds +'secs';
	document.getElementById(element).innerHTML = time;
	
}