/*
V.0.2
O.May 16 2007 
A.Zed Gu @ Eachui Team
D.Eachnet Javascript Object
Copyright (c) 2007, Eachnet All rights reserved.
*/
var _doc = (document.compatMode != "BackCompat") ? document.documentElement : document.body;
String.prototype.int = function() {
	return parseInt(this,10);
}

function $(tS) {
	if (typeof(tS) == 'string') {
		return document.getElementById(tS);
	}
}

function EJO() {
	this.version = 0.2;
	this.copyright = 'chinadaily.com.cn';
	this._name = 'ejo';
	this._oo = new Object();
	this.onload = function(tF) {
		this._oo[tF] = tF;
	}
	this.onloadAction = function() {
		for (var f in this._oo) {
			try {
				eval(f + '();');
			} catch (e) {
				return f;
			}
		}
		this._oo = null;
		return true;
	}
	this.href = function() {
		var a = document.getElementsByTagName("a");
		var s = '';
		for (var i = 0;i<a.length;i++) {
			if (a[i].href.match('#$')) {
				a[i].onclick = function() {return false};
				continue;
			}
			if (a[i].href.match('javascript:')) {
				s = a[i].href.replace('javascript:','');
				a[i].href = '#';
				eval('a[i].onclick = function() {'+s+';return false;}');
				continue;
			}
		}
	}
}
function EJOC() {
	this.load = function(tKey) {
		var tC = document.cookie.split('; ');
		var tO = new Object();
		var a = null;
		for (var i = 0; i < tC.length; i++) {
			a = tC[i].split('=');
			tO[a[0]] = a[1];
		}
		return tO;
	}
	this.set = function() {
		var d = new Date();
		var i = arguments.length;
		var key = i>0 ? arguments[0] : 'undefined';
		var value = i>1 ? arguments[1] : '';
		var expires = i>2 ? d.setTime(d.getTime() + (arguments[2] * 1000 * 60)) : null;
		var path = i>3 ? arguments[3] : null;
		var domain = null;
		document.cookie = key + '=' + escape(value) + ((expires == null) ? '' : (';expires=' + d.toGMTString())) + ((path == null) ? '' : (';path=' + path)) + ((domain == null) ? '' : (';domain=' + domain));
		return this.get(key);
	}
	this.get = function(tKey) {
		if (this.load()[tKey]) {
			return this.load()[tKey];
		} else {
			return false;
		}
	}
	this.del = function(tKey) {
		if (this.get[tKey]) {
			var d = new Date();
			document.cookie = tKey + '=null; expires=' + d.setTime(d.getTime()).toGMTString();
		}
	}
	this.destroy = function() {
		var d = new Date();
		for (var key in this.load()) {
			document.cookie = this.load()[key] + ';expires=' + d.setTime(d.getTime()).toGMTString();
		}
	}
}
var ejo = new EJO();
window.onload = function() {
	ejo.onloadAction();
	ejo.href();
}
