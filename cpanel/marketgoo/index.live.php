<?php
	require("marketgoo.live.php");

	$mktgoo = new Mktgoo();
	if ($mktgoo->is_registered()) $mktgoo->open_site();

	echo $mktgoo->html_header();
?>
<style type="text/css">

body{
	line-height: 23px !important;
	font-family: "Open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
}

form{
	max-width: none;
}

#mktgooForm {
	margin-top: 30px;
	margin-bottom: 100px;
}

.marketgoo-form {
	padding: 20px;
	margin-top: 30px;
}

.logo{
	height: 62px;
	margin: -30px 0px 5px 0px;
}

.marketgoo-form p {
	font-size: 14px;
	color: #7f7f7f;
	line-height: 20px;
}

.config-group {
	background: #eee;
	padding: 110px 20px 20px 20px;
	position: relative;
	border-radius: 5px;
}

.config-group .errors {
	font-size: 14px;
	font-weight: bold;
	margin-bottom: 10px;
	padding: 3px 0px;
	text-align: center;
	background: #ff8c8b;
	display: none;
}

.config-group label {
	font-size: 16px;
	font-weight: normal;
	line-height: 30px;
	width: 22%;
	color: #666;
	text-align: right;
	padding: 5px 11px 0px 0px;
	display: inline-block;
	vertical-align: middle;
}

.config-group label small {
	display: block;
	font-weight: normal;
}

.config-group label.double-line{
	line-height: 16px;
}

.config-group input {
	font-size: 14px;
	padding: 2px;
	width: 350px;
}


.controls{
	display: inline-block;
	vertical-align: middle;
}

.control-group {
	text-align: center;
}

.marketgoo-form input{
	border: solid 1px #bbb;
	border-radius: 2px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	outline: none!important;
	background: #fff;
	font-size: 16px;
	padding: 8px 8px 6px;
	margin-bottom: 5px;
}

.marketgoo-form .btn{
	border-radius: 9px;
	-webkit-border-radius: 9px;
	-moz-border-radius: 9px;
	background: #ff5700;
	color: white;
	border: none;
	padding: 10px 50px;
	font-size: 18px;
}

.marketgoo-form .btn:hover{
	cursor: pointer;
	background-color: #cc4600;
}

.marketgoo-form .form-actions {
	margin: 20px 0px 0px 0px;
	text-align: center;
}

.marketgoo-form p.disclaimer {
	margin: 0px;
	font-size: 11px;
}

.marketgoo-form p.disclaimer a{
	color: #ff5700;
}

.marketgoo-form h2{
	color: #515151;
	margin: 20px 0px;
	font-size: 24px;
	font-weight: bold;
	text-align: left;
	line-height: 1.4em;
}

.marketgoo-form .blue-header{
	color: white;
	background: #3fb6fd;
	padding: 15px 20px;
	margin: 0px 0px 30px 0px;
	font-size: 16px;
	font-weight: normal;
	position: absolute;
	left: 0;
	right: 0;
	top: 29px;
	text-align: center;
}

.testimonial{
	margin-bottom: 60px;
	text-align: center;
}

.testimonial div{
	display: inline-block;
	vertical-align: middle;
}

.testimonial-text{
	width: 62%;
	margin-right: 2%;
}

.testimonial-image{
	width: 35%;
	margin-top: 30px;
}

.testimonial-text h3{
	background: none;
	font-weight: normal;
	color: #515151;
	font-size: 24px;
	text-align: left;
}

.testimonial-text p{
	text-align: left;
	font-style: italic;
	line-height: 24px;
}

.testimonial-text p.signature{
	color: #515151;
	font-weight: bold;
	font-style: normal;
	line-height: 18px;
}

.testimonial-text p.signature a{
	color: #3fb6fd;
	font-weight: normal;
	font-size: 13px;
}

.screenshot{
	text-align: center;
	margin: 20px 0px 35px 0px;
}

.screenshot img{
	-webkit-box-shadow: 0px 0px 50px rgba(0,0,0,0.4);
	-moz-box-shadow: 0px 0px 50px rgba(0,0,0,0.4);
	box-shadow: 0px 0px 50px rgba(0,0,0,0.4);
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
}

