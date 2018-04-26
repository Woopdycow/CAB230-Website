if (typeof(Number.prototype.toRad) === "undefined") {
	Number.prototype.toRad = function() {
		return this * Math.PI / 180;
	}
}

var date = new Date().toDateString();
document.write("<div id=\"printMessage\">");
document.write(date);

var url = window.location.href;
document.write(url);
document.write("</div>");

function echo(msg) {
	window.alert("Echoing: " + msg);
}

function changeIt() {
	var listItems = document.getElementsByTagName("li");
		for (var i = 0; i < listItems.length; i++) {
		listItems[i].style.color = "#00ff00";
	}
}

function sortList(listId) {
	var list = document.getElementById(listId);
	var children = list.childNodes;
	// store the contents of all <li> elements in an array
	var listItemsHTML = new Array();
	for (var i = 0; i < children.length; i++) {
		// the list also contains some "text nodes" representing the whitespace
		// bewteen the elements, so we only want to take the <li> elements
		if (children[i].nodeName === "LI") {
			listItemsHTML.push(children[i].innerHTML);
		}
	}
	// sort the array
	listItemsHTML.sort();
	// replace the contents of the list with it
	list.innerHTML = "";
	for (var i = 0; i < listItemsHTML.length; i++) {
		list.innerHTML += "<li>" + listItemsHTML[i] + "</li>";
	}
}

function sortTable(tableId) {
	var table = document.getElementById(tableId);
	var rows = table.getElementsByTagName("tr");
	var newRows = [];
	var i, x, y;
	for (i = 1; i < (rows.length - 1); i++){
		//get values from table
		x = rows[i].getElementsByTagName("TD")[0].innerHTML;
		y = rows[i].getElementsByTagName("TD")[1].innerHTML;
		//does this row qualify?
		if (y >= 5){
			newRows.push([x, y]);
		}
	}
	//reconstruct table with refined data
	table.innerHTML = "<tr><th>Name</th><th>Score</th></tr>";
	for (i = 0; i < newRows.length; i++) {
		table.innerHTML += "<tr><td>" + newRows[i][0] + "</td><td>" + newRows[i][1] + "</td></tr>";
	}
}

function showBox(){
	var box = document.getElementById("ghostBox");
	box.style.visibility = "visible";
}

function hideBox(){
	var box = document.getElementById("ghostBox");
	box.style.visibility = "hidden";
}

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML="Geolocation is not supported by this browser.";
	}
}
function showPosition(position) {
	var EARTH_RADIUS = 6371; //kilometres
	var DISNEY_LAT = 28.418611;
	var DISNEY_LONG = -81.581111;
	var lat1 = position.coords.latitude;
	var lon1 = position.coords.longitude;
	var lat2 = DISNEY_LAT;
	var lon2 = DISNEY_LONG;

	var x1 = lat2 - lat1;
	var deltaLat = x1.toRad();
	var x2 = lon2 - lon1;
	var deltaLon = x2.toRad();
	var a = Math.sin(deltaLat/2) * Math.sin(deltaLat/2)
			+ Math.cos(lat1.toRad()) * Math.cos(lat2.toRad())
			* Math.sin(deltaLon/2) * Math.sin(deltaLon/2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	var d = EARTH_RADIUS * c;
	//alert(d);

	document.getElementById("status").innerHTML = "Disney World is " + Math.round(d) + " kilometres from your location.";

}
function showError(error) {
	var msg = "";
	switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("status").innerHTML = msg;
}

//JSON
var wifiOne = {
	"name": "Annerley Library Wifi",
	"address": "450 Ipswich Road",
	"suburb": "Annerley, 4103",
	"latitude": -27.50942285,
	"longitude": 153.0333218
}

var wifiTwo = {
	"name": "King Edward Park (Jacob's Ladder)",
	"address": "Turbot St and Wickham Tce",
	"suburb": "Brisbane",
	"latitude": -27.46589,
	"longitude": 153.02406
}

var wifiThree = {
	"name": "King George Square",
	"address": "Ann & Adelaide Sts",
	"suburb": "Brisbane",
	"latitude": -27.46843,
	"longitude": 153.02422
}

function compareWifi(){
	var e1 = document.getElementById("selection1");
	var value1 = e1.options[e1.selectedIndex].text;

	var e2 = document.getElementById("selection2");
	var value2 = e2.options[e2.selectedIndex].text;

	switch (value1) {
    case "Wifi 1":
        wifiOneLocation = wifiOne.suburb;
        break;
    case "Wifi 2":
        wifiOneLocation = wifiTwo.suburb;
        break;
    case "Wifi 3":
        wifiOneLocation = wifiThree.suburb
        break;
	}
	switch (value2) {
    case "Wifi 1":
        wifiTwoLocation = wifiOne.suburb;
        break;
    case "Wifi 2":
        wifiTwoLocation = wifiTwo.suburb;
        break;
    case "Wifi 3":
        wifiTwoLocation = wifiThree.suburb;
        break;
	}

	window.alert(wifiOneLocation);
	window.alert(wifiTwoLocation);
	if (wifiOneLocation == wifiTwoLocation){
		document.getElementById("compareButton").style.color = "green";
	} else {
		document.getElementById("compareButton").style.color = "red";
	}
}
