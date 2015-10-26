'use strict';

var DataProvider = function() {
	this.dbProxyRoot = 'db';
	this.database = 'materials';
};

DataProvider.prototype._buildUrl = function() {
	return ['/', this.dbProxyRoot, '/', this.database].join('');
};

DataProvider.prototype._makeRequest = function(data, type, url) {
	url = url || this._buildUrl();
	console.log({
		url: url,
		contentType: 'application/json',
		data: data,
		dataType: 'json',
		type: type
	});
	if (['post', 'put'].indexOf(type.toLowerCase()) !== -1) {
		data = JSON.stringify(data);
	}
	return $.ajax({
		url: url,
		contentType: 'application/json',
		data: data,
		dataType: 'json',
		type: type
	});
};

DataProvider.prototype.create = function(data) {
	return this._makeRequest(data, 'POST');
};

DataProvider.prototype.update = function(data) {
	var url = [this._buildUrl(), data._id].join('/');
	return this._makeRequest(data, 'PUT', url);
};

DataProvider.prototype.fetchView = function(viewName, params) {
	var url = [this._buildUrl(), '/_design/materials/_view/', viewName].join('');
	return this._makeRequest(params, 'GET', url);
};
