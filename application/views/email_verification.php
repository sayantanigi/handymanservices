<style>
    .otp-container {
        display: flex;
        gap: 10px;
    }
    .otp-input {
        width: 40px;
        height: 40px;
        font-size: 18px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #F5F5F5;
    }
    .resend-link {
        display: block;
        text-align: center;
        margin-top: 10px;
        color: #007BFF;
        cursor: pointer;
    }
</style>

<section class="py-5 my-3">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-lg-5">
				<div class="logForm">
					<h3 class="h3 font-weight-bold text-dark text-center">Authenticate Your Account</h3>
					<p class="text-center text-dark">Enter the Authenticate code that was sent to your email</p>
					<div class="otp-container">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				        <input type="text" class="otp-input" maxlength="1">
				    </div>
				    <a href="#" class="resend-link">Resend Code</a>
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