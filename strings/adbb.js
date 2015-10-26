/*
V.1.1
O.May 16 2007 
A.Zed Gu @ Eachui Team
D.ADS Banner Show Box
Copyright (c) 2007, Eachnet All rights reserved.
*/

function EADBB(pName, pID) {
	this.b = document.createElement('DIV');
	this.c = document.createElement('div');
	this.u = document.createElement('ul');
	this.ads = new Array();
	this.sum = 0;
	this.on = 0;
	this.speed = 7;
	this._start = 0;
	this.cbarHeight = 26;
	this.timer = null;
	this.auto = true;
	this._name_ = pName;
	this._id = pID;
	//this.b.style.height = ($(this._id).offsetHeight - this.cbarHeight) + 'px';
    //    this.b.style.width = ($(this._id).offsetWidth) + 'px';
	this.b.style.height = 280 + "px";
    this.b.style.width = 655 + "px";

	this.show = function() {
		this.b.style.overflow = 'hidden';
		this.b.style.background = '#FFFFFF';
		this.c.style.height = this.cbarHeight + 'px';
		this.c.style.width = this.b.style.width;
		this.c.style.marginTop = '-4px';
		this.c.style.backgroundPosition = '0 4px';
		this.c.style.backgroundRepeat = 'repeat-x';
		this.u.style.height = this.c.style.height;
		this.u.style.margin = 'auto';
		$(this._id).style.position = 'relative';
		$(this._id).appendChild(this.b);
		$(this._id).appendChild(this.c);
		this.c.appendChild(this.u);
		this._start = arguments[Math.floor(Math.random() * arguments.length)] - 1;
		this._start == 0 ? this.ac() : this.cac(this._start);
	}
	this.add = function(tID,tType,tSrc,tURL) {//[,tTimer]
		this.ads[this.sum] = document.createElement('div');
		this.ads[this.sum].style.position = 'absolute';
		this.ads[this.sum].style.height = this.b.style.height;
		this.ads[this.sum].style.width = this.b.style.width;
		this.ads[this.sum].l = document.createElement('li');
		this.ads[this.sum].l.style.cssFloat = 'left';
		//控制序号间距
		this.ads[this.sum].l.style.width = 18 + 'px';
		
		this.ads[this.sum].a = document.createElement('a');
		this.ads[this.sum].id = tID;
		this.ads[this.sum].timer = ((arguments.length > 4) ? arguments[4] : this.speed) * 1000;
		var self = this._name_;
		if (tType == 'img' || tType == 'map') {
			var tO = document.createElement('img');
			var a = null;
			tO.src = tSrc;
			tO.style.border = 'none';
			tO.style.height = this.b.style.height;
			tO.style.width = '100%';
			if (tType == 'img') {
				a = document.createElement('a');
				a.href = (tURL == '') ? '#' : tURL;
				a.target = '_blank';
				a.appendChild(tO);
				this.ads[this.sum].appendChild(a);
			} else {
				tO.isMap = true;
				tO.useMap = '#' + tID + 'map';
				this.ads[this.sum].appendChild(tO);
			}
		} else if (tType == 'swf') {
			var so = new SWFObject(tSrc, this.ads[this.sum].id + 'swf', '100%', '100%', "8", "#FFFFFF");
			so.addParam("wmode", "transparent");
			so.write(this.ads[this.sum]);
		}
		this.ads[this.sum].onmouseover = this.ads[this.sum].onmousemove = function() {
			eval(self + '.auto = false;');
		}
		this.ads[this.sum].onmouseout = function() {
			eval(self + '.auto = true;');
		}
		this.b.appendChild(this.ads[this.sum]);
		this.ads[this.sum].a.style.display = 'block';
		this.ads[this.sum].a.style.color = '#000000';
		//控制序号字体大小
		this.ads[this.sum].a.style.fontSize = '10px';
		this.ads[this.sum].a.style.lineHeight = '28px';
		this.ads[this.sum].a.style.textDecoration = 'none';
		this.ads[this.sum].a.hideFocus = true;
		this.ads[this.sum].a.style.height = '26px';
		this.ads[this.sum].a.style.textAlign = "center";
		this.ads[this.sum].a.href = 'javascript:' + this._name_ + '.cac(' + this.sum + ');';
		this.ads[this.sum].a.innerHTML = this.sum + 1 + '';
		this.ads[this.sum].l.appendChild(this.ads[this.sum].a);
		this.u.appendChild(this.ads[this.sum].l);
		this.sum++;
		this.u.style.width = (18 * this.sum) + 'px';
		return this.sum;
	}
	this.ac = function() {
		if (this.auto) {
			for (var i = 0; i < this.sum; i++) {
				this.ads[i].l.style.marginTop = '0';
				
				
				this.ads[i].style.visibility = 'hidden';
				this.ads[i].a.style.backgroundImage = '';
				this.ads[i].a.style.color = '#999999';
				this.ads[i].a.style.fontWeight = 'bold';
				this.ads[i].a.style.lineHeight = '28px';
			}
			if (arguments.length > 0) {
				this.on = arguments[0];
			}
			this.ads[this.on].l.style.marginTop = '0px';

			this.ads[this.on].a.hidefocus = true;
			this.ads[this.on].style.visibility = 'visible';
			this.ads[this.on].a.style.backgroundImage = 'url(http://www.chinadaily.com.cn/images/adbbbtnon.gif)';
			this.ads[this.on].a.style.backgroundRepeat = 'no-repeat';		
			this.ads[this.on].a.style.backgroundPosition = '3 9px';
			this.ads[this.on].a.style.lineHeight = '28px';
			this.ads[this.on].a.style.color = '#F58306';
			
			this.timer = window.setTimeout(this._name_ + '.ac()',this.ads[this.on].timer);
			this.on++;
			if (this.on == this.sum) {
				this.on = 0;
			}
		} else {
			window.setTimeout(this._name_ + '.ac()',this.speed * 1000);
		}
	}
	this.cac = function(tID) {
		window.clearTimeout(this.timer);
		this.ac(tID);
	}
}

