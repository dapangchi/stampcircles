
<script type="text/javascript">
// Thanks to Steve Champeon (hesketh.com) for explaining the math in such a way that I could
// understand it and create this tool
// Thanks to Roberto Diez for the idea to create the "waterfall" display
// Thanks to the Rhino book, I was able to (clumsily) set up the Color object

var cursor = 0;
var colType = 'hex';
var base = 16;
var ends = new Array(new Color,new Color);
var step = new Array(3);
var palette = new Array(new Color,new Color,
new Color,new Color,new Color,new Color,new Color,new Color,new Color,new Color,
new Color,new Color);

function GetElementsWithClassName(elementName,className) {
	var allElements = document.getElementsByTagName(elementName);
	var elemColl = new Array();
	for (i = 0; i< allElements.length; i++) {
		if (allElements[i].className == className) {
			elemColl[elemColl.length] = allElements[i];
		}
	}
	return elemColl;
}

function Color(r,g,b) {
	this.r = r;
	this.g = g;
	this.b = b;
	this.coll = new Array(r,g,b);
	this.valid = cVerify(this.coll);
	this.text = cText(this.coll);
	this.bg = cText(this.coll);
}

function cVerify(c) {
	var valid = 'n';
	if ((!isNaN(c[0])) && (!isNaN(c[1])) && (!isNaN(c[2]))) {valid = 'y'}
	return valid;
}

function cText(c) {
	var result = '';
	var d = 1;
	if (colType == 'rgbp') {d = 2.55}
	for (k = 0; k < 3; k++) {
		val = Math.round(c[k]/d);
		piece = val.toString(base);
		if (colType == 'hex' && piece.length < 2) {piece = '0' + piece;}
		if (colType == 'rgbp') {piece = piece + '%'};
		if (colType != 'hex' && k < 2) {piece = piece + ',';}
		result = result + piece;
	}
	if (colType == 'hex') {result = '#' + result.toUpperCase();}
		else {result = 'rgb(' + result + ')';}
	return result;
}

function colorParse(c,t) {
	var m = 1;
	c = c.toUpperCase();
	col = c.replace(/[\#rgb\(]*/,'');
	if (t == 'hex') {
		if (col.length == 3) {
			a = col.substr(0,1);
			b = col.substr(1,1);
			c = col.substr(2,1);
			col = a + a + b + b + c + c;
		}
		var num = new Array(col.substr(0,2),col.substr(2,2),col.substr(4,2));
		var base = 16;
	} else {
		 num = col.split(',');
		 base = 10;
	}
	if (t == 'rgbp') {m = 2.55}
	var ret = new Array(parseInt(num[0],base)*m,parseInt(num[1],base)*m,parseInt(num[2],base)*m);
	return(ret);
}

function colorPour(pt,n) {
	var textObj = document.getElementById(pt + n.toString());
	var colObj = document.getElementById(pt.substring(0,1) + n.toString());
	if (pt == 'col') {temp = ends[n]} else {temp = palette[n]}
	if (temp.valid == 'y') {
		textObj.value = temp.text;
		colObj.style.backgroundColor = temp.bg;
	}
}

function colorStore(n) {
	var inVal = 'col'+n.toString();
	var inCol = document.getElementById(inVal).value;
	var c = colorParse(inCol,colType);
	ends[n] = new Color(c[0],c[1],c[2]);
	if (ends[n].valid == 'y') {colorPour('col',n)}
}

function stepCalc() {
	var steps = parseInt(document.getElementById('steps').value) + 1;
	step[0] = (ends[1].r - ends[0].r) / steps;
	step[1] = (ends[1].g - ends[0].g) / steps;
	step[2] = (ends[1].b - ends[0].b) / steps;
}

function mixPalette() {
	var steps = parseInt(document.getElementById('steps').value);
	var count = steps + 1;
	palette[0] = new Color(ends[0].r,ends[0].g,ends[0].b);
	palette[count] = new Color(ends[1].r,ends[1].g,ends[1].b);
	for (i = 1; i < count; i++) {
		var r = (ends[0].r + (step[0] * i));
		var g = (ends[0].g + (step[1] * i));
		var b = (ends[0].b + (step[2] * i));
			palette[i] = new Color(r,g,b);
	}
	for (j = count + 1; j < 12; j++) {
		palette[j].text = '';
		palette[j].bg = 'white';
	}
}

function drawPalette() {
	stepCalc();
	mixPalette();
	for (i = 0; i < 12; i++) {
		colorPour('pal',i);
	}
}

function setCursor(n) {
	cursor = n;
	var obj1 = document.getElementById('col0');
	var obj2 = document.getElementById('col1');
	obj1.style.backgroundColor = '';
	obj2.style.backgroundColor = '';
	if (cursor >= 0 && cursor <= 1) {
		document.getElementById('col'+cursor).style.backgroundColor = '#FF9';
	}
}

function colorIns(c) {
	var obj = document.getElementById('col'+cursor);
	var result = colorParse(c,'hex');
	ends[cursor] = new Color(result[0],result[1],result[2]);
	obj.value = ends[cursor].text;
	if (ends[cursor].valid == 'y') {colorPour('col',cursor)}
}

function setType(inp) {
	colType = inp;
	if (inp == 'hex') {base = 16;} else {base = 10;}
	for (i = 0; i < 2; i++) {
		var obj = document.getElementById('col' + i);
		if (ends[i].valid == 'y') {
			ends[i] = new Color(ends[i].r,ends[i].g,ends[i].b);
			obj.value = ends[i].text;
		}
	}
	drawPalette();
	document.getElementById('hex').className = '';
	document.getElementById('rgbd').className = '';
	document.getElementById('rgbp').className = '';
	document.getElementById(inp).className = 'coltype';
}

function init(inp) {
    alert('initialized');
	if (!inp) {
		obj = GetElementsWithClassName('a','coltype');
		inp = obj[0].id;
	}
	document.getElementById(inp).className = 'coltype';
	for (i = 0; i < 2; i++) {
		ends[i] = new Color;
		document.getElementById('col'+i).value = '';
		document.getElementById('c'+i).style.background = 'white';
	}
	for (j = 0; j < 12; j++) {
		palette[j] = new Color;
		document.getElementById('pal'+j).value = '';
		document.getElementById('p'+j).style.background = 'white';
	}
	document.getElementById('steps').value = '0';
	document.getElementById('col0').focus();
}
</script>