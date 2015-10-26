var Utils = {
	zeroForwardedInt: function(value) {
		return value < 10 ? '0' + value : value.toString();
	},
	requiredByToDate: function(requiredBy) {
		var date = new Date();
		if (requiredBy) {
			date.setDate(requiredBy.day);
			date.setMonth(requiredBy.month);
			date.setFullYear(requiredBy.year);
		}
		return date;
	},

	dateToRequiredBy: function(date) {
		var requiredBy = {};

		requiredBy.month = this.zeroForwardedInt(date.getMonth() + 1);
		requiredBy.day = this.zeroForwardedInt(date.getDate());
		requiredBy.year = date.getFullYear();

		return requiredBy;
	},

	dottedDateToDate: function(dottedDate) {
		var date = new Date();
		if (dottedDate) {
			var parts = dottedDate.split('.');
			date.setDate(parseInt(parts[0], 10));
			date.setMonth(parseInt(parts[1], 10));
			var baseYear = 2000;
			date.setFullYear(baseYear + parseInt(parts[2], 10));
		}
		return date;
	},

	dateToDottedDate: function(date) {
		if (!date) {
			throw new Error('date shoul be specified');
		}
		var month = date.getMonth() + 1;
		var day = date.getDate();
		var year = date.getFullYear().toString().slice(-2);

		return [
			day < 10 ? '0' + day : day,
			month < 10 ? '0' + month : month,
			year
		].join('.');
	}

};