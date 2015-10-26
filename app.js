'use strict';

$(document).ready(function() {
Handlebars.registerHelper("debug", function(optionalValue) {
  console.log("Current Context");
  console.log("====================");
  console.log(this);
 
  if (optionalValue) {
    console.log("Value");
    console.log("====================");
    console.log(optionalValue);
  }
});

	var App = {
		start: function() {
			this.dataProvider = new DataProvider();

			this.router = Router(routes);
			this.router.configure({
				html5history: true
			});

			this.router.init();
		},
		user: {
			id: 'ivan'
		}
	};


	var routes = {
		'/': function() {
			var indexView = new IndexView(App);
			indexView.fetchData().then(function(result) {
				$('.page-layout').empty();
				$('.page-layout').append(indexView.render(result.rows));

				$('.link-to').on('click', function() {
					App.router.setRoute($(this).data('href'));
					return false;
				});
			});
		},
		'/create': function() {
			var editView = new EditView(App);

			$('.page-layout').empty();
			$('.page-layout').append(editView.render({}));
		},
		'/:id/edit': function(id) {
			var editView = new EditView(App);

			editView.fetchData(id).then(function() {
				editView.render();
			});
		},
	};


	App.start();
});