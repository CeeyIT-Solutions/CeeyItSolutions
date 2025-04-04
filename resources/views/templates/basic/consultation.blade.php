@extends($activeTemplate.'layouts.frontend')
@section('style')
<style>
	body {
		font-family: 'AtypDisplay',  'Inter', sans-serif;
		background-color: #FAFAFA;
	}

	.service-card {
		min-height: 280px;
		border-radius: 24px;
		transition: transform 0.2s;
	}

	.service-card:hover {
		transform: scale(1.02);
	}

	.nav-link {
		color: #2B2A31 !important;
		/* width: 92px; */
		/* height: 11px; */
		line-height: 21.59px;
	}

	/* Navbar Styles */
	.navbar {
		padding: 1rem 2rem;
		background-color: white;
	}

	.nav-link {
		color: #333;
		font-size: 14px;
		font-weight: 500;
		padding: 0.5rem 1.5rem;
	}

	.navbar-nav {
		align-items: center;
	}

	.profile-button {
		background-color: #E6F7F5;
		/* color: red !important; */
		border-radius: 50px;
		padding: 0.5rem 1rem;
		border: none;
		white-space: nowrap;
	}

	.profile-image {
		width: 32px;
		height: 32px;
		border-radius: 50%;
		margin-right: 8px;
	}
    
	.hero-title {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 45px;
		font-weight: 600;
		line-height: 55px;
		letter-spacing: -0.04em;
		text-align: left;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;
		color: #2C2B31;
	}

	.hero-para {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 15px;
		font-weight: 400;
		line-height: 21.36px;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;
		color: #2C2B31;
		max-width: 100%;
	}

	.content-header {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 20px;
		font-weight: 400;
		line-height: 30px;
		text-align: center;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;

	}

	.content-para {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 21px;
		font-weight: 400;
		line-height: 21.36px;
		text-align: center;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;
		color: #302F35;
	}

	.appointment-header {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 40px;
		font-weight: 700;
		line-height: 50px;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;

	}

	.appointment-para {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 15.98px;
		font-weight: 400;
		line-height: 26.64px;
		text-align: center;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;
	}

	.contact-form label {
        font-family: "Nunito",sans-serif;
        font-weight: 700;
        font-size: 18px;
        line-height: 24.55px;
        color: #000000;
        margin-bottom: 8px;
    }

    .contact-form input::placeholder {
        font-family: "Nunito",sans-serif;
        font-weight: 500;
        font-size: 14px;
        line-height: 19.1px;
        color: #000000;
        opacity: 30%;
    }
     
    .contact-form .text-input {
      padding-top: 15.25px ;
      padding-bottom: 15.25px ;
      padding-left: 23px ;
    }

    .contact-form input , .contact-form select {
        border: 1px solid #0000001A;
        border-radius: 10px;
    }

    .contact-form .input-group-text {
        font-family: "Nunito",sans-serif;
        font-weight: 500;
        line-height: 14.21px;
        color: #000000;
        opacity: 30%;
        background-color: #E3E3E3;
    }

    .contact-form .form-check .form-check-input {
    background-color: #15BAB1;
    border-radius: 2px;
    width: 23px !important;
    height: 23px !important;
    border-color: #15BAB1;
    margin-right: 8px;
    }
    .contact-form .form-check .form-check-label {
        padding-top: 3px;
    }
    .contact-form .form-check .form-check-input:checked {
        background-color: #15BAB1;
        width: 23px;
        height: 23px;
    }
    .contact-form .form-check .form-check-input:checked:focus {
        border: none;
    }
        
    .contact-form .btn-login {
        background: linear-gradient(201.36deg, #00E8DB -15.01%, #095450 127.23%);
        color: #ffffff;
        font-family: "Nunito",sans-serif;
        font-weight: 700;
        font-size: 18px;
        line-height: 24.55px;
        padding-top:15.25px;
        padding-bottom:15.25px;
        border-radius: 59px;
        border: none;

    }

    .contact-form .btn-google {
        color:#000000;
        font-family: "Nunito",sans-serif;
        font-weight: 600;
        font-size: 18px;
        line-height: 24.55px;
        padding-top:15.25px;
        padding-bottom:15.25px;
        border-radius: 59px;
        border: 2px solid #0000001A;
        background-color:#ffffff;
        display: flex;
        align-items:center;
        justify-content:center;
    }

    .contact-form .bottom-text span {
        font-family: "Nunito",sans-serif;
        font-weight: 600;
        line-height: 12.92px;
        line-height: 17.63px;
        text-transform:capitalize;
        color:#0000004D;
    
    }
    .contact-form .bottom-text a {
        font-family: "Nunito",sans-serif;
        font-weight: 600;
        line-height: 12.92px;
        line-height: 17.63px;
        color: #15BAB1;
        text-transform:capitalize;
        text-decoration: none;
    }

	.btn-consultant {
		width: 152px;
		background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
		box-shadow: 0px 4px 15px 0px #03BDB359;
		color: #FFFFFF;
		border:none;
		border-radius:20px;
	}

	.btn-consultant:hover {
		color: #ffffff;
	}

	.assessment-container img{
     width:100%;
	 height:auto
	}

     @media (min-width:576px) {
	.hero-title {
		font-size: 75px;
		line-height: 85px;
		letter-spacing: -0.04em;
	}

	.hero-para {
		font-size: 15px;
		line-height: 21.36px;
	}

	.content-header {
		font-size: 40px;
		font-weight: 400;
		line-height: 50px;
	}

	.content-para {
		font-size: 15.98px;
		line-height: 26.64px;
	}

	.appointment-header {
		font-size: 40px;
		line-height: 50px;

	}

	.appointment-para {
		font-size: 15.98px;
		font-weight: 400;
		line-height: 26.64px;
	}
   
	.hero-para {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 15px;
		font-weight: 400;
		line-height: 21.36px;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;
		color: #2C2B31;
		max-width: 60%;
	}

	.content-header {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 40px;
		font-weight: 400;
		line-height: 50px;
		text-align: center;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;

	}

	.content-para {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 15.98px;
		font-weight: 400;
		line-height: 26.64px;
		text-align: center;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;
		color: #302F35;
	}

	.appointment-header {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 40px;
		font-weight: 700;
		line-height: 50px;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;

	}

	.appointment-para {
		font-family: 'AtypDisplay',sans-serif;
		font-size: 15.98px;
		font-weight: 400;
		line-height: 26.64px;
		text-align: center;
		text-underline-position: from-font;
		text-decoration-skip-ink: none;
	}

	.contact-form label {
        font-family: "Nunito",sans-serif;
        font-weight: 700;
        font-size: 18px;
        line-height: 24.55px;
        color: #000000;
        margin-bottom: 8px;
    }

    .contact-form input::placeholder {
        font-family: "Nunito",sans-serif;
        font-weight: 500;
        font-size: 14px;
        line-height: 19.1px;
        color: #000000;
        opacity: 30%;
    }
     
    .contact-form .text-input {
      padding-top: 15.25px ;
      padding-bottom: 15.25px ;
      padding-left: 23px ;
    }

    .contact-form input , .contact-form select {
        border: 1px solid #0000001A;
        border-radius: 10px;
    }

    .contact-form .input-group-text {
        font-family: "Nunito",sans-serif;
        font-weight: 500;
        line-height: 14.21px;
        color: #000000;
        opacity: 30%;
        background-color: #E3E3E3;
    }

    .contact-form .form-check .form-check-input {
    background-color: #15BAB1;
    border-radius: 2px;
    width: 23px !important;
    height: 23px !important;
    border-color: #15BAB1;
    margin-right: 8px;
    }
    .contact-form .form-check .form-check-label {
        padding-top: 3px;
    }
    .contact-form .form-check .form-check-input:checked {
        background-color: #15BAB1;
        width: 23px;
        height: 23px;
    }
    .contact-form .form-check .form-check-input:checked:focus {
        border: none;
    }
        
    .contact-form .btn-login {
        background: linear-gradient(201.36deg, #00E8DB -15.01%, #095450 127.23%);
        color: #ffffff;
        font-family: "Nunito",sans-serif;
        font-weight: 700;
        font-size: 18px;
        line-height: 24.55px;
        padding-top:15.25px;
        padding-bottom:15.25px;
        border-radius: 59px;
        border: none;

    }

    .contact-form .btn-google {
        color:#000000;
        font-family: "Nunito",sans-serif;
        font-weight: 600;
        font-size: 18px;
        line-height: 24.55px;
        padding-top:15.25px;
        padding-bottom:15.25px;
        border-radius: 59px;
        border: 2px solid #0000001A;
        background-color:#ffffff;
        display: flex;
        align-items:center;
        justify-content:center;
    }

    .contact-form .bottom-text span {
        font-family: "Nunito",sans-serif;
        font-weight: 600;
        line-height: 12.92px;
        line-height: 17.63px;
        text-transform:capitalize;
        color:#0000004D;
    
    }
    .contact-form .bottom-text a {
        font-family: "Nunito",sans-serif;
        font-weight: 600;
        line-height: 12.92px;
        line-height: 17.63px;
        color: #15BAB1;
        text-transform:capitalize;
        text-decoration: none;
    }

	.btn-consultant {
		width: 152px;
		background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
		box-shadow: 0px 4px 15px 0px #03BDB359;
		color: #FFFFFF;
		border:none;
		border-radius:20px;
	}

	.btn-consultant:hover {
		color: #ffffff;
	}
} 
	/* Mobile navbar styles */
	@media (min-width: 991px) {
		.navbar-collapse {
			background-color: white;
			padding: 1rem;
			border-radius: 8px;
			margin-top: 1rem;
		}

		.nav-link {
			padding: 0.75rem 1rem;
		}

		.profile-button {
			/* margin-top: 1rem; */
			width: 126px;
			height: 43px;
			border: 1.37 solid #0000000D;
			border-radius: 162px;
			justify-content: center;
			/* display: flex; */
			align-items: center;
			background-color: #DDFFFD;
			color: #2C2A31;
		}
	}

	span {
		color: #15bab1 !important;
	}

	p.lead {
		color: #2C2B31;
		font-size: 15px;
		font-weight: 400px;
		width: 548px;
		height: 32px;
	}

	p.text-center {
		font-size: 17px;
		font-weight: 400;
		color: #302F35;
		opacity: 80%;
	}

	p.text-muted {
		opacity: 70%;
		font-size: 12px;
		font-weight: 400;
		line-height: 18px;
		color: #302F35;
	}

	button.hsb {
		background: linear-gradient(180deg, #00E8DB 0%, #095450 100%);
		border: none;
		font-size: 15px;
		color: #FFFFFF;
	}

	hr {
		height: 4px;
		background-color: #FFFFFF;
		border-radius: 13.54px;
		opacity: 40%;
	}

	.process-section {
		border-radius: 19px;
		background: linear-gradient(180deg, #201E27 0%, #4B4B4B 100%);
	}

	button.profile-span {
		width: 64px;
		height: 18px;
		font-size: 13px;
		size: 6.39px;
		color: red !important;
		text-wrap: no-wrap;
	}

	.student-label {
		font-size: 12px;
		color: #DDFFFD;
	}

	

</style>
@endsection
@section('content')
@php
$banner = getContent('banner.content',true)->data_values;
@endphp
<!-- <section class="hero bg_img" style="background-image: url('{{getImage('assets/images/frontend/img/consultant.png','1920x640')}}')">
	<div class="container">
	  <div class="row align-items-center justify-content-xl-start justify-content-center" >
			<div class="col-xl-5 col-lg-6 text-xl-start text-center">
				<h2  class="hero__title text-white"><em>EXPERT CAREER GUIDANCE</em></h2>
				<p class="hero__description text-white mt-3">Every Consultation is unique and tailored to <br>suit the learning or career need of every <br>individual.</p>
				<div class="join_us row">
					 <a href="{{route('user.register')}}"  class="btn btn-sm btn-outline--base d-flex align-items-center mt-sm-0 mt-2">
            
              <p style="padding: 5px;font-size:15px">@lang('Contact Us')</p></a>
					 </div>
				{{-- <form class="hero-search-form mt-xl-5 mt-4" action="{{route('courses')}}" method="GET">
				<i class="las la-search"></i>
				<input type="text" name="search" autocomplete="on" class="form--control" placeholder="@lang('title, tags eg. web design, art, skill development')...">
				<button type="submit" class="hero-search-form__btn">@lang('Search')</button>
				</form> --}}
			</div>
	  </div>
	</div>
  </section>
<br><br>
  <section class="first-section">
    <div class="container">
		<div class="row gy-4">
			 <h6 class="title-head text-center">Personalized Consultation Service.</h6>
			  <p class="title-desc text-center">Our Consultation services ensure that you get the best from your learning journey. <br>We also offer after learning support, till you have secured a <br>job and can stand on your feet.</p>
		  
		</div>
		<br>
		<center>
		  <div class="row gy-4 justify-content-center">
			
				<div class="col-lg-4 col-md-4 col-sm-6">
					
						<div  class="icon_bg" style="background-image: url('assets/images/frontend/img/file.svg'); background-repeat: no-repeat;background-position: center center;">
						
					</div>
					<div class="box-first">
						<br>
						<p class="in_box_text_head">Skills Assessment & Guidance
						</p>					
						<p class="in_box_text_desc">Personalized session that assesses individual skills and help learners to select courses according to their interests and strengths.</p>
					</div>
					
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					
						<div  class="icon_bg"  style="background-color:#00CBB8;background-image: url('assets/images/frontend/img/cal.svg'); background-repeat: no-repeat;background-position: center center;">
						
					</div>
					<div class="box-first">
						<br>
						<p class="in_box_text_head">Career Support
						</p>					
						<p class="in_box_text_desc">Offer resources and guidance to help learners prepare and ace job interviews, resume and portfolio review.</p>
					</div>
					
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					
						<div  class="icon_bg" style="background-color:#29B9E7;background-image: url('assets/images/frontend/img/last.svg'); background-repeat: no-repeat;background-position: center center;">
						
					</div>
					<div class="box-first">
						<br>
						<p class="in_box_text_head">Mentorship & Networking 
						</p>					
						<p class="in_box_text_desc">Connect learners to networking opportunities and access to professionals who can offer advice, guidance and real-word insights. </p>
					</div>
					
				</div>
				
			</div>

			 <div class="row gy-4 justify-content-center">
			
				<div class="col-lg-4 col-md-4 col-sm-6">
					
						<div  class="icon_bg" style="background-image: url('assets/images/frontend/img/roadmap.svg'); background-repeat: no-repeat;background-position: center center;">
						
					</div>
					<div class="box-first">
						<br>
						<p class="in_box_text_head">Learning Roadmap Development
						</p>					
						<p class="in_box_text_desc">Knowing what to learn is not enough, we also provide a customised learning path to ensure learning is faster and easier.</p>
					</div>
					
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					
						<div  class="icon_bg"  style="background-color:#00CBB8;background-image: url('assets/images/frontend/img/cal.svg'); background-repeat: no-repeat;background-position: center center;">
						
					</div>
					<div class="box-first">
						<br>
						<p class="in_box_text_head">Career Path Exploration
						</p>					
						<p class="in_box_text_desc">With a team of career advisors, we offer insight and guidance to help learners select the right Tech specialization.</p>
					</div>
					
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					
						<div  class="icon_bg" style="background-color:#29B9E7;background-image: url('assets/images/frontend/img/industry.svg'); background-repeat: no-repeat;background-position: center center;">
						
					</div>
					<div class="box-first">
						<br>
						<p class="in_box_text_head">Industry Trends & Insight 
						</p>					
						<p class="in_box_text_desc">We keep our students updated on emerging technologies, in-demand skills and areas of growth within the Tech ecosystem. </p>
					</div>
					
				</div>
				
			</div>
			
			</center>

	</div>

  </section>

  <section class="first-section">
    <div class="container">
		<div class="row gy-4">
			 <h6 class="title-head text-center">Our Process</h6>
		  
			<center>
				<p class="title-desc text-center" style="width: 80%" >Our consultation process  seeks to identify the specific needs of  individuals, 
understand their fears or challenges and create a personalised solution.</p>
		  
			</center>
		</div>
		<br>
		

    <div class="container">
		<div class="row gy-4 p-3">
			<div class="col-xl-5 col-lg-5 text-xl-start " >
				  <br> <br>  <br> <br>
				 <h6 class="title-head" style="color:#2F327D;margin-top:30px">RESUME <br>OPTIMIZATION</h6>
		  <br>
				<p class="title-desc " style="width: 80%;font-size:16px" >Due to the competitiveness of the job market, we train on how to craft a Resume that stands out, which increases chances of being called for interviews. They are also equipped with resources on how to ace interviews.</p>
		  <br>

		  
			</div>
			<div class="col-xl-2 col-lg-2 text-xl-start " ></div>
		
		<div class="col-xl-5 col-lg-5 text-xl-start " >
			<img src="assets/images/frontend/img/resume.png" style="width: 100%" />
		</div>
		</div>
	
		<div class="row gy-4 mt-3">
			<div class="col-xl-7 col-lg-7 text-xl-start " >
			<img src="assets/images/frontend/img/accessment.png" style="width: 100%"  />
		</div>
		<div class="col-xl-1 col-lg-1 text-xl-start " ></div>
			<div class="col-xl-4 col-lg-4 text-xl-start " >
				<br><br>
				 <h6 class="title-head" style="color:#2F327D;margin-top:30px">ASSESSMENT</h6>
		  <br>
		<div style="display: flex">
			  <img src="assets/images/frontend/img/item_1.svg"   />
				<p class="title-desc " style="font-size:16px" >Each individual is evaluated to determine their current knowledge, identify strengths, weaknesses and potentials.</p>
		</div>
		<br>
		<div style="display: flex">
			  <img src="assets/images/frontend/img/item_2.svg"   />
				<p class="title-desc " style="font-size:16px" >A learning plan is created based on skills and desired outcomes.</p>
		</div>
		<div style="display: flex; margin-left:30px">
			  <img src="assets/images/frontend/img/item_3.svg" style="width: 30px;margin-right:20px"   />
				<p class="title-desc " style="font-size:16px" >Progress is tracked regularly to celebrate milestones, identify areas of improvement and generally motivate learners.</p>
		</div>
	
			</div>
			
		
		
		</div>

	<br><br>
		<div class="row gy-4 mt-3 p-3" >
			
			<div class="col-xl-4 col-lg-4 text-xl-start " >
				
				 <h6 class="title-head" style="color:#F48C06;margin-top:30px"> INTERVIEW</h6>
		  <br>
				<p class="title-desc " style="font-size:14px" >Upon successful completion of assessments, individuals are scheduled for interviews with our job partners, in a bid to ensure that they get jobs after their training.</p>
		 
			</div>
			<div class="col-xl-3 col-lg-3 text-xl-start " ></div>
			<div class="col-xl-5 col-lg-5 text-xl-start " >
			<img src="assets/images/frontend/img/interview.png" style="width: 100%"  />
		</div>
			
		
		
		</div>
	</section>
	
		


<section class="first-section">
    <div class="container">
		
		
		<div class="row gy-4">
			 <h6 class="title-head text-center">Why We Are The Preferred Option </h6>
		  
			
		</div>
		
		<div class="row gy-4 mt-3">
			<div class="col-xl-7 col-lg-7 text-xl-start " >
			<img src="assets/images/frontend/img/whyus.png" style="width: 100%"  />
		</div>
		<div class="col-xl-1 col-lg-1 text-xl-start " ></div>
			<div class="col-xl-4 col-lg-4 text-xl-start " >
				<br><br><br>
				
		<div style="display: flex">
			  <img src="assets/images/frontend/img/item_1.svg"   />
				<p class="title-desc " style="font-size:16px" >Interactive learning structure which keeps individuals motivated to finish their courses in record time.</p>
		</div>
		<br>
		<div style="display: flex">
			  <img src="assets/images/frontend/img/item_2.svg"   />
				<p class="title-desc " style="font-size:16px" >A consultation session that is personalized and tailored to individual learning needs and desired outcome.</p>
		</div>
		<br>
		<div style="display: flex; margin-left:30px">
			  <img src="assets/images/frontend/img/item_3.svg" style="width: 30px;margin-right:20px"   />
				<p class="title-desc " style="font-size:16px" >The assurance of securing a job after completing the training session.  </p>
		</div>
		
			</div>
		
		
		
		</div>

		<br><br>
		
		<br><br>
		
		
	</div>

  </section>

<br>

    @if($sections->secs != null)
        {{-- @foreach(json_decode($sections->secs) as $sec)
		{{dd($sec)}} --}}
            @include($activeTemplate.'sections.testimonial')
        {{-- @endforeach --}}
    @endif

	<br>
	<section class="first-section">
    <div class="container">
	 <div class="contact-first">
        <div class="row gy-5">
         
          <div class="col-lg-12 ps-lg-4">
            <h3 class="mb-3">@lang('Let\'s talk')</h3>
            <form method="post" action="">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>@lang('Name')</label>
                    <input name="name" type="text" placeholder="@lang('Your Name')" class="form--control" value="{{ old('name') }}" required>
                  </div>
                </div>
                {{-- <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('Email')</label>
                    <input name="email" type="text" placeholder="@lang('Enter E-Mail Address')" class="form--control" value="{{old('email')}}" required>
                  </div>
                </div> --}}
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>@lang('Subject')</label>
                    <input name="subject" type="text" placeholder="@lang('Write your subject')" class="form--control" value="{{old('subject')}}" required>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>@lang('Your Message')</label>
                    <textarea name="message" wrap="off" placeholder="@lang('Write your message')" class="form--control">{{old('message')}}</textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <center>
					<button type="submit" class="btn btn--base" >@lang('Submit')</button>
				  </center>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
		<br><br><br><br>
	</div>
	</section> -->

<!-- Hero Section -->
<section class="container mb-5">
	<div class="row align-items-center">
		<div class="col-lg-6">
			<h1 class="display-4 fw-bold mb-3 hero-title">
				Expert <span class="">Career</span> <br />
				Guidance in <span class="">Tech</span>
			</h1>
			<p class="lead mb-5 hero-para">
				Every Consultation is unique and tailored to suit the learning or career need of every individual.
			</p>
			<a href="{{route('user.register')}}">
				<button class="btn btn-consultant">Book Now</button></a>
		</div>
		<div class="col-lg-6">
			<img src="assets/images/3d-rendering-cartoon-like-woman-working-computer 1.png" alt="Career Guidance" class="img-fluid" style="float: right;">
		</div>
	</div>
</section>

<!-- Consultation Services -->
<section class="container mb-5">
	<h2 class="text-center mb-2 content-header ">Personalized Consultation Services</h2>
	<p class="text-center mb-4 content-para">
		Our Consultation services ensure that you get the best from your learning journey.
		We also offer after learning support, till you have secured a job and can stand on your feet.
	</p>

	<div class="row g-4">
		<!-- Repeat this card structure for each service -->
		<div class="col-md-4">
			<div class="card service-card border-0 p-4 d-flex" style="background-color: #8B5CF6;">
				<div class="mt-auto">
					<div class="mb-2">
						<img src="assets/images/skills_vector.png" alt="" style="width: 32px; height: 40px;">
					</div>
					<h5 class="text-white fw-bold mb-3">Skills Assessment & Guidance</h5>
					<hr class="bg-white opacity-25 my-3">
					<p class="text-white opacity-75 small mb-0">
						Personalized session that assesses individual skills and help learners to select courses
						according to their interests and strengths.
					</p>
				</div>
			</div>
		</div>
		<!-- Repeat for other services -->

		<div class="col-md-4">
			<div class="card service-card border-0 p-4 d-flex" style="background-color: #FDA53D;">
				<div class="mt-auto">
					<div class="mb-2">
						<img src="assets/images/career_vector.png" alt="" style="width: 49px; height: 40px;">
					</div>
					<h5 class="text-white fw-bold mb-3">Skills Assessment & Guidance</h5>
					<hr class="bg-white opacity-25 my-3">
					<p class="text-white opacity-75 small mb-0">
						Offer resources and guidance to help learners prepare and ace job interviews, resume and portfolio review.
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card service-card border-0 p-4 d-flex" style="background-color: #51ccec;">
				<div class="mt-auto">
					<div class="mb-2">
						<img src="assets/images/mentorship_vector.png" alt="" style="width: 57px; height: 40px;">
					</div>
					<h5 class="text-white fw-bold mb-3">Skills Assessment & Guidance</h5>
					<hr class="bg-white opacity-25 my-3">
					<p class="text-white opacity-75 small mb-0">
						Connect learners to networking opportunities and access to professionals
						who can offer advice, guidance and real-word insights.
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card service-card border-0 p-4 d-flex" style="background-color: #FDA53D;">
				<div class="mt-auto">
					<div class="mb-2">
						<img src="assets/images/roadmap_vector.png" alt="" style="width: 40px; height: 40px;">
					</div>
					<h5 class="text-white fw-bold mb-3">Skills Assessment & Guidance</h5>
					<hr class="bg-white opacity-25 my-3">
					<p class="text-white opacity-75 small mb-0">
						Knowing what to learn is not enough, we also provide a customised learning
						path to ensure learning is faster and easier.
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card service-card border-0 p-4 d-flex" style="background-color: #51ccec;">
				<div class="mt-auto">
					<div class="mb-2">
						<img src="assets/images/path_vector.png" alt="" style="width: 40px; height: 40px;">
					</div>
					<h5 class="text-white fw-bold mb-3">Skills Assessment & Guidance</h5>
					<hr class="bg-white opacity-25 my-3">
					<p class="text-white opacity-75 small mb-0">
						With a team of career advisors, we offer insight and guidance to help learners
						select the right Tech specialization.
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card service-card border-0 p-4 d-flex" style="background-color: #8B5CF6;">
				<div class="mt-auto">
					<div class="mb-2">
						<img src="assets/images/industry_vector.png" alt="" style="width: 40px; height: 40px;">
					</div>
					<h5 class="text-white fw-bold mb-3">Skills Assessment & Guidance</h5>
					<hr class="bg-white opacity-25 my-3">
					<p class="text-white opacity-75 small mb-0">
						We keep our students updated on emerging technologies,
						n-demand skills and areas of growth within the Tech ecosystem.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Process Section -->
<section class="container mb-5">
	<h2 class="text-center mb-2 content-header">Our Process</h2>
	<p class="text-center content-para">Our consultation process seeks to identify the specific needs of individuals,
		understand their fears or challenges and create a personalized solution.</p>
	<div class="row process-section mx-auto">
		<!-- Repeat this card structure for each process step -->
		<div class="col-md-4 mb-2 mt-2">
			<div class="card border-1 h-100 p-4 assessment">
				<img src="assets/images/res_optimization.png" alt="" class="mb-3">
				<h5 class="fw-bold mb-3">Resume Optimization</h5>
				<p class="text-muted small mb-0">
					Due to the competitiveness of the job market, we train on how to craft a resume that stands out,
					which increases chances of being called for interviews. They are also equipped with resources on how
					to ace interviews.
				</p>
			</div>
		</div>
		<!-- Repeat for other process steps -->

		<div class="col-md-4 mb-2 mt-2">
			<div class="card border-1 h-100 p-4 assessment-container">
				<img src="assets/images/assessment.png" alt="" class="mb-3">
				<h5 class="fw-bold mb-3">Assessment</h5>
				<p class="text-muted small mb-0">
					Each individual is evaluated to determine their current knowledge, identify strengths,
					weaknesses and potentials. Progress is tracked regularly to celebrate milestones,
					identify areas of improvement and generally motivate learners.
				</p>
			</div>
		</div>

		<div class="col-md-4 mb-2 mt-2">
			<div class="card border-1 h-100 p-4">
				<img src="assets/images/Interview.png" alt="" class="mb-3">
				<h5 class="fw-bold mb-3">Interview</h5>
				<p class="text-muted small mb-0">
					Upon successful completion of assessments, individuals are scheduled for interviews with our job partners,
					in a bid to ensure that they get jobs after their training.
				</p>
			</div>
		</div>
	</div>
</section>

<!-- let's Talk section -->
<section class="container mb-5 py-5 my-5">
	<div>
		<h3 class="text-center appointment-header">Let's <span style="color: #15BAB1;">Talk</span></h3>
		<p class="text-center appointment-para">Book an appointment with any of our consultants today!</p>
	</div>

	<form class="contact-form">
	<div class="mb-3">
		<label for="Name" class="form-label mb-0">Name</label>
		<input type="text" class="form-control text-input" id="username" placeholder="Name">
	</div>

	<div class="mb-4">
		<label for="subject" class="form-label mb-0">Subject</label>
		<input type="text" class="form-control text-input" id="username" placeholder="Write your subject">
	</div>

	<div class="mb-2">
		<label for="message" class="form-label mb-0">Your messge</label>
		<textarea class="form-control text-input" id="message" rows="5" placeholder="Write your message"></textarea>
	</div>

	<div class="d-flex justify-content-end">
	 <button class="btn btn-consultant">Submit</button>
	</div>
	</form>
</section>

@endsection