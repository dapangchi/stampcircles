'use strict';

var EditView = function(app) {
	this.app = app;
	this.model = {
		type: 'material',
		internalApprovals: {},
		comments: [],
		transactions: []
	};

	var source = $('#editView-template').html();
	this.template = Handlebars.compile(source);

	source = $('#commentsList-template').html();
	this.commentsListTemplate = Handlebars.compile(source);

	source = $('#transactionsList-template').html();
	this.transactionsListTemplate = Handlebars.compile(source);
};

EditView.prototype._initDatepickers = function() {
	var self = this;

	$('[name="requiredByFrom"]').pikaday({
		defaultDate: this.model.requiredBy ? Utils.requiredByToDate(this.model.requiredBy[0]): '',
		setDefaultDate: true,
		onSelect: function(date) {
			if (!self.model.requiredBy) {
				self.model.requiredBy = [];
			}
			self.model.requiredBy[0] = Utils.dateToRequiredBy(date);
		}
	});

	$('[name="requiredByTo"]').pikaday({
		defaultDate: this.model.requiredBy ? Utils.requiredByToDate(this.model.requiredBy[1]): '',
		setDefaultDate: true,
		onSelect: function(date) {
			if (!self.model.requiredBy) {
				self.model.requiredBy = [];
			}
			self.model.requiredBy[1] = Utils.dateToRequiredBy(date);
		}
	});

	$('[name="eta"]').pikaday({
		defaultDate: this.model.eta ? Utils.requiredByToDate(this.model.eta[0]): '',
		setDefaultDate: true,
		onSelect: function(date) {
			if (!self.model.eta) {
				self.model.eta = [];
			}
			self.model.eta[0] = Utils.dateToRequiredBy(date);
		}
	});

	var approvals = ['mm1', 'mm2', 'pd', 'bod'];

	if (!this.model.internalApprovals) {
		this.model.internalApprovals = {};
	}

	for (var i in approvals) {
		var approve = approvals[i];
		var approveValue = this.model.internalApprovals[approve];
		(function(approve, approveValue) {
			$('[name="' + approve + 'Approval"]').pikaday({
				defaultDate: approveValue ? Utils.dottedDateToDate(approveValue) : '',
				setDefaultDate: true,
				onSelect: function(date) {
					self.model.internalApprovals[approve] = Utils.dateToDottedDate(date);
				}
			});
		})(approve, approveValue);
	}

};

EditView.prototype._initControls = function() {
	$('.hide-list-control__toggle').on('click', function() {
		var currentState = $(this).data('state');

		var items = $(this).parents('.hide-list-control').find('.hide-list-control__items');

		if (currentState === 'hidden') {
			$(this).data('state', 'showed')
			$(this).text('hide');
			items.show();
		} else {
			$(this).data('state', 'hidden')
			$(this).text('show');
			items.hide();
		}

		return false;
	});

	var self = this;
	
	$('[name="transactionDate"]').pikaday()

	$('.transaction-add').on('click', function() {
		var id = $('[name="transactionId"]').val();
		var type = $('[name="transactionType"]').val();
		var date = Utils.dateToDottedDate($('[name="transactionDate"]').data('pikaday').getDate());

		if (!self.model.transactions) {
			self.model.transactions = [];
		}

		self.model.transactions.push({
			id: id,
			type: type,
			date: date
		});

		self._renderTransactions();
		
		return false;
	});

	$('.comment-add').on('click', function() {
		var text = $('[name="commentText"]').val();


		if (!self.model.comments) {
			self.model.comments = [];
		}

		self.model.comments.push({
			userid: self.app.user.id,
			comment: text,
			date: Utils.dateToDottedDate(new Date())
		});

		$('[name="commentText"]').val('');

		self._renderComments();
		
		return false;
	});

};

EditView.prototype._renderComments = function() {
	$('.comments-l').empty();
	$('.comments-l').html(this.commentsListTemplate({items: this.model.comments}));

	$('.comment-wrap').hover(function() {
		$(this).find('.comment__delete-control').show();
	}, function() {
		$(this).find('.comment__delete-control').hide();
	});

	var self = this;

	$('.comment__delete').on('click', function() {
		var index = parseInt($(this).data('index'), 10);

		self.model.comments.splice(index, 1);
		self._renderComments();

		return false;
	});
};

EditView.prototype._renderTransactions = function() {
	$('.transactions-l').empty();
	$('.transactions-l').html(this.transactionsListTemplate({items: this.model.transactions}));
};

EditView.prototype.render = function() {
	$('.page-layout').empty();
	$('.page-layout').append(this.template({ model: this.model }));

	this._renderComments();
	this._renderTransactions();

	this._initDatepickers();
	this._initControls();

	var self = this;
	$('.material-edit-form').submit(function() {
		var isNew = self.model._id ? false : true;
		var material = self.model || { type: 'material' };

		material.description = $(this).find('[name="description"]').val().trim();
		material.shortDescription = $(this).find('[name="shortDescription"]').val().trim();
		material.supplier = $(this).find('[name="supplier"]').val().trim();
		material.department = $(this).find('[name="department"]').val();
		material.class = $(this).find('[name="class"]').val().trim();
		material.code = parseInt($(this).find('[name="code"]').val().trim(), 10);
		material.budget = parseInt($(this).find('[name="budget"]').val(), 10);
		material.longLead = $(this).find('[name="longLead"]:checked').val() === 'true';

		var successCallback = function(result) {
			self.model._id = result.id;
			self.model._rev = result.rev;
		};

		var failureCallback = function(result) {
			//TODO show alert
			console.log(result);
		};

		console.log('isNew', isNew);
		if (isNew) {
			self.app.dataProvider.create(material).then(successCallback, failureCallback);
		} else {
			self.app.dataProvider.update(material).then(successCallback, failureCallback);
		}

		return false;
	});
};

EditView.prototype.fetchData = function(id) {
	var preparedId = '"' + id + '"';
	var self = this;
	return this.app.dataProvider.fetchView('by_id', { key: preparedId }).then(function(result) {
		console.log(result);
		self.model = result.rows[0].value;
		return this;
	});
};