<?php global $data; ?>
<!-- START #contact-form -->
	<form id="contact-form" class="clearfix">
		<input type="text" name="name" id="contact-name" class="required"><label for="contact-name"><?php _e( '* Name' , 'hbthemes' ); ?></label>
		<input type="email" name="email" id="contact-email" class="required email"><label for="contact-email"><?php _e( '* Email' , 'hbthemes' ); ?></label>
		<input type="text" name="subject" id="contact-subject" class="required"><label for="contact-subject"><?php _e( '* Subject' , 'hbthemes' ); ?></label>
		<textarea name="message" id="contact-message" class="required"></textarea>
		<p class="form-disclaimer"><small><?php _e( "Don't worry. We never use your email for spam." , "hbthemes" ); ?></small></p>
			
		<a href="#" class="button btn-large btn-orange" id="submit-button"><?php _e( 'Submit Message' , 'hbthemes' ); ?></a>
		<span class="ajax-progress"></span>
	</form>	
<!-- END #contact-form -->	

<!-- Success Message -->
	<div class="contact-form-success-message">
		<div class="info-box info-green">          
			<div class="info-box-inner">
				<p><?php echo $data['hb_contact_success']; ?></p>
			</div>            
		</div>
	<!-- END .info-box -->        
	</div>
<!-- END Success Message -->
				
				
<!-- Error message -->
	<div class="contact-form-error-message">
		<div class="info-box info-red">          
			<div class="info-box-inner">
				<p><?php echo $data['hb_contact_error']; ?></p>
			</div>            
		</div>
	<!-- END .info-box -->
	</div>
<!-- END Error Message -->

<!-- END FORM -->
                    
<!-- Form Validation and AJAX call --> 
<script type="text/javascript">

	var nameValidate = false;
	var emailValidate = false;
	var subjectValidate = false;
	var commentsValidate = false;
		
	jQuery("#contact-name").blur(function () {
		nameValidate = jQuery("#contact-form").validate().element("#contact-name");
	});
	jQuery("#contact-email").blur(function () {
		emailValidate = jQuery("#contact-form").validate().element("#contact-email");
	});
	jQuery("#contact-subject").blur(function () {
		subjectValidate = jQuery("#contact-form").validate().element("#contact-subject");
	});
	jQuery("#contact-message").blur(function () {
		commentsValidate = jQuery("#contact-form").validate().element("#contact-message");
	});
	
	jQuery("#submit-button").click(function (e){
		e.preventDefault();
		
		function onSuccess(results)
			{
			  jQuery('.contact-form-error-message').hide();
			  jQuery('.ajax-progress').css('visibility','hidden');
			  jQuery('.contact-form-success-message').show(150);
			}
		  
		if( jQuery(this).is(".submitted-button")) return false;
		
		if( nameValidate && subjectValidate && emailValidate && commentsValidate ) {
			
			jQuery('.contact-form-error-message').hide();
			jQuery('#submit-button').addClass("submitted-button");
			jQuery('#submit-button').addClass("inactive");

			jQuery('.ajax-progress').css('visibility', 'visible');
			
			jQuery('#contact-name, #contact-subject, #contact-email, #contact-message').attr("disabled", true);
			
			var data = {};
			data.email = jQuery("#contact-email").val();
			data.name = jQuery("#contact-name").val();
			data.comments = jQuery("#contact-message").val();
			data.subject = jQuery("#contact-subject").val();
			data.action = "mail_action";
			
			jQuery.post(MyAjax.ajaxurl, data, onSuccess);
			
			return;
			
		}
		else {
			jQuery("#contact-form").validate().form();
			jQuery('.contact-form-error-message').show(150);
		}
		
	});
</script>
<!-- Form validation END -->