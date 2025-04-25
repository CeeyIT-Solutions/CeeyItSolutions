@extends($activeTemplate.'layouts.frontend')
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
</style>
@endsection
@section('content')

<div class="body">
    <div class="main">
        <div class="container mx-auto">
            <div class="hero-section">
                <h1 class="main-header-title">
                    Help Build Talents with<span class="header-2">CeeY-Solutions Foundation</span></h1>
                <p class="content">We're in the business of building world-class tech talents and we are in <br> need of
                    your help to impact more lives.</p>
                <div class="apply-btn-container">
                    <a href="{{route('scholarships')}}" class="btn apply-btn">Apply for scholarships <img
                            class="d-none d-sm-block ms-1" src="assets/images/arrow_up.svg" alt=""></a>
                    <a href="{{route('donation')}}" class="btn apply-btn-transparent">Sponsor a talent</a>
                </div>
            </div>

            <div class="info-section text-white">
                <h2 class="">Who Are <span class="underline-green">We</span>?</h2>
                <p class="our-goal">Our Goal to help more people have access to learning tech skills.</p>
                <p class="skill">
                    Shortage of skilled tech professionals is a global problem. <br> We are training people in tech and
                    outsourcing them to <br> tech companies. We use your donations to:
                </p>

                <div class="card-bottom-margin">
                    <div class="card-container-wrapper">
                        <div class="card-icon-wrapper">
                            <img src="assets/images/sponsor_vector_1.svg" alt="">
                        </div>
                        <div>
                            <p class="card-info-content">Sponsor scholarships to enroll in any course.</p>
                        </div>
                    </div>
                </div>
                <div class="card-bottom-margin">
                    <div class="card-container-wrapper">
                        <div class="card-icon-wrapper">
                            <img src="assets/images/purchase_vector_1.svg" width="" alt="">
                        </div>
                        <div>
                            <p class="card-info-content">Purchase laptops for those in need.</p>
                        </div>
                    </div>
                </div>
                <div class="card-bottom-padding">
                    <div class="card-container-wrapper">
                        <div class="card-icon-wrapper">
                            <img src="assets/images/students_vector_1.svg" alt="">
                        </div>
                        <div>
                            <p class="card-info-content">Support students in any way necessary.</p>
                        </div>
                    </div>
                    <div class="apply-btn-container">
                        <a href="{{route('laptops')}}" class="btn apply-btn">Apply for Laptop <img
                                class="d-none d-sm-block ms-1" src="assets/images/arrow_up.svg" alt=""></a>
                    </div>
                </div>
                {{--<div class="row info-cards justify-content-center">
				<div class="col-12 col-md-6 col-lg-12 mb-4 d-flex justify-content-center">
					<div class="card text-start">
						<p><img src="assets/images/Frame 169.png" width="40px" alt=""> Sponsor scholarships to enroll in any course.</p>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-12 mb-4 d-flex justify-content-center">
					<div class="card text-start">
						<p><img src="assets/images/Frame 170.png" width="40px" alt=""> Purchase laptops for those in need.</p>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-12 mb-4 d-flex justify-content-center">
					<div class="card text-start">
						<p><img src="assets/images/Frame 168.png" width="40px" alt=""> Support students in any way necessary.</p>
					</div>
				</div>
			</div>--}}

            </div>
        </div>
    </div>
    <div class="overlay"></div>
</div>

@endsection