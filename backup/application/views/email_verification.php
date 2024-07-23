<section class="py-5 my-3">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-5">
				<div class="logForm p-lg-5">
					<h3 class="h3 font-weight-bold text-dark text-center">Authenticate Your Account</h3>
					<p class="text-center text-dark mb-3">Enter the Authenticate code that was sent to your email</p>
                    <div class="text-center emailicon mb-3">
                        <img src="<?php base_url(); ?>assets/images/email-img.png">
                    </div>
					<div class="otp-container mb-1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				    </div>
				    <div class="text-center mb-3"><a href="#" class="text-primary font-weight-bold">Resend Code</a></div>
				    <button type="submit" class="btn logbtn w-100 float-none">Let’s Go</button>
				</div>
			</div>
		</div>
		
	</div>
</section>

<script>
    const inputs = document.querySelectorAll('.otp-input');
    
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
    });
</script>