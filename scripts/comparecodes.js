var checked;
var unchecked;
var compareButton;

function initBoxes() {
	checked = [];
	unchecked = [];
	compareButton = document.getElementById("compare-btn");
	compareButton.disabled = true;
	var box;
	var i=-1;
	while ((box = document.getElementById("chk"+ ++i)) != null)
		unchecked.push(box);
	var unchecked_len = unchecked.length;
	for (var i = 0; i < unchecked_len; i++) {
		unchecked[i].disabled = false;
		unchecked[i].checked = false;
	}
}

function validateBoxes(box) {
	if (box.checked == true) {
		var i = unchecked.indexOf(box);
		if (i !== -1) {
			unchecked.splice(i, 1);
			checked.push(box);
		}
	} else {
		var i = checked.indexOf(box);
		if (i !== -1) {
			checked.splice(i, 1);
			unchecked.push(box);
		}
	}
	//alert(checked.length + " " + unchecked.length);
	var unchecked_len = unchecked.length;
	if (checked.length < 2) {
		compareButton.disabled = true;
		for (var i = 0; i < unchecked_len; i++) {
			unchecked[i].disabled = false;
		}
	} else {
		compareButton.disabled = false;
		for (var i = 0; i < unchecked_len; i++) {
			unchecked[i].disabled = true;
		}
	}
}

function compareCodes() {
	var ri_1 = checked[0].value.split(" ");
	var ri_2 = checked[1].value.split(" ");
	var phpQuery = "comparecodes.php?r1="+ri_1[0]+"&r2="+ri_2[0]+"&c1="+ri_1[1]+"&c2="+ri_2[1]+"&v1="+ri_1[2]+"&v2="+ri_2[2];
	window.location.href = phpQuery;
}