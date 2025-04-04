@extends($activeTemplate . 'layouts.frontend')
@section('style')
	<style>
		.scholarship-b {
			background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
			padding: 12px 30px;
			border-radius: 25px;
			font-weight: 400;
		}

		.hero-section {
			background-color: inherit;
			/* dark background */
			/* dark background */
			color: #fff;
			padding: 60px 0 30px 0;
			text-align: start;
		}

		/* Hide arrows in number input for Chrome, Safari, Edge, Opera */
		input[type="number"]::-webkit-inner-spin-button,
		input[type="number"]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		/* Hide arrows in number input for Firefox */
		input[type="number"] {
			-moz-appearance: textfield;
		}

		/* .hero-section h1 {
															font-size: 2.5rem;
															font-weight: bold;
														} */

		/* .hero-section p {
															font-size: 1.1rem;
															margin-bottom: 20px;
														} */


		/* .info-section {
															background-color: inherit;
															padding: 60px 20px;
															text-align: center;
														}

														.info-section h2 {
															font-size: 2rem;
															margin-bottom: 20px;
															height: 43px;
															border-radius: 10px 0px 0px 0px;
															opacity: 0px;

														} */

		.icon-box {
			font-size: 1.5rem;
			margin-bottom: 10px;
		}

		.info-cards .card {
			border: none;
			background: none;
			color: white;

		}

		.underline-green {
			position: relative;
		}

		.underline-green::after {
			content: "";
			position: absolute;
			left: 0;
			bottom: 0;
			width: 63px;
			height: 6px;
			background-color: #059088;
			border-radius: 10px;
		}

		/* .card {
															padding: 20px;
															border: 1px solid #ddd;
															border-radius: 8px;
															box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
															width: 57%;
															max-width: 60%;
															background-color: #fff;
															text-align: left;
															font-size: 34.02px;
															font-weight: 400;
															line-height: 47.97px;
															color: #fff
														}

														.icon-box {
															font-size: 2rem;
															margin-bottom: 10px;
															color: #17a2b8;

														}

														.info-cards {
															gap: 20px;
															margin-top: 40px;
														} */

		.body {
			position: relative;
			background-image: url('/assets/images/CeeYIT.png');
			background-size: cover;
			/* Makes the image cover the entire body */
			background-repeat: no-repeat;
			/* Prevents the image from repeating */
			background-position: center;
			/* Centers the image */
		}

		.overlay {
			position: absolute;
			width: screen;
			height: screen;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			z-index: 1;
			background-color: rgba(0, 0, 0, 0.65)
		}

		.main {
			position: relative;
			z-index: 2;
		}

		.main-header-title {
			display: flex;
			flex-direction: column;
			font-family: "Poppins", sans-serif;
			font-size: 45px;
			font-weight: 600;
			line-height: 60px;
			/* letter-spacing: -0.04em;
														   text-align: center; */
			text-underline-position: from-font;
			text-decoration-skip-ink: none;


		}

		.main-header-title .header-2 {
			color: #15BAB1
		}

		.main-header-title .content {
			font-family: "Poppins", sans-serif;
			font-size: 6.14px;
			font-weight: 400;
			line-height: 8.74px;
			text-align: center;
			margin-top: 9.76px;
		}

		.apply-btn-container {
			display: flex;
			justify-content: center;
			margin-top: 23px;
			column-gap: 11.46px;
		}

		.apply-btn {
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 20px;
			box-shadow: 0px 4px 15px 0px #03BDB359;
			background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
			width: 218px;
			border: 0px;
			color: #ffffff;
			/* padding-top:11px;
															padding-bottom:11px; */
			height: 43px;
			font-family: "Poppins", sans-serif;
			font-size: 15px;
			font-weight: 400;
			line-height: 21.36px;
			text-align: center;
			text-underline-position: from-font;
			text-decoration-skip-ink: none;

		}

		.apply-btn-transparent {
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 20px;
			box-shadow: 0px 4px 15px 0px #03BDB359;
			width: 218px;
			border: 0px;
			color: #ffffff;
			/* padding-top:11px;
															padding-bottom:11px; */
			height: 43px;
			font-family: "Poppins", sans-serif;
			font-size: 15px;
			font-weight: 400;
			line-height: 21.36px;
			text-align: center;
			text-underline-position: from-font;
			text-decoration-skip-ink: none;
			background-color: transparent;
			border: 1px solid #ffffff;
		}

		.info-section {
			/* padding-top: 19.3px; */
			text-align: center;
		}

		.info-section h2 {
			font-family: "Poppins", sans-serif;
			font-size: 32.48px;
			font-weight: 400;
			line-height: 50.5px;
			text-align: center;
			text-underline-position: from-font;
			text-decoration-skip-ink: none;
			margin-bottom: 23.93px;
		}

		.our-goal {
			font-family: "Poppins", sans-serif;
			font-size: 33.1px;
			font-weight: 600;
			line-height: 39.48px;
			text-align: center;
			text-underline-position: from-font;
			text-decoration-skip-ink: none;
			/* max-width: 77%; */
			margin: auto;
			padding-bottom: 30px;

		}

		.skill {
			font-family: "Poppins", sans-serif;
			font-size: 23.99px;
			font-weight: 400;
			line-height: 28.23px;
			/* text-align: center; */
			text-underline-position: from-font;
			text-decoration-skip-ink: none;
			padding-bottom: 30px;
		}

		.card-bottom-margin {
			margin-bottom: 38.32px;
		}

		.card-bottom-padding {
			padding-bottom: 123px;
		}

		.card-container-wrapper {
			display: flex;
			margin: auto;
			column-gap: 26.73px;
		}

		.card-icon-wrapper {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 63.18px;
			height: 48.6px;
			background-color: #059088;
			border: 0.97px solid #FFFFFF;
		}

		.card-info-content {
			font-family: "Poppins", sans-serif;
			font-size: 24.02px;
			font-weight: 400;
			line-height: 27.97px;
			text-align: left;
			text-underline-position: from-font;
			text-decoration-skip-ink: none;

		}

		/* .card {
															padding: 20px 0;
															border: 1px solid #ddd;
															border-radius: 8px;
															box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
															width: 57%;
															max-width: 60%;
															background-color: #fff;
															text-align: left;
															font-size: 24.02px;
															font-weight: 400;
															line-height: 37.97px;
															color: #fff
														}

														.icon-box {
															font-size: 2rem;
															margin-bottom: 10px;
															color: #17a2b8;

														}

														.info-cards {
															gap: 10px;
															margin-top: 20px;
														}

														.info-cards  p {
															font-family: "Poppins", sans-serif;
															font-size: 24.02px;
															font-weight: 400;
															line-height: 37.97px;
															text-align: left;
															text-underline-position: from-font;
															text-decoration-skip-ink: none;
														} */

		@media (min-width:576px) {
			.scholarship-b {
				background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
				padding: 12px 30px;
				border-radius: 25px;
				font-weight: 400;
			}

			.hero-section {
				background-color: inherit;
				/* dark background */
				/* dark background */
				color: #fff;
				padding: 72px 0;
				text-align: center;
			}

			.main-header-title {
				display: flex;
				flex-direction: column;
				align-items: center;
				font-family: "Poppins", sans-serif;
				font-size: 65px;
				font-weight: 700;
				line-height: 75px;
				letter-spacing: -0.04em;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;


			}

			.main-header-title .header-2 {
				color: #15BAB1
			}

			.main-header-title .content {
				font-family: "Poppins", sans-serif;
				font-size: 22.5px;
				font-weight: 400;
				line-height: 32.04px;
				text-align: center;
			}

			.apply-btn-container {
				display: flex;
				justify-content: center;
				margin-top: 64px;
				column-gap: 42px;
			}

			.apply-btn {
				display: flex;
				align-items: center;
				justify-content: center;
				border-radius: 20px;
				box-shadow: 0px 4px 15px 0px #03BDB359;
				background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
				width: 218px;
				border: 0px;
				color: #ffffff;
				/* padding-top:11px;
															padding-bottom:11px; */
				height: 43px;
				font-family: "Poppins", sans-serif;
				font-size: 15px;
				font-weight: 400;
				line-height: 21.36px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;

			}

			.apply-btn-transparent {
				display: flex;
				align-items: center;
				justify-content: center;
				border-radius: 20px;
				box-shadow: 0px 4px 15px 0px #03BDB359;
				width: 218px;
				border: 0px;
				color: #ffffff;
				/* padding-top:11px;
															padding-bottom:11px; */
				height: 43px;
				font-family: "Poppins", sans-serif;
				font-size: 15px;
				font-weight: 400;
				line-height: 21.36px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				background-color: transparent;
				border: 1px solid #ffffff;
			}

			.info-section {
				/* padding: 72px; */
				text-align: center;
			}

			.info-section h2 {
				font-family: "Poppins", sans-serif;
				font-size: 42.48px;
				font-weight: 400;
				line-height: 60.5px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				margin-bottom: 33.5px;
			}

			.our-goal {
				font-family: "Poppins", sans-serif;
				font-size: 43.1px;
				font-weight: 600;
				line-height: 49.48px;
				/* text-align: center; */
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				max-width: 100%;
				margin: auto;
				padding-bottom: 50px;

			}

			.skill {
				font-family: "Poppins", sans-serif;
				font-size: 33.99px;
				font-weight: 400;
				line-height: 38.23px;
				/* text-align: center; */
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				padding-bottom: 50px;
			}

			.card-bottom-margin {
				margin-bottom: 38.32px;
			}

			.card-bottom-padding {
				padding-bottom: 123px;
			}

			.card-container-wrapper {
				display: flex;
				margin: auto;
				column-gap: 26.73px;
			}

			.card-icon-wrapper {
				display: flex;
				justify-content: center;
				align-items: center;
				width: 63.18px;
				height: 48.6px;
				background-color: #059088;
				border: 0.97px solid #FFFFFF;
			}

			.card-info-content {
				font-family: "Poppins", sans-serif;
				font-size: 24.02px;
				font-weight: 400;
				line-height: 27.97px;
				text-align: left;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;

			}

			/* .card {
															padding: 20px;
															border: 1px solid #ddd;
															border-radius: 8px;
															box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
															width: 57%;
															max-width: 60%;
															background-color: #fff;
															text-align: left;
															font-size: 34.02px;
															font-weight: 400;
															line-height: 47.97px;
															color: #fff
														}

														.icon-box {
															font-size: 2rem;
															margin-bottom: 10px;
															color: #17a2b8;

														}

														.info-cards {
															gap: 20px;
															margin-top: 40px;
														}

														.info-cards  p {
															font-family: "Poppins", sans-serif;
															font-size: 34.02px;
															font-weight: 400;
															line-height: 47.97px;
															text-align: left;
															text-underline-position: from-font;
															text-decoration-skip-ink: none;
														} */


		}

		@media (min-width:768px) {
			.scholarship-b {
				background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
				padding: 12px 30px;
				border-radius: 25px;
				font-weight: 400;
			}

			.hero-section {
				background-color: inherit;
				/* dark background */
				/* dark background */
				color: #fff;
				padding: 123px 0;
				text-align: center;
			}

			.main-header-title {
				display: flex;
				flex-direction: column;
				align-items: center;
				font-family: "Poppins", sans-serif;
				font-size: 75px;
				font-weight: 700;
				line-height: 85px;
				letter-spacing: -0.04em !important;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;


			}

			.main-header-title .header-2 {
				color: #15BAB1
			}

			.main-header-title .content {
				font-family: "Poppins", sans-serif;
				font-size: 22.5px;
				font-weight: 400;
				line-height: 32.04px;
				text-align: center;
			}

			.apply-btn-container {
				display: flex;
				justify-content: center;
				margin-top: 64px;
				column-gap: 42px;
			}

			.apply-btn {
				display: flex;
				align-items: center;
				justify-content: center;
				border-radius: 20px;
				box-shadow: 0px 4px 15px 0px #03BDB359;
				background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
				width: 218px;
				border: 0px;
				color: #ffffff;
				/* padding-top:11px;
															padding-bottom:11px; */
				height: 43px;
				font-family: "Poppins", sans-serif;
				font-size: 15px;
				font-weight: 400;
				line-height: 21.36px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;

			}

			.apply-btn-transparent {
				display: flex;
				align-items: center;
				justify-content: center;
				border-radius: 20px;
				box-shadow: 0px 4px 15px 0px #03BDB359;
				width: 218px;
				border: 0px;
				color: #ffffff;
				/* padding-top:11px;
															padding-bottom:11px; */
				height: 43px;
				font-family: "Poppins", sans-serif;
				font-size: 15px;
				font-weight: 400;
				line-height: 21.36px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				background-color: transparent;
				border: 1px solid #ffffff;
			}

			.info-section {
				/* padding: 72px; */
				text-align: center;
			}

			.info-section h2 {
				font-family: "Poppins", sans-serif;
				font-size: 42.48px;
				font-weight: 400;
				line-height: 60.5px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				margin-bottom: 33.5px;
			}

			.our-goal {
				font-family: "Poppins", sans-serif;
				font-size: 53.1px;
				font-weight: 600;
				line-height: 59.48px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				max-width: 77%;
				margin: auto;
				padding-bottom: 60px;

			}

			.skill {
				font-family: "Poppins", sans-serif;
				font-size: 43.99px;
				font-weight: 400;
				line-height: 48.23px;
				text-align: center;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;
				padding-bottom: 50px;
			}

			.card-bottom-margin {
				margin-bottom: 58.32px;
			}

			.card-bottom-padding {
				padding-bottom: 123px;
			}

			.card-container-wrapper {
				display: flex;
				/* justify-content: center; */
				column-gap: 26.73px;
				max-width: 60%;
			}

			.card-icon-wrapper {
				display: flex;
				justify-content: center;
				align-items: center;
				width: 63.18px;
				height: 48.6px;
				background-color: #059088;
				border: 0.97px solid #FFFFFF;
			}

			.card-info-content {
				font-family: "Poppins", sans-serif;
				font-size: 34.02px;
				font-weight: 400;
				line-height: 47.97px;
				text-align: left;
				text-underline-position: from-font;
				text-decoration-skip-ink: none;

			}

			/* .card {
															padding: 20px;
															border: 1px solid #ddd;
															border-radius: 8px;
															box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
															width: 57%;
															max-width: 60%;
															background-color: #fff;
															text-align: left;
															font-size: 34.02px;
															font-weight: 400;
															line-height: 47.97px;
															color: #fff
														}

														.icon-box {
															font-size: 2rem;
															margin-bottom: 10px;
															color: #17a2b8;

														}

														.info-cards {
															gap: 20px;
															margin-top: 40px;
														}

														.info-cards  p {
															font-family: "Poppins", sans-serif;
															font-size: 34.02px;
															font-weight: 400;
															line-height: 47.97px;
															text-align: left;
															text-underline-position: from-font;
															text-decoration-skip-ink: none;
														} */


		}

		@media (min-width:992px) {}

		@media (min-width:1200px) {}

		@media (min-width:1400px) {}

		.donation-container {
			max-width: 500px;
			margin: 50px auto;
			background: white;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.donation-container h2 {
			text-align: center;
			color: #333;
			margin-bottom: 20px;
		}

		.donation-container label {
			font-weight: bold;
			color: #555;
		}

		.donation-container input,
		.donation-container select {
			width: 100%;
			padding: 10px;
			margin-top: 5px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		.donation-container button {
			width: 100%;
			background: #007bff;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			transition: background 0.3s;
		}

		.donation-container button:hover {
			background: #0056b3;
		}

		#card-element {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			background: #fff;
		}

		#card-errors {
			color: red;
			font-size: 14px;
			margin-top: 5px;
		}

		.error-border {
			border: 2px solid red !important;
		}

		.error-text {
			color: red;
			font-size: 14px;
			margin-top: 5px;
		}
	</style>
