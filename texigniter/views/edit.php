<html>
<head>
	<title>Jquery couchdb admin</title>
	<link rel="stylesheet" href="/public/css/index.css" type="text/css" />
	<script type="text/javascript" src="/public/js/lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="/public/director.min.js"> </script>
	<script type="text/javascript" src="/public/handlebars-v1.3.0.js"></script>
	<script type="text/javascript" src="/public/js/lib/pikaday.js"></script>
	<script type="text/javascript" src="/public/js/lib/pikaday.jquery.js"></script>
	<script type="text/javascript" src="/public/index.js"></script>
	<script type="text/javascript" src="/public/edit.js"></script>
	<script type="text/javascript" src="/public/provider.js"></script>
	<script type="text/javascript" src="/public/js/utils.js"></script>
	<script type="text/javascript" src="/public/js/app.js"></script>
</head>
<body>
	<div class="container">
		<div class="row page-layout">
		</div>
	</div>

	<script id="indexView-template" type="text/x-handlebars-template">
		<h2>Materials</h2>
		<p>
			<button class="btn btn-primary link-to" data-href="create">Create</button>
		</p>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Description</th>
					<th>Supplier</th>
					<th>Budget</th>
					<th>Require by</th>
			</thead>
			<tbody>
				{{#each items}}
					<tr>
						{{#with value}}
							<td> <button class="btn btn-link link-to" data-href="{{_id}}/edit">{{description}}</button></td>
							<td>{{supplier}}</td>
							<td>{{budget}}</td>
							<td>
								{{#each requiredBy}}
									{{day}}.{{{month}}}.{{year}}
								{{/each}}
							</td>
						{{/with}}
					</tr>
				{{/each}}
			</tbody>
		</table>
	</script>

	<script id="commentsList-template" type="text/x-handlebars-template">
		{{debug}}
		{{#each items}}
			<div class="row comment-wrap">
				<div class="col-md-9">
					<div class="comment">
						<div class="comment__author">{{userid}}</div>
						<i class="comment__date">{{date}}</i>
						<p class="comment__text">{{comment}}</p>
					</div>
				</div>
				<div class="col-md-2 comment__delete-control">
					<button class="btn btn-danger comment__delete" data-index="{{@index}}">Delete</button>
				</div>
			</div>
		{{else}}
			<p>There is no comments yet</p>
		{{/each}}
	</script>

	<script id="transactionsList-template" type="text/x-handlebars-template">
		{{#each items}}
			<p>{{id}}</p>
			<p>{{type}}</p>
			<p>{{date}}</p>
		{{else}}
			<p>There is no transactions yet</p>
		{{/each}}
	</script>

	<script id="editView-template" type="text/x-handlebars-template">
		<div class="col-md-10 col-md-offset-1">
			{{#if model._id}}
				<h2>Edit material</h2>
			{{else}}
				<h2>Create material</h2>
			{{/if}}
			{{debug}}
			<form class="material-edit-form" method="POST">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<label for="description" class="control-label">Description</label>
							<input type="text" class="form-control" name="description" placeholder="Type description" value="{{model.description}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="shortDescription" class="control-label">Short description</label>
							<input type="text" class="form-control" name="shortDescription" placeholder="Type short description" value="{{model.shortDescription}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="supplier" class="control-label">Supplier</label>
							<input type="text" class="form-control" name="supplier" placeholder="Type supplier" value="{{model.supplier}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="department" class="control-label">Department</label>
							<select class="form-control" name="department">
								<option value="mechanical" selected>mechanical</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="class" class="control-label">Class</label>
							<select class="form-control" name="class">
								<option value="equipment" selected>equipment</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="code" class="control-label">Code</label>
							<input type="text" class="form-control" name="code" placeholder="Type code" value="{{model.code}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="budget" class="control-label">Budget</label>
							<input type="text" class="form-control" name="budget" placeholder="Type budget" value="{{model.budget}}">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label>Long lead:&nbsp;</label>
						<div class="radio-inline">
							<label>
								<input type="radio" name="longLead" value="true" {{#if model.longLead}}checked="checked"{{/if}}>
								True
							</label>
						</div>
						<div class="radio-inline">
							<label>
								<input type="radio" name="longLead" value="false" {{#unless model.longLead}}checked="checked"{{/unless}}>
								False
							</label>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="requiredByFrom" class="control-label">Required by from</label>
							<input type="text" class="form-control" name="requiredByFrom" placeholder="Select from date" value="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="requiredByTo" class="control-label">Required by to</label>
							<input type="text" class="form-control" name="requiredByTo" placeholder="Select to date" value="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="eta" class="control-label">Estimated time of arrival</label>
							<input type="text" class="form-control" name="eta" placeholder="Select estimated time of arrival" value="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="mm1Approval" class="control-label">mm1 approve</label>
							<input type="text" class="form-control" name="mm1Approval" placeholder="Select approve date" value="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="mm2Approval" class="control-label">mm2 approve</label>
							<input type="text" class="form-control" name="mm2Approval" placeholder="Select approve date" value="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="pdApproval" class="control-label">pd approve</label>
							<input type="text" class="form-control" name="pdApproval" placeholder="Select approve date" value="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="bodApproval" class="control-label">Board of directors approve</label>
							<input type="text" class="form-control" name="bodApproval" placeholder="Select approve date" value="">
						</div>
					</div>
				</div>

				<div class="row hide-list-control">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12">
								<h4>
									<span>Comments</span>
									<button class="btn btn-link hide-list-control__toggle" data-state="hidden">show</button>
								</h4>
							</div>
						</div>
						<div class="row hide-list-control__items">
							<div class="col-md-12">
									<div class="comments-l">
									</div>
									<div class="hide-list-control__items__add">
										<label for="commentText" class="control-label">Enter comment text</label>
										<textarea class="form-control" name="commentText"></textarea>
										<button class="btn btn-primary comment-add">Add comment</button>
									</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row hide-list-control">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<h4>
								<span>Transactions</span>
								<button class="btn btn-link hide-list-control__toggle" data-state="hidden">show</button>
								</h4>
							</div>
						</div>
						<div class="row hide-list-control__items">
							<div class="col-md-9">
									<div class="transactions-l">
									</div>
									<div class="hide-list-control__items__add">
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="transactionId" class="control-label">Transaction id</label>
													<input type="text" class="form-control" name="transactionId" placeholder="Type transaction id"/>
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label for="transactionType" class="control-label">Transaction type</label>
													<input type="text" class="form-control" name="transactionType" placeholder="Type transaction type"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="transactionDate" class="control-label">Transaction date</label>
													<input type="text" class="form-control" name="transactionDate" placeholder="Select transaction date"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<button class="btn btn-primary transaction-add">Add transaction</button>
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row edit-form__submit">
					<div class="col-md-4">
						<div class="form-group">
							<input type="submit" class="form-control btn btn-primary" name="editFormSubmit" value="Save">
						</div>
					</div>
				</div>
			</form>
		</div>
	</script>
</body>
</html>