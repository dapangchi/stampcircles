'use strict';

var IndexView = function(app) {
	this.app = app;
	var source = $('#indexView-template').html();
	this.template = Handlebars.compile(source);
};

IndexView.prototype.fetchData = function(params) {
	return this.app.dataProvider.fetchView('all', params);
};

IndexView.prototype.render = function(data) {
	return this.template({items: data});
};