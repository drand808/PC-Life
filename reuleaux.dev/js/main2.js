function setCookie(key, value) {
	document.cookie = key + '=' + value + ";max-age=34560000;path=/";
}

function getCookie(key) {
	key += '=';
	let keys = document.cookie.split(';');
	for (let i = 0; i < keys.length; ++i) {
		let k = keys[i];
		while (k.charAt(0) == ' ') {
			k = k.substring(1, k.length);
		}
		if (k.indexOf(key)) {
			return k.substring(key.length, k.length);
		}
	}
	return null;
}

function setStyle(style) {
	if (style != "PCPP" && style != "Hackerman") {
		return false;
	}
	document.getElementById("abc").innerHTML = getCookie("style");
	setCookie("style", style);
	let link;
	for (let i = 0; (link = document.getElementsByTagName("link")[i]); ++i) {
		if (link.getAttribute("rel").indexOf("style") != -1 && link.getAttribute("title")) {
			link.disabled = true;
			if (link.getAttribute("title") == style) {
				link.disabled = false;
			}
		}
	}
	return false;
}

function dropdown() {
	let button = document.getElementById("dropdownButton");
	if (button.active) {
		document.getElementById("headerMenu1").style = "";
		document.getElementById("headerMenu2").style = "width:100%";
		document.getElementById("headerMenu3").style = "";
	} else {
		document.getElementById("headerMenu1").style = "transform: translateY(calc(.3rem + 2px)) rotate(45deg) scaleX(1.5)";
		document.getElementById("headerMenu2").style = "width: 0";
		document.getElementById("headerMenu3").style = "transform: translateY(calc(-.3rem - 2px)) rotate(-45deg) scaleX(1.5)";
	}
	button.active = !button.active;
}

window.onload = function() {
	document.getElementById("copyright").innerHTML = "©2022-" + new Date().getFullYear() + " PC Life™, all rights reserved.";
	setStyle(getCookie("style") ?? "PCPP");
	let platform = navigator.userAgentData?.platform ?? "Unknown";
	let brand = "Unknown";
	if (navigator.userAgentData.brands.length > 0) {
		brand = navigator.userAgentData.brands[navigator.userAgentData.brands.length - 1].brand;
		if (brand == "Not;A=Brand") {
			if (navigator.userAgentData.brands.length > 1) {
				brand = navigator.userAgentData.brands[0].brand;
			}
			if (brand == "Not;A=Brand") {
				brand = "Unknown";
			}
		}
	}
	console.log(platform);
	console.log(brand);
}