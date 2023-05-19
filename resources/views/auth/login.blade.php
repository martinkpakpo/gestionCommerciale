<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
        @include('layouts.css')
	</head>
	
	<body class="animated fadeInDown">

		<header id="header">

			<div id="logo-group">
                <span id="logo"> <img src="{{ asset('HTML_version/img/logo-o.png') }}" style="width: 20%" alt="SmartAdmin"> MyErp</span>
			</div>

			<span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Need an account?</span> <a href="register.html" class="btn btn-danger">Create account</a> </span>

		</header>

		<div id="main" role="main">


			<!-- MAIN CONTENT -->
			<div id="content" class="container">
                <div class="row" id="loadingMessage">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"><div class="well well-sm well-light text-center" ><i class="fa fa-spin fa-refresh"></i>&nbsp; Chargement en cours</div></div>
                    <div class="col-sm-4"></div>
                </div>
				<div class="row" style="display: none;" id="pagecorp">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-red login-header-big">MyErp</h1>
						<div class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header">It's Okay to be Smart. Experience the simplicity of SmartAdmin, everywhere you go!</h4>
								<div class="login-app-icons">
									<a href="javascript:void(0);" class="btn btn-danger btn-sm">Frontend Template</a>
									<a href="javascript:void(0);" class="btn btn-danger btn-sm">Find out more</a>
								</div>
							</div>
							
							<img src="{{ asset('HTML_version/img/demo/iphoneview.png') }}" class="pull-right display-image" alt="" style="width:210px">

						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h5 class="about-heading">About SmartAdmin - Are you up to date?</h5>
								<p>
									Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.
								</p>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h5 class="about-heading">Not just your average template!</h5>
								<p>
									Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi voluptatem accusantium!
								</p>
							</div>
						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
                                <form method="POST" action="{{ route('login') }}" id="login-form" class="smart-form client-form">
                                    @csrf
								<header>
									Sign In
								</header>

								<fieldset>
									
									<section>
										<label class="label">Nom d'utilisateur</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" id="email" name="email" value="{{ old('email') }}">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Entrez votre nom d'utilisateur</b></label>
									</section>

									<section>
										<label class="label">Mon de passe</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" id="password" name="password" value="{{ old('password') }}">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Entrez votre mot de passe</b> </label>
										<div class="note">
											<a href="forgotpassword.html">Mot de passe oublié ?</a>
										</div>
									</section>

									<section>
										<label class="checkbox">
											<input type="checkbox" name="remember" checked="">
											<i></i>Stay signed in</label>
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										Valider
									</button>
								</footer>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
        @include('layouts.js')
        <script type="text/javascript">
			runAllForms();
			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						email : {
							required : true
    						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : "Le champ nom d'utilisateur est vide"
						},
						password : {
							required : "Le champ mot de passe est vide"
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

	</body>
</html>