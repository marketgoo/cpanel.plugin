<?php

	require("marketgoo.live.php");

    $mktgoo = new Mktgoo();
	if ($mktgoo->is_registered()) $mktgoo->open_site();

	echo $mktgoo->html_header();
?>
<style type="text/css">

.marketgoo-form {
	padding: 20px;
}

.marketgoo-form h1 {
	color: #444;

	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 24px;
	font-weight: bold;

	line-height: 50px;
	text-align: right;
	background: url('logo.png') no-repeat left center;

	margin: 0px 0px 30px;
}

.marketgoo-form h2 {
	color: #444;

	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 18px;
	font-weight: bold;

	margin: 20px 0px 10px;
}

.marketgoo-form p {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 12px;
	color: #333;
	line-height: 1.5em;
}

.config-group {
	background: #eee;
	padding: 20px;
}

.config-group .errors {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	font-weight: bold;
	margin-bottom: 10px;
	padding: 3px 0px;
	text-align: center;
	background: #ff8c8b;
	display: none;
}

.config-group label {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	font-weight: bold;
	float: left;
	width: 150px;
	padding-top: 5px;
	color: #666;
}

.config-group label small {
	display: block;
	font-weight: normal;
}

.config-group input {
	font-size: 14px;
	padding: 2px;
	width: 300px;
}

.control-group {
	padding: 0px 0px 0px 100px;
}

.form-actions {
	margin: 20px 0px 0px 250px;
}

.marketgoo-form p.disclaimer {
	margin: 20px 0px 0px 250px;
	font-size: 11px;
}

</style>

<div class="marketgoo-form">
	<h1>Welcome to MarketGoo!</h1>

	<p>With our tools you will be able to <strong>submit your site</strong> to
	Google, <strong>improve your SEO</strong>, and enhance your overall
	<strong>online marketing strategy</strong>. Start increasing your revenue
	by receiving more <strong>qualified leads</strong> with MarketGoo!</p>

    <h2>Please fill in the following details for registration:</h2>

	<form id="mktgooForm" action="https://panel.marketgoo.com/ajax/cpanel_signup" class="form-horizontal">
	<input type="hidden" name="jsb982bn3s" value="en" />
	<div class="row">

        <div class="config-group">

			<div class="errors">
				Please, use a password for signup
			</div>

	        <div class="control-group">
				<label>Your web address</label>
				<div class="controls"><input type="text" name="djn3Sdc72D" value="<?php echo $mktgoo->user_domain() ?>" /></div>
			</div>

	        <div class="control-group">
				<label>Contact name</label>
				<div class="controls"><input type="text" name="alW8fDs972" /></div>
			</div>

	        <div class="control-group">
				<label>Email address</label>
				<div class="controls"><input type="text" name="98Fsd82ffd" value="<?php echo $mktgoo->user_email() ?>" /></div>
			</div>

	        <div class="control-group">
				<label>Choose a Password <small>(6 characters or numbers)</small></label>
				<div class="controls"><input type="password" name="43Hgd87234" /></div>
			</div>

	        <div class="form-actions">
	            <button id="mktgooSubmit" type="button" class="btn">Signup »</button>
	        </div>

			<p class="disclaimer">
				By clicking on Signup you agree with our 
				<a href="http://www.marketgoo.com/legal/terms" target="_blank">terms and conditions</a>
				and
				<a href="http://www.marketgoo.com/legal/privacy" target="_blank">privacy policy</a>.</p>
			</p>

    	</div>
	</div>
	</form>

	<p class="mktgoo-footer">
		<a href="http://www.marketgoo.com/" target="_blank">MarketGoo home &raquo;</a> |
		<a href="http://www.marketgoo.com/easy-seo-tool/what-is-marketgoo" target="_blank">Learn more about MarketGoo &raquo;</a>
	</p>

</div>
<script type="text/javascript">

$("#mktgooSubmit").click(function() {

	var self = $(this);
	var the_form = self.closest("form");

	function waitButton()
	{
		self.text("Sending data, please wait...");
		self.attr("disabled", "disabled");
	}

	function restoreButton()
	{
		self.attr("disabled", "");
		self.text("Signup »");
	}

	function unknownError()
	{
		$(".config-group .errors").text("There was an error with your request, please try again!").show();
	}

	waitButton();
	$.ajax({
		type: "POST",
		url: the_form.attr("action"),
		data: the_form.serialize(),
		success: function(status){
			restoreButton();
			if (status.error) {
				$(".config-group .errors").text(status.error).show();
			} else if (status.uuid) {
				var url = window.location.href;
				if (url.indexOf('?') > -1){
					url += '&signupok=' + status.uuid;
				}else{
					url += '?signupok=' + status.uuid;
				}
				return window.location.href = url;
			}
			unknownError();
		},
		error: function(){
			unknownError();
			restoreButton();
		}
	});

});

</script>

<?php echo $mktgoo->html_footer(); ?>