.preview-title{
	background: none;
	font-weight: normal;
	color: #515151;
	font-size: 23px;
	text-align: left;
	margin-bottom: 5px;
}

.diagrams{
	position: relative;
	text-align: center;
	padding: 30px 0px 50px;
}

.diagrams img {
	-webkit-box-shadow: 0px 0px 50px rgba(0,0,0,0.4);
	-moz-box-shadow: 0px 0px 50px rgba(0,0,0,0.4);
	box-shadow: 0px 0px 50px rgba(0,0,0,0.4);
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	max-width: 100%;
	height: auto;
}

.diagrams ul.pins{
	list-style: none outside;
}

.diagrams .pins li{
	width: 190px;
	position: absolute;
	text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
}

.diagrams .pins li h3{
	background: none;
	color: #515151;
	font-size: 15px !important;
}

.diagrams .pins .pin-evolucion {
	top: 130px;
	left: 50%;
	padding-right: 10px;
	border-top: 1px solid #bbb;
	text-align: left;
	margin-left: -483px;
}

.diagrams .pins .pin-interfaz {
	top: 47px;
	right: 50%;
	text-align: right;
	border-top: 1px solid #bbb;
	padding-left: 10px;
	margin-right: -465px;
}

.diagrams .pins .pin-tareas {
	top: 294px;
	right: 50%;
	text-align: right;
	border-top: 1px solid #bbb;
	padding-left: 10px;
	margin-right: -472px;
}

.to-top{
	text-align: center;
	margin: 45px 0px;
}

</style>

