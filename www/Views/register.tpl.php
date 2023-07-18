<!DOCTYPE html>
<html lang="en">

<head>

	<title>Ablepro bootstrap 5 admin template by Phoenixcoded</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<base href="http://localhost/admin/">
    <!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">

</head>

<!-- [ auth-signup ] start -->
<?php include "User/register.view.php"; ?>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/ripple.js"></script>
<script src="assets/js/pcoded.min.js"></script>

<!--  -->

<script>
    $(document).ready(function () {
        $('#formRegister').on('submit', function (e) {
            e.preventDefault();
            const email = $('#email').val()
            const password = $('#password').val()
            const re_password = $('#re_password').val()
            if(email.trim() == ''){
                alert('Please enter Email!')
            }
            if(password.trim() == ''){
                alert('Please enter Password!')
            }
            if(re_password.trim() == ''){
                alert('Please enter Re_Password!')
            }
            if(password.trim() != re_password.trim()){
                alert('Password is different Re_Password!')
            }
            // gửi ajax
            $.ajax({
                url: '/processregister',
                type: 'POST',
                data: {email, password},
                success: function (result) {
                    if(result == 'Register in successfully'){
                        alert('Register Successfully!')
                        window.location.href = '/login';
                    }else{
                        alert(result);
                    }
                }
            });
            return false;
        })
    })
</script>

</body>

</html>