@endsection
@section('content')
	@php
		use App\Models\Gateway;
		$gateway = Gateway::automatic()->with('currencies')->where('alias', 'Stripe')->firstOrFail();
		$parameters = collect(json_decode($gateway->parameters));
		$publishableKey = $parameters->get('publishable_key')->value ?? env('STRIPE_KEY');
	@endphp
	<div class="body">
		<div class="main">
			<div class="container mx-auto p-4">
				<div class="donation-container">
					<h2>Donate Now</h2>
					<form id="donation-form" action="{{ route('donate.process') }}" method="POST">
						@csrf
						<div>
							<label for="name">Full Name *</label>
							<input type="text" id="name" name="name" required>
							<span class="error-text" id="name-error"></span>
						</div>
						<div class="mt-3">
							<label for="email">Email Address *</label>
							<input type="email" id="email" name="email" required>
							<span class="error-text" id="email-error"></span>
						</div>
						<div class="mt-3">
							<label for="phone">Phone Number</label>
							<input type="text" id="phone" name="phone" required>
							<span class="error-text" id="phone-error"></span>
						</div>
						<div class="mt-3 mb-3">
							<label for="amount">Donation Amount *</label>
							<input type="number" id="amount" name="amount" min="1" required>
							<span class="error-text" id="amount-error"></span>
						</div>
						
						<button type="submit" id="submit-button">Donate</button>
					</form>
				</div>

			</div>
		</div>
		<div class="overlay"></div>
	</div>
	
@endsection