<div class="marketgoo-form">

	<h2><?php echo $mktgoo->translate("Get started today with our 6 SEO tools (free for life!) and we'll unlock the full potential of MarketGoo with a free 10 day trial!"); ?></h2>
	<p><?php echo $mktgoo->translate("With our tools you will be able to <strong>submit your site</strong> to Google, <strong>improve your SEO</strong>, and enhance your overall <strong>online marketing strategy</strong>. Start increasing your revenue by receiving more <strong>qualified leads</strong> with MarketGoo!");?></p>

	<form id="mktgooForm" action="https://app.marketgoo.com/ajax/cpanel_signup" class="form-horizontal">
	<input type="hidden" name="8fd4e056c2" value="cpanel" />
	<input type="hidden" name="jsb982bn3s" value="<?php echo $mktgoo->user_language() ?>" />
	<input type="hidden" name="mxjh72nsj2" value="<?php echo $mktgoo->user_country() ?>" />
	<input type="hidden" name="25fa5ad84b" value="<?php echo $mktgoo->user_ip() ?>" />
	<input type="hidden" name="f12aa96c3b" value="<?php echo $mktgoo->reseller_id() ?>" />
	<input type="hidden" name="36bb2f20a5" value="<?php echo $mktgoo->partner_id() ?>" />

	<div class="row">
		<div class="config-group">

			<h2 class="blue-header">
				<?php echo $mktgoo->translate("Sign up and get your free SEO tools and 10 day trial upgrade! It takes less than 50 seconds:");?>
			</h2>

			<div class="errors"></div>

			<div class="control-group">
				<label><?php echo $mktgoo->translate("Your web address");?></label>
				<div class="controls"><input type="text" name="djn3Sdc72D" value="<?php echo $mktgoo->user_domain() ?>" /></div>
			</div>

			<div class="control-group">
				<label><?php echo $mktgoo->translate("Contact name");?></label>
				<div class="controls"><input type="text" name="alW8fDs972" /></div>
			</div>

			<div class="control-group">
				<label><?php echo $mktgoo->translate("Email address");?></label>
				<div class="controls"><input type="text" name="98Fsd82ffd" value="<?php echo $mktgoo->user_email() ?>" /></div>
			</div>

			<div class="control-group">
				<label class="double-line"><?php echo $mktgoo->translate("Choose a Password");?><small><?php echo $mktgoo->translate("(6 characters or numbers)");?></small></label>
				<div class="controls"><input type="password" name="43Hgd87234" /></div>
			</div>

			<div class="form-actions">
				<button id="mktgooSubmit" type="button" class="btn"><?php echo $mktgoo->translate("Start improving my website");?> »</button>
				<p class="disclaimer">
					<?php echo $mktgoo->translate("All fields are requiered");?>.
					<?php echo $mktgoo->translate("By clicking on Signup you agree with our");?> 
					<a href="http://www.marketgoo.com/legal/terms" target="_blank"><?php echo $mktgoo->translate("terms and conditions");?></a>
					<?php echo $mktgoo->translate("and");?>
					<a href="http://www.marketgoo.com/legal/privacy" target="_blank"><?php echo $mktgoo->translate("privacy policy");?></a>.
				</p>
			</div>

		</div>
	</div>
	</form>

	<img src="logo.png" class="logo" />
	<div class="screenshot">
		<h3 class="preview-title"><?php echo $mktgoo->translate("MarketGoo is EASY to use");?></h3>
		<div class="diagrams">

		<img src="<?php echo $mktgoo->translate("screenshot_en.jpg");?>" width="600" height="429">
		<ul class="pins">
			<li class="pin-evolucion">
				<h3><?php echo $mktgoo->translate("Track your progress");?></h3>
				<p><?php echo $mktgoo->translate("We prioritize your actions so you can measure your progress.");?></p>
			</li>
			<li class="pin-interfaz">
				<h3><?php echo $mktgoo->translate("Easy to use interface");?></h3>
				<p><?php echo $mktgoo->translate("Three simple work areas, built to help you.");?></p>
			</li>
			<li class="pin-tareas">
				<h3><?php echo $mktgoo->translate("Customized tasks");?></h3>
				<p><?php echo $mktgoo->translate("We analyze your web site daily to show you a customized task list.");?></p>
			</li>
		</ul>
	</div>
	</div>

	<div class="testimonial">
		<div class="testimonial-text">
			<h3><?php echo $mktgoo->translate("Our customers feedback");?></h3>
			<p>
				"<?php echo $mktgoo->translate("After using MarketGoo for some weeks, results are thriving. I've managed to beat my competitors in rankings that are of importance to me. The visit results I see on Google Analytics are growing and now I better understand how to improve my results. MarketGoo is an addictive app and easy to use. You do not need any technical knowledge but mostly it allows you to control the reach of your company’s branding, and there is none better suited for this task than yourself.");?>"
			</p>
			<p class="signature">
				- Jose Sampayo <br/>
				<a href="http://www.endoscopiaveterinaria.es" target="_blank">(www.endoscopiaveterinaria.es)</a>
			</p>
			
		</div>

		<div class="testimonial-image">
			<img src="testimonial.jpg" alt="Jose Sampayo" />
		</div>
	</div>

	<div class="to-top">
		<button id="toTop" type="button" class="btn"><?php echo $mktgoo->translate("Let's go!");?> »</button>
	</div>

	<p class="mktgoo-footer">
		<a href="http://www.marketgoo.com/" target="_blank"><?php echo $mktgoo->translate("MarketGoo home");?> &raquo;</a> |
		<a href="http://www.marketgoo.com/easy-seo-tool/what-is-marketgoo" target="_blank"><?php echo $mktgoo->translate("Learn more about MarketGoo");?> &raquo;</a>
	</p>

</div>

<script type="text/javascript">

function attach_events($)
{
	$("#toTop").click(function(){
		$('body').animate({ scrollTop: $("#mktgooForm").offset().top }, 'slow');
	})

	$("#mktgooSubmit").click(function() {

		var self = $(this);
		var the_form = self.closest("form");

		function waitButton()
		{
			self.text("<?php echo $mktgoo->translate("Sending data, please wait...");?>");
			self.attr("disabled", "disabled");
		}

		function restoreButton()
		{
			self.attr("disabled", false);
			self.text("<?php echo $mktgoo->translate("Start improving my website");?> »");
		}

		function unknownError()
		{
			$(".config-group .errors").text("<?php echo $mktgoo->translate("There was an error with your request, please try again!");?>").show();
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
					return;
				} else if (status.uuid) {
					var url = window.location.href;
					if (url.indexOf('?') > -1) {
						url += '&signupok=' + status.uuid;
					} else {
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
}

document.addEventListener("DOMContentLoaded", function() {
	if (typeof require === "function") {
		require(["jquery"], function(jQuery) { attach_events(jQuery); });
	} else {
		attach_events(jQuery);
	}
});
</script>

<?php echo $mktgoo->html_footer(); ?>
