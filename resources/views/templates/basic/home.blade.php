@extends($activeTemplate . 'layouts.frontend')

<head>
    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="{{asset('assets/global/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/owl.theme.default.min.css')}}">
    <!-- OWL CAROUSEL -->
</head>
@section('style')
    <style>
        @font-face {
            font-family: 'Atyp text';
            src: url("public/assets/font/AtypText-Medium.woff") format("woff");
            font-weight: 500;
            font-style: normal;
        }

        body {
            /* font-family: 'AtypDisplay',  'Inter', sans-serif; */
        }

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


        .hero-section {
            padding-top: 1rem;
        }

        .hero-title {
            display: flex;
            flex-direction: column;
        }

        .hero-image-container {
            display: flex;
            justify-content: flex-end;
        }

        .hero-content {
            padding-right: 3rem;
        }

        .accent-text {
            color: #00BFA5;
        }

        .section-header {
            text-align: center;
            /* margin-bottom: 3rem; */
        }



        .section-title {
            /* font-family: 'AtypDisplay',sans-serif;
            font-size: 2.5rem;
            font-weight: 600;
            line-height:50px;
            margin-bottom: 28px;
            text-align: center;
            color:#2C2B32; */
            font-family: 'AtypDisplay', sans-serif;
            font-size: 18px;
            font-weight: 600;
            /* line-height: 50px; */
            text-underline-position: from-font;
            text-decoration-skip-ink: none;

        }

        .section-subtitle {
            /* font-family: 'AtypDisplay',sans-serif;
            color: #302F35;
            font-size:15.98px;
            line-height:26.64px;
            font-weight:400;
            text-align: center;
            margin: auto;
            max-width: 476px;
            margin-bottom: 2.9rem; */
            font-family: 'AtypDisplay', sans-serif;
            font-size: 8px;
            font-weight: 400;
            line-height: 26.64px;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;

        }


        .who-card {
            background: linear-gradient(103.12deg, #201E27 7.94%, #4B4B4B 114.59%);
            /* border-radius: 19.33px; */
            border-radius: 11.52px;
            width: 100%;
            /* max-height: 278px; */
            height: 100%;
            /* border-radius:19.33px; */
            padding-left: 15.56px;

        }

        .who-card .content {
            color: white;
        }

        .content-left {
            /* padding: 1rem 1rem 0rem 1rem; */
        }

        .content-right {
            /* padding: 1rem 1rem 0rem 1rem; */
        }

        .who-card img {
            padding: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-right-radius: 19.33px;
            border-bottom-right-radius: 19.33px;
        }

        .feature-card {
            background-color: #1E293B;
            border-radius: 16px;
            padding: 2rem;
            color: white;
            height: 100%;
            text-align: center;
            margin-bottom: 2rem;
        }

        .feature-card img {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
        }

        .testimonial-carousel {
            padding: 2rem 0;
        }

        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin: 0 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .carousel-indicators {
            position: relative;
            margin-top: 2rem;
        }

        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .carousel-indicators [data-bs-target] {
            width: 50px;
            height: 4px;
            background-color: #ccc;
            border: none;
            border-radius: 2px;
            margin: 0 4px;
        }

        .carousel-indicators .active {
            background-color: #00BFA5;
        }

        /* span,
        .accent-text {
            width: 580px;
            height: 137;
            font-size: 75px;
            letter-spacing: -0.04em;
            font-weight: bolder;
            line-height: 85px;
        } */

        .fin-aid-outline {
            width: 152px;
            height: 43px;
            border: 1px solid #15BAB1;
            border-radius: 20px;
        }

        hr {
            margin-top: 3rem;
            border: none;
            width: 236px;
            height: 5px;
            background-color: white;
            border-radius: 10px;
            /* opacity: 20%; */
        }

        .courses-gradient {
            width: 294px;
            height: 258px;
            border-radius: 40px;
        }

        .python-gradient {
            background: linear-gradient(180deg, #FB729F 10%, #F55989 100%);
        }

        .Data-Analysis-Gradient {
            background: linear-gradient(180deg, #A08CFD 10%, #917AFC 100%);
        }

        .carousel-item img {
            margin: 0 auto;
            /* Centers horizontally */
            display: block;
            /* Ensures proper block-level centering */
        }

        .card {
            height: 100%;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            padding: 1rem;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .card-title {
            /* font-size: 1.2rem;
            font-weight: bold;
            margin-top: 0.5rem;
            text-align: start; */
        }

        .card {
            width: 294px;
            height: 258px;
            border-radius: 40px;
        }

        /* .hero-section {
            padding: 80px 0;
        } */

        .hero-title {
            /* font-family:"Atyp text",sans-serif;
            font-size: 60px;
            font-weight: 400;
            line-height: 1.2;
            margin-bottom: 20px;
            letter-spacing: -0.04em;
            color:#2C2B31; */
            font-family: 'AtypDisplay', sans-serif;
            font-size: 39.96px;
            font-weight: 400;
            line-height: 45.28px;
            letter-spacing: -0.04em;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
        }

        .hero-title .highlight {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 39.96px;
            font-weight: 400;
            line-height: 45.28px;
            letter-spacing: -0.04em;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #15BAB1;
        }

        .hero-description {
            font-family: "Atyp text", sans-serif;
            font-size: 7.99px;
            font-weight: 400;
            line-height: 11.38px;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;

        }

        .hero-buttons {
            display: flex;
            justify-content: center;
        }

        .hero-buttons .btn {
            /* padding: 12px 30px;
            border-radius: 25px;
            font-weight: 500;
            margin-right: 15px; */
            margin-right: 15px;
            font-family: 'AtypDisplay', sans-serif;
            font-size: 7.99px;
            font-weight: 400;
            line-height: 11.38px;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            width: 80.98px;
            height: 22.91px;
            border-radius: 20px;
            box-shadow: 0px 2.13px 7.99px 0px #03BDB359;
        }

        .btn-financial-aid {
            /* font-family: 'AtypDisplay', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 21.36px;
            width: 152px;
            background-color: transparent;
            border: 1px solid #15BAB1;
            color: #15BAB1; */
            font-family: 'AtypDisplay', sans-serif;
            font-size: 7.99px;
            font-weight: 400;
            line-height: 11.38px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            background-color: transparent;
            border: 1px solid #15BAB1;
            color: #15BAB1;


        }

        .btn-financial-aid:hover {
            border: 1px solid #15BAB1;
            color: #15BAB1;
        }

        .hero-image {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 39.86px;
        }

        .hero-image img {
            max-width: 100%;
            width: 251px;
            height: auto;

        }

        .hero-image .aid-overlay {
            position: absolute;
            border-radius: 10px;
            left: -10.36px;
            right: 237.48px;
            width: 120.16px;
            top: 50px;
        }

        .hero-image .it-overlay {
            position: absolute;
            border-radius: 10px;
            left: 5.64px;
            right: 237.48px;
            width: 120.16px;
            top: 99px;
        }

        .hero-image .chart-overlay {
            position: absolute;
            border-radius: 10px;
            left: -16.36px;
            right: 237.48px;
            width: 120.16px;
            top: 162px;
        }

        .floating-element {
            position: absolute;
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .float-1 {
            top: 15%;
            right: 10%;
        }

        .floating-element .icon {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .float-1 .icon {
            background-color: #E8F0FF;
            color: #4A90E2;
        }


        .icon-wrapper {
            font-size: 2rem;
            /* margin-bottom: 1rem; */
            margin-top: 1.5rem;
        }

        .icon-wrapper img {
            width: 15.89px;
            height: 15.91px;
        }

        /* .icon-wrapper .python-vector{
           width:15.89px;
           height:15.91px;
        } */


        .course-card {
            position: relative;
            /* aspect-ratio: 1 / 1; */
            /* width: 294px; */
            width: 133.78px;
            /* min-width: 100%; */
            /* height: 258px; */
            /* border-radius: 40px; */
            border-radius: 18.14px;
            /* padding: 20px; */
            /* padding-left: 29px;
            padding-right:30px; */
            padding-left: 13.15px;
            /* padding-top: 31.29px; */
            color: white;
            column-gap: 20px;
            transition: transform 0.3s ease;
            /* margin-bottom: 20px; */
            display: flex;
            flex-direction: column;
            /* justify-content: space-between;
            align-items: start; */
            /* justify-content: center; */
            /* flex-shrink:0; */
            padding-bottom: 18px;
        }

        .course-card .icon {
            width: 48px;
            height: 48px;
            margin-bottom: 0rem;
        }

        .course-card .hr {
            position: absolute;
            left: 13px;
            bottom: 15px;
            width: 107.02px;
            height: 1.36px;
            border-radius: 4.53px;
            background-color: #ffffff;
            opacity: 40%;

        }

        .course-card h5 {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 12.7px;
            font-weight: 400;
            line-height: 12.7px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;

        }

        .course-card:hover {
            transform: scale(1.05);
        }

        .pink-gradient {
            background: linear-gradient(89.17deg, #FB729F 0.75%, #F55989 99.36%);
            box-shadow: 0px 30px 90px 0px #FA72A040;

        }

        .purple-gradient {
            background: linear-gradient(89.17deg, #A08CFD 0.75%, #917AFC 99.36%);
            box-shadow: 0px 30px 90px 0px #937DFC40;


        }

        .light-blue-gradient {
            background: linear-gradient(89.17deg, #65D5F3 0.75%, #4BC9E9 99.36%);
            box-shadow: 0px 30px 90px 0px #55CEED40;
        }

        .site-reliability-bg {
            background-color: #FFA500;
        }

        .cloud-eng-bg {
            background: linear-gradient(89.17deg, #65D5F3 0.75%, #4BC9E9 99.36%);
            box-shadow: 0px 30px 90px 0px #55CEED40;

        }

        .project-management-bg {
            background-color: #FF69B4;
        }

        .devops-bg {
            background-color: #8A2BE2;
        }

        .icon-wrapper {
            font-size: 2rem;
            /* margin-bottom: 1rem; */
        }

        .courses-section {
            /* padding: 40px 0; */
        }

        .courses-title {
            /* font-family:"Atyp Text", sans-serif;
            color: #2C2B31;
            font-size: 2rem;
            font-weight:600;
            line-height:32px;
            margin: 1rem 0; */
            font-family: "Atyp Text", sans-serif;
            font-size: 18.06px;
            font-weight: 600;
            line-height: 22.58px;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
        }

        .courses-subtitle {
            /* font-family:"Atyp Text", sans-serif;
            font-weight: 400;
            font-size:15.98px;
            line-height: 20px;
            opacity: 80%;
            color: #302F35;
            margin-bottom: 2rem; */
            font-family: "Atyp Text", sans-serif;
            font-size: 7.57px;
            font-weight: 400;
            line-height: 10px;
            text-align: center;
            opacity: 80%;
            color: #302F35;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            max-width: 210px;
            margin: auto;
            margin-bottom: 0.875rem;

        }


        .row-item {
            display: flex;
            overflow-x: auto;
            flex-wrap: nowrap;
            gap: 15px;
            scroll-behavior: smooth;
            padding-bottom: 10px;
        }

        .row-item .col {
            flex: 0 0 auto;
            width: 80%;
            max-width: 80%;
        }

        /* horizontal scroll */

        .container {
            max-width: 1200px;
            padding: 0 15px;
            margin: 0 auto;
        }


        .content h3 {
            font-family: "Atyp Text", sans-serif;
            font-weight: 600;
            /* font-size:27.07px;
            line-height:39.25px; */
            font-size: 16.13px;
            line-height: 23.39px;
            color: #ffffff;
            padding-top: 27.04px;
        }

        p.about-us {
            color: #FFFFFF;
            font-size: 12px;
        }

        .content .about-us {
            font-family: "Atyp Text", sans-serif;
            font-weight: 400;
            /* font-size:12.57px;
            line-height:17.72px; */
            font-size: 7.49px;
            line-height: 10.56px;
            color: #ffffff
        }

        .no-wrap {
            white-space: nowrap;
        }

        .btn-get-started {
            width: 152px;
            background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
            box-shadow: 0px 4px 15px 0px #03BDB359;
            color: #FFFFFF;
        }

        .btn-get-started:hover {
            color: #ffffff;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .access-btn {
            font-family: "Atyp Text", sans-serif;
            background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
            /* box-shadow: 0px 4px 15px 0px #03BDB359; */
            border-radius: 20px;
            text-wrap: nowrap;
            font-weight: 400;
            color: #ffffff;
            border: 0;
            outline: 0;
            /* font-size:15px;
            line-height:21.36px; */
            font-size: 8.91px;
            line-height: 12.68px;
            /* width:152px; */
            width: 90.25px;
        }

        .access-btn:hover {
            box-shadow: 0px 4px 15px 0px #03BDB359;
        }

        .students-btn {
            font-family: "Atyp Text", sans-serif;
            font-weight: 400;
            font-size: 8px;
            line-height: 11.39px;
            color: #ffffff;
            text-wrap: nowrap;
            border: 0;
        }

        .card-bg {
            background-color: #313036;
            border-radius: 17.55px;
            padding: 5px;
            background-color: #313036;
            height: 135px;
            width: 114.63px;
        }

        .rounded-img {
            width: 114.63px;
            height: 125.16px;
            border-top-left-radius: 17.55px;
            border-top-right-radius: 17.55px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 6px;
            color: #ffffff;

        }

        .card-content h5 {
            color: #ffffff;
            font-family: "Atyp Text", sans-serif;
            font-weight: 400;
            font-size: 7.02px;
            text-align: center;
        }

        .card-content p {
            font-family: "Atyp Text", sans-serif;
            font-weight: 400;
            font-size: 4.68px;
            line-height: 7.8px;
            opacity: 70%;
            text-align: center;
            max-width: 258px;
        }

        .btn-consult {
            width: 115.86px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
            box-shadow: 0px 4px 15px 0px #03BDB359;
            color: #ffffff;
            border: 0;
            display: flex;
            justify-content: center;
            margin: auto;
            border-radius: 10.07px;
            font-family: 'AtypDisplay', sans-serif;
            font-size: 7.56px;
            font-weight: 400;
            line-height: 10.76px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;

        }

        .btn-consult:hover {
            color: #ffffff;
            box-shadow: 0px 4px 15px 0px #03BDB359;
        }

        .bg-orange {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(104.4deg, #F7B15E -1.31%, #E18C28 97.25%);
            color: #ffffff;
            border-radius: 20px;
            /* padding-left: 40px;
            padding-right: 41px;
            padding-top: 53px;
            padding-bottom: 52px; */
            padding: 1rem;
            height: 173px;
        }

        .bg-pink {

            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(104.69deg, #FB729F 1.73%, #D8386A 92.33%);
            backdrop-filter: blur(9.218500137329102px);
            color: #ffffff;
            border-radius: 20px;
            /* padding-left: 40px;
            padding-right: 41px;
            padding-top: 53px;
            padding-bottom: 52px; */
            padding: 1rem;
            height: 173px;
        }

        .bg-purple {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(102.52deg, #A08CFD -0.23%, #5B3EE0 82.23%);
            color: #ffffff;
            border-radius: 20px;
            /* padding-left: 40px;
            padding-right: 41px;
            padding-top: 53px;
            padding-bottom: 52px; */
            padding: 1rem;
            height: 173px;
        }

        .para {
            font-family: 'AtypDisplay', sans-serif;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
        }

        .img-container {
            display: flex;
            flex-shrink: 0;
            gap: 9px;
            position: absolute;
            bottom: -68px;
            left: 25px;
            z-index: 1;
            align-items: flex-end;

        }

        .img-bottom {
            width: 88px !important;
            height: 80.38px !important;
            border-radius: 16.92px;
            border: 2px solid #FFFFFF;
            object-fit: cover;
            background-color: #232222;
        }

        .professional-title {
            display: flex;
            flex-direction: column;
            justify-content: end;
        }

        .professional-title h5 {
            font-family: "Atyp Text", sans-serif;
            font-weight: 600;
            font-size: 20px;
            line-height: 28.78px;
            color: #313035;
        }

        .professional-title p {
            font-family: "Atyp Text", sans-serif;
            font-weight: 400;
            font-size: 10px;
            line-height: 14.24px;
            color: #313035;
        }

        .card-width {
            width: 300px;
        }

        .owl-theme .owl-dots .owl-dot span {
            width: 22px;
            height: 7px;
            background-color: #E6E3E3;
            border-radius: 50px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .owl-theme .owl-dots .owl-dot.active span {
            width: 42px;
            background-color: #04A198;
        }

        /* MEDIA QUERY */
        @media (min-width:576px) {
            .hero-title {
                font-family: "Atyp text", sans-serif;
                font-size: 75px;
                font-weight: 600;
                line-height: 85px;
                margin-bottom: 41px;
                letter-spacing: -0.04em;
            }

            .hero-title .highlight {
                font-family: "Atyp text", sans-serif;
                font-size: 75px;
                font-weight: 400;
                line-height: 85px;
                letter-spacing: -0.04em;
            }

            .hero-description {
                font-size: 15px;
                line-height: 21.36px;
                margin-bottom: 41px;
                max-width: 548px;
            }

            .btn-get-started {
                width: 152px;
            }

            .hero-buttons .btn {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 152px;
                font-size: 15px;
                line-height: 21.36px;
                padding: 16px 34px;
                border-radius: 20px;
                font-weight: 500;
                margin-right: 15px;
                box-shadow: 0px 4px 15px 0px #03BDB359;

            }

            .btn-financial-aid {
                width: 152px;
                text-wrap: nowrap;
                font-size: 15px;
                line-height: 21.36px;
            }

            .hero-image {
                position: relative;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 2;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 39.86px;
            }

            .hero-image img {
                max-width: 100%;
                width: 251px;
                height: auto;

            }

            .hero-image .aid-overlay {
                width: 202px;
                left: 33.64px;
                top: 26px;
            }

            .hero-image .it-overlay {
                width: 202px;
                left: 59.64px;
                top: 86px;
            }

            .hero-image .chart-overlay {
                left: 98.64px;
                width: 120.16px;
                top: 165px;
            }

            .section-header {
                text-align: center;
                /* margin-bottom: 3rem; */
            }



            .section-title {
                font-family: 'AtypDisplay', sans-serif;
                font-size: 2.5rem;
                font-weight: 600;
                line-height: 50px;
                margin-bottom: 28px;
                text-align: center;
                color: #2C2B32;

            }

            .section-subtitle {
                font-size: 15.98px;
                line-height: 26.64px;
                font-weight: 400;
                text-align: center;
                margin: auto;
                max-width: 476px;
                margin-bottom: 2.9rem;
                opacity: 80%;
                color: #302F35;

            }

            .who-card {
                background: linear-gradient(103.12deg, #201E27 7.94%, #4B4B4B 114.59%);
                border-radius: 19.33px;
                width: 100%;
                max-height: 278px;
                padding-left: 15.56px;

            }

            .who-card .content {
                color: white;
            }

            .content-left {
                padding: 1rem 1rem 0rem 1rem;
            }

            .content-right {
                padding: 1rem 1rem 0rem 1rem;
            }

            .who-card img {
                padding: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-top-right-radius: 19.33px;
                border-bottom-right-radius: 19.33px;
            }


            .card {
                width: 609px;
                border-radius: 19.33px;
                height: 323px;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .card-img-top {
                height: 150px;
                object-fit: cover;
            }

            .card-body {
                padding: 1rem;
                flex-direction: column;
                justify-content: center;
                text-align: center;
            }

            .card-title {
                font-size: 1.2rem;
                font-weight: bold;
                margin-top: 0.5rem;
                text-align: start;
            }


            .card-bg {
                background-color: #313036;
                border-radius: 59.94px;
                padding: 12px;
                height: 430px;
                width: 25rem;
            }

            .rounded-img {
                width: 368.94px;
                height: 251.73px;
                border-top-left-radius: 53.28px;
                border-top-right-radius: 53.28px;
            }

            .card-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 36px;
                /* background-color:#313036; */
                color: #ffffff;

            }

            .card-content h5 {
                color: #ffffff;
                font-weight: 400;
                font-size: 24px;
                line-height: 35px;
                text-align: center;
            }

            .card-content p {
                font-family: "Atyp Text", sans-serif;
                font-weight: 400;
                font-size: 1rem;
                line-height: 27px;
                opacity: 70%;
                text-align: center;
                max-width: 258px;
            }


            .btn-consult {
                width: 230px;
                padding-top: 10px;
                padding-bottom: 10px;
                background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
                box-shadow: 0px 4px 15px 0px #03BDB359;
                color: #ffffff;
                border: 0;
                display: flex;
                justify-content: center;
                margin: auto;
                border-radius: 20px;
                font-family: 'AtypDisplay', sans-serif;
                font-size: 15px;
                line-height: 21.36px;

            }


            .content h3 {
                font-size: 27.07px;
                line-height: 39.25px;
                color: #ffffff;
                padding-top: 27.04px;
            }

            .content .about-us {
                font-size: 12.57px;
                line-height: 17.72px;
                color: #ffffff
            }

            .access-btn {
                font-family: "Atyp Text", sans-serif;
                background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
                border-radius: 20px;
                font-size: 15px;
                line-height: 21.36px;
                width: 152px;
            }

            .courses-subtitle {
                font-size: 15.98px;
                line-height: 26.64px;
                text-align: center;
                margin: auto;
                margin-bottom: 4rem;
                max-width: 100%;
            }

            .card-container {
                display: flex;
                flex-direction: row;
                gap: 20px;
            }

            .course-card {
                max-width: 294px;
            }

            .who-card {
                border-radius: 19.33px;
            }

            .who-card img {
                height: 261.38px;
                border-top-right-radius: 19.33px;
                border-bottom-right-radius: 19.33px;
            }

            .content-left {
                padding-top: 25.37px;
                padding-left: 26px;
                padding-right: 30px;
                /* padding-bottom: 4rem; */
            }

            .content-right {
                padding-top: 25.37px;
                padding-left: 26px;
                padding-right: 30px;
            }

            .card-width {
                width: 300px;
            }

            .btn-consult {
                width: 230px;
                padding-top: 10px;
                padding-bottom: 10px;
                background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
                box-shadow: 0px 4px 15px 0px #03BDB359;
                color: #ffffff;
                border: 0;
                border-radius: 20px;
            }

            .btn-consult:hover {
                color: #ffffff;
                box-shadow: 0px 4px 15px 0px #03BDB359;
            }

            .site-reliability-bg {
                background-color: #FFA500;
            }

            .courses-title {
                font-family: "Atyp Text", sans-serif;
                color: #2C2B31;
                font-size: 2rem;
                font-weight: 600;
                line-height: 32px;
                margin: 1rem 0;
            }

            .courses-subtitle {
                font-family: "Atyp Text", sans-serif;
                font-weight: 400;
                font-size: 15.98px;
                line-height: 20px;
                opacity: 80%;
                color: #302F35;
                margin-bottom: 2rem;
            }

            /* .owl-prev{
            color: black !important;
        }
        .owl-next{
            color: black !important; 
        }
            */
        }

        @media (min-width:768px) {
            .hero-section {
                padding: 4rem 0;
            }

            .hero-title {
                text-align: start;
            }

            .hero-subtitle {
                text-align: start;
            }

            .hero-btns {
                text-align: start;
            }

            .icon-wrapper {
                font-size: 2rem;
                /* margin-bottom: 1rem; */
            }

            .icon-wrapper img {
                width: 44px;
                height: 35.48px;
            }

            .course-card h5 {
                font-family: "Atyp text", sans-serif;
                font-size: 28px;
                font-weight: 400;
                line-height: 40px;
                margin-bottom: 1.75rem;
                /* max-width: 150px; */

            }


            .course-card {
                background-color: white;
                border-radius: 40px;
                padding: 1.5rem;
                height: 258px;
                margin-bottom: 1.5rem;
            }

            .course-card .icon {
                width: 48px;
                height: 48px;
                margin-bottom: 1rem;
            }

            /* .course-card h5:last-of-type {
             max-width: 194px;
           } */
            .who-card img {
                height: 276.38px;
                border-radius: 0px;
                border-top-right-radius: 19.33px;
                border-bottom-right-radius: 19.33px;
            }

            .card-width {
                width: 400px;
            }

            .access-btn {
                font-family: "Atyp Text", sans-serif;
                background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
                box-shadow: 0px 4px 15px 0px #03BDB359;
                font-size: 15px;
                line-height: 21.36px;
                width: 152px;
            }

            .site-reliability-bg {
                background-color: #FFA500;
            }

            .hero-buttons .btn {
                justify-content: flex-start;
                align-items: center;

            }

            .btn-financial-aid {
                width: 152px;
                text-wrap: nowrap;
                font-size: 15px;
                line-height: 21.36px;
            }


        }

        @media (min-width:992px) {
            .hero-section {
                padding: 4rem 0;
            }

            .hero-buttons {
                justify-content: flex-start;
            }

            .hero-image img {
                max-width: 100%;
                width: 358.44px;
                height: 398px;
            }

            .hero-image .aid-overlay {
                width: 202px;
                left: -6.36px;
                top: -94px;
            }

            .hero-image .it-overlay {
                width: 202px;
                left: 25.64px;
                top: -5px;
            }

            .hero-image .chart-overlay {
                left: 41.64px;
                width: 145px;
                top: 87px;
            }

            .course-card {
                width: 294px;
            }

            .row-item {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                /* gap: 20px; */
                overflow: visible;
            }

            .row-item:last-child {
                /* grid-template-columns: repeat(3, 1fr);  */
            }

            .row-item .col {
                flex: none;
                width: auto;
            }

            .course-card .hr {
                width: 236px;
                left: 30px;
                bottom: 35px;
            }

        }

        @media (min-width:1200px) {
            .hero-section {
                padding: 4rem 0;
            }
        }

        @media (min-width:1400px) {
            .hero-section {
                padding: 4rem 0;
            }

            .hero-image {
                margin-top: -15rem;
            }
        }


        /* MEDIA QUERY */
    </style>
@endsection
@section('content')
    {{-- @php
    $banner = getContent('banner.content', true)->data_values;
    @endphp --}}
    @php
        $banner = getContent('banner.content', true);
        $bannerData = $banner ? $banner->data_values : null;
    @endphp

    <!-- Hero Section -->
    <div class="container mx-auto">
        <div class="hero-section row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">Building the<br><span class="no-wrap">Next <span
                            class="highlight">Tech&nbsp;Giants</span></span></span></h1>
                <p class="hero-description text-lg-start">Ceeyit offers a self-paced platform to learn software development
                    and management skills. Our e-learning programs has been developed to build <br> giants in tech.</p>
                <div class="hero-buttons">
                    @guest
                        <a href="{{route('user.register')}}" class="btn btn-get-started">@lang('Get Started')</a>
                    @endguest
                    @auth
                        <a href="{{route('user.course.purchased')}}" class="btn btn-get-started">@lang('My Courses')</a>
                    @endauth
                    <button class="btn btn-financial-aid">@lang('Financial Aid')</button>
                </div>

            </div>
            <div class="col-md-6">
                <div class="hero-image">
                    <!-- <img src="assets/images/hero_image.png" alt="Student learning" style="float: right;"> -->
                    <img src="assets/images/boy_with_book.jpg" alt="Student learning" style="float: right;">
                    <img src="assets/images/aid_overlay_svg.svg" class="aid-overlay" alt="">
                    <img src="assets/images/it_overlay_svg.svg" alt="" class="it-overlay">
                    <img src="assets/images/chart_overlay_svg.svg" alt="" class="chart-overlay">
                </div>

                <!-- Floating Elements -->
                <!-- <div class=""> -->
                <div class="col-lg-6 text-center position-relative hero-image">
                    <img src="assets/images/aid_overlay.png" alt="" class="position-absolute"
                        style="left: -60px; top: 20px; z-index: 500;">

                </div>
                <!-- <div class="text">Financial Aid is available</div> -->
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <section>

        <!-- Courses Section -->
        <div class="container courses-section">

            <h2 class="courses-title">Our top essential career courses</h2>
            <p class="courses-subtitle">Introductory courses or modules that covers basic principles and concepts of
                information technology.</p>

            <div class="flex-xl-nowrap gx-3 row-item" style="gap:30px !important;">
                @foreach(\App\Models\Course::active()->topCourse()->inRandomOrder()->take(6)->get() as $course)
                    <div class="col-md-4 col-lg-3">
                        <a href="{{route('course.details', [$course->id, $course->slug])}}" style="text-decoration:none;">
                            <div
                                class="course-card {{$loop->index % 3 == 0 ? 'pink-gradient' : ($loop->index % 3 == 1 ? 'purple-gradient' : 'light-blue-gradient')}}">
                                <div class="icon-wrapper">
                                    <img src="{{getImage(imagePath()['course']['path'] . '/thumb_' . $course->thumbnail, imagePath()['course']['preview_size'])}}"
                                        class="rounded" alt="...">
                                </div>
                                <h5>{{$course->title}}</h5>
                                <div class="hr"></div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <!-- END CARD 1 -->

            </div>


        </div>
    </section>

    <section class=" py-5 bg-light">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title mb-0">Who Are We?</h2>
                <p class="section-subtitle pt-0">Your trusted tech partner building solutions for a digital world.</p>
            </div>

            <div class="row g-4 g-lg-3">
                <div class="col-12 col-md-6">
                    <div class="who-card">
                        <div class="row">
                            <div class="col-6">
                                <div class="content content-left">
                                    <h3>About us</h3>
                                    <p class="about-us">Ceeyit Solutions equips individuals with the skills needed to
                                        succeed as IT professionals. We offer live classes, pre-recorded videos, and online
                                        resources, along with assignments, quizzes, and exams. We also provide certification
                                        training and interview prep to ensure our students are job-ready.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="{{asset('assets/images/what-WE_Offer-1.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="who-card">
                        <div class="row">
                            <div class="col-6">
                                <div class="content content-right">
                                    <h3>Eligibility</h3>
                                    <p class="about-us">Individuals with or without background and experience in Computer
                                        Science and Engineering fields can join it. If you desire to be a software
                                        developer, project manager, data analyst and engineer.</p>

                                    <div class="d-flex pb-4 pb-lg-0">
                                        <a href="{{route('user.login')}}" class="btn access-btn">
                                            Gain acces
                                        </a>
                                        <button class="btn students-btn">For students</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="{{asset('assets/images/what-we-offer-2.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Offer Section -->
    <section class="py-5">
        <div class="container g-4">
            <div class="section-header">
                <h2 class="section-title">What we offer</h2>
                <p class="section-subtitle">Essential principles and core concepts for beginners in IT.</p>
            </div>

            <div class="row row-cols-3 align-items-center gy-3 gx-2  gx-md-4 gy-md-5">
                <!-- CARD 1 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-bg ">
                        <img src="assets/images/clear_fundamental_concept.png" alt="Fundamental Concepts"
                            class="img-fluid rounded-img">
                        <div class="card-content">
                            <h5 class="card-title">Fundamental Concepts</h5>
                            <p class="card-text">Building a Strong Knowledge Base in IT Fundamentals.</p>
                        </div>
                    </div>
                </div>
                <!-- END CARD 1 -->

                <!-- Repeat for other features -->
                <!-- CARD 2 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-bg ">
                        <img src="assets/images/clear_hands_experience.png" alt="Fundamental Concepts"
                            class="img-fluid rounded-img">
                        <div class="card-content">
                            <h5 class="card-title">Hands-on Experience</h5>
                            <p class="card-text">Gaining Practical Skills Through Real-World Applications.</p>
                        </div>
                    </div>
                </div>
                <!-- END CARD 2 -->

                <!-- CARD 3 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-bg ">
                        <img src="assets/images/clear_tool_chain.png" alt="Tool chain" class="img-fluid rounded-img">
                        <div class="card-content">
                            <h5 class="card-title">Toolchain Training</h5>
                            <p class="card-text">Equipping You with Essential Tools and Techniques.</p>
                        </div>
                    </div>
                </div>
                <!-- END CARD 3 -->
                <!-- CARD 4 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-bg">
                        <img src="assets/images/clear_cloud_infastructure_img.png" alt="Cloud Infrastructure"
                            class="img-fluid rounded-img">
                        <div class="card-content">
                            <h5 class="card-title">Cloud Infrastructure</h5>
                            <p class="card-text">Developing Expertise in Cloud-Based Systems and Services.</p>
                        </div>
                    </div>
                </div>
                <!-- END CARD 4 -->
                <!-- CARD 5 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-bg ">
                        <img src="assets/images/clear_certificate_image.png" alt="Certification & Assessments"
                            class="img-fluid rounded-img">
                        <div class="card-content">
                            <h5 class="card-title text-truncate">Certification & Assessments</h5>
                            <p class="card-text">Preparing You for Industry-Recognized Certifications.</p>
                        </div>
                    </div>
                </div>
                <!-- END CARD 5 -->
                <!-- CARD 6 -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card card-bg ">
                        <img src="assets/images/clear_support.png" alt="Support" class="img-fluid rounded-img">
                        <div class="card-content">
                            <h5 class="card-title">Support</h5>
                            <p class="card-text">Providing Guidance and Resources Every Step of the Way.</p>
                        </div>
                    </div>
                </div>
                <!-- END CARD 6 -->
            </div>
        </div>
    </section>
    <!-- <br><br>
    <section class="first-section">
        <div class="container">
            <div class="row gy-4">
                <h6 class="title-head text-center">Transition to DevOps</h6>
                <p class="title-desc text-center">CeeyIT is an online software suite that combines all the tools needed<br> to learn and become a professional DevOps..</p>

            </div>
            <br>
            <center>
                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-4 col-md-4 col-sm-6">

                        <div class="icon_bg" style="background-image: url('assets/images/frontend/img/file.svg'); background-repeat: no-repeat;background-position: center center;">

                        </div>
                        <div class="box-first">
                            <br>
                            <p class="in_box_text_head">Comprehensive Curriculum

                            </p>
                            <p style="margin-top:-40px" class="in_box_text_desc">Well structured curriculum designed by Industry experts, and regularly updated to keep up with industry trends. </p>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">

                        <div class="icon_bg" style="background-color:#00CBB8;background-image: url('assets/images/frontend/img/cal.svg'); background-repeat: no-repeat;background-position: center center;">

                        </div>
                        <div class="box-first">
                            <br>
                            <p class="in_box_text_head">Collaborative And Interactive Learning
                            </p>
                            <p class="in_box_text_desc">There’s collaboration between learners through study groups, live classes with instructors or mentors, to aid active participation in learning process. </p>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">

                        <div class="icon_bg" style="background-color:#29B9E7;background-image: url('assets/images/frontend/img/last.svg'); background-repeat: no-repeat;background-position: center center;">

                        </div>
                        <div class="box-first">
                            <br>
                            <p class="in_box_text_head">Real World Projects
                            </p>
                            <p class="in_box_text_desc">Individuals are exposed to hands-on projects where they get to apply knowledge and skills learnt. </p>
                        </div>

                    </div>

                </div>

            </center>

        </div>

    </section>

    <section class="first-section">
        <div class="container">
            <div class="row gy-4 mx-5">
                <h6 class="title-head text-center">Who are CeeyIT?</h6>

                <center>
                    <p class="title-desc text-center">CeeyIT Solutions is a platform that equips individuals with technical and non technical<br> skills to become a DevOps Engineer. Students learn through stored and live course <br>materials online; assignments, quizzes and exams. Students can monitor due dates; <br>grade results and provide relevant feedback all in one place.</p>

                </center>
            </div>
            <br>
            <center>
                <div class="row who_are align-items-center justify-content-xl-start justify-content-center">
                    <div>
                        <h6 class="title-head text-center text-white">FOR STUDENTS</h6>
                        <div class="gain">

                            <a href="{{route('user.login')}}" class="btn btn-lg text-white me-2 mt-sm-0 mt-2">
                                {{-- <i class="las la-user fs--18px me-2"></i> --}}
                                Gain Access</a>
                        </div>
                    </div>
                </div>
            </center>

        </div>

    </section>
    <br>
    <section class="first-section">
        <div class="container">
            <div class="row gy-4 p-3">
                <div class="col-xl-5 col-lg-5 text-xl-start ">
                    <svg width="73" height="73" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="36.5" cy="36.5" r="36.5" fill="#4C94FF" />
                    </svg>

                    <h6 class="title-head" style="color:#2F327D;margin-top:-50px;font-size:24px">Training Eligibility</h6>
                    <br>
                    <p class="title-desc " style="font-size:16px">Individuals with or without background and experience in Engineering and Computer Science fields can join it. If you <b>desire</b> to be a Software developer, Network Engineer, Testing Engineer & QA Engineer, System Administrator or Cloud Engineer.</p>
                    <br>

                    {{-- <a href="{{route('user.login')}}" style="text-decoration: underline; color:#111;font-size:14px">
                    Learn More</a> --}}
                </div>
                <div class="col-xl-2 col-lg-2 text-xl-start "></div>

                <div class="col-xl-5 col-lg-5 text-xl-start ">
                    <img src="assets/images/frontend/img/digital.png" style="width: 100%" />
                </div>
            </div>

        </div>

    </section>

    <section class="first-section">
        <div class="container">
            <div class="row gy-4 p-3">
                <h6 class="title-head text-center">What We Offer</h6>
                {{-- <p class="title-desc text-center">This very extraordinary feature, can make learning activities more efficient</p> --}}

            </div>
            <br>

            <div class="row gy-4 mt-0">
                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <img src="assets/images/frontend/img/devops_traning.png" style="width: 80%" />
                </div>
                <div class="col-xl-4 col-lg-4 text-xl-start ">

                    <br><br><br>
                    <p class="title-desc " style="font-size:14px;">We cover a wide range of topics and provide comprehensive resources and tools to support learners in their journey.
                    </p>

                </div>
                <div class="col-xl-2 col-lg-2 text-xl-start "></div>
            </div>


            <div class="row gy-4 mt-5">

                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <h6 class="title-head" style="color:#2F327D;margin-top:40px;font-size:24px">Fundamental Concepts</h6>
                    <br>

                    <p class="title-desc " style="font-size:14px;">Introductory courses or modules that covers basic <br>principles and concepts of DevOps
                    </p>

                </div>
                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <img src="assets/images/frontend/img/software.png" style="width: 80%;margin-top:0px" />
                </div>
            </div>

            <div class="row gy-4 mt-0 mx-5">
                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <img src="assets/images/frontend/img/handson.png" style="width: 100%;margin-top:30px" />
                </div>
                <div class="col-xl-4 col-lg-4 text-xl-start ">
                    <br /><br />
                    <h6 class="title-head" style="color:#2F327D;margin-top:40px;font-size:24px">Hands-on Experience</h6>
                    <br>

                    <p class="title-desc " style="font-size:14px;">Interactive and hands on training which allows learners to practice using DevOps tools and technologies. This helps to reinforce their understanding of concepts and gain practical experience,
                    </p>

                </div>
                <div class="col-xl-2 col-lg-2 text-xl-start "></div>
            </div>


            <div class="row gy-4 mt-5 mx-5">

                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <h6 class="title-head" style="color:#2F327D;margin-top:40px;font-size:24px">Toolchain Training</h6>
                    <br>

                    <p class="title-desc " style="font-size:14px;">In-depth training on popular DevOps tools and <br />technologies such as version control systems
                    </p>

                </div>
                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <img src="assets/images/frontend/img/devopsstuff.png" style="width: 100%;margin-top:0px" />
                </div>
            </div>



            <br /><br /><br />
            <section class="first-section ">
                <div class="container">
                    <div class="row gy-4">
                        <h6 class="title-head text-center" style="color: #2F327D">Cloud Infrastructure</h6>

                        <center>
                            <p class="title-desc text-center">This cover topics that provides guidance on deploying <br>and managing infrastructure in the cloud e.g <br>Amazon Web Services (AWS).
                            </p>

                        </center>
                    </div>
                    <br><br>
                    <center>
                        <div>
                            <img src="assets/images/frontend/img/devops_server.png" style="width: 100%;" />

                        </div>
                    </center>

                </div>

            </section>
            <br><br>


            <div class="row gy-4 mt-5 mx-5">
                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <img src="assets/images/frontend/img/graduation.png" style="width: 80%;margin-top:-60px" />
                </div>

                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <h6 class="title-head" style="color:#2F327D;margin-top:40px;font-size:24px">Certification & Assessments</h6>
                    <br>

                    <p class="title-desc " style="font-size:14px;">We offer certification programs or assessments to <br>validate learners' knowledge and skills in specific DevOps <br>domains, to provide recognition and enhance their <br>professional profiles.
                    </p>

                </div>

            </div>
            <br><br><br>

            <div class="row gy-4 mt-5 mx-5">


                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <h6 class="title-head" style="color:#2F327D;margin-top:40px;font-size:24px">Support</h6>
                    <br>

                    <p class="title-desc " style="font-size:14px;">We provide support needed. We are available for <br>questions, clarifications, and also to share our <br />experiences. This gives all access to subject matter <br>experts or mentors who can provide guidance <br>and support.

                    </p>

                </div>

                <div class="col-xl-6 col-lg-6 text-xl-start ">
                    <img src="assets/images/frontend/img/support_devops.png" style="width: 80%;margin-top:-60px" />
                </div>

            </div>






            {{-- <div class="col-xl-7 col-lg-7 text-xl-start " >
                <img src="assets/images/frontend/img/people.png" style="width: 100%"  />
            </div>
            <div class="col-xl-1 col-lg-1 text-xl-start " ></div>
                <div class="col-xl-4 col-lg-4 text-xl-start " >
                    <br><br>
                     <h6 class="title-head" style="color:#2F327D;margin-top:30px">A user interface designed <br>for the classroom</h6>
              <br>
            <div style="display: flex">
                  <img src="assets/images/frontend/img/item_1.svg"   />
                    <p class="title-desc " style="font-size:16px" >Students have smooth access to all courses enrolled for.</p>
            </div>
            <div style="display: flex">
                  <img src="assets/images/frontend/img/item_2.svg"   />
                    <p class="title-desc " style="font-size:16px" >Study Experience is precise and completely exciting</p>
            </div>
            <div style="display: flex; margin-left:30px">
                  <img src="assets/images/frontend/img/item_3.svg" style="width: 30px;margin-right:20px"   />
                    <p class="title-desc " style="font-size:16px" >Teachers can easily see all students and class data at one time.</p>
            </div>

                </div>



            </div> --}}

            {{-- <br><br><br><br>
            <div class="row gy-4 mt-3 p-3" >

                <div class="col-xl-4 col-lg-4 text-xl-start " >

                     <h6 class="title-head" style="color:#2F327D;margin-top:30px">Best Tool for <br>Learners.</h6>
              <br>
                    <p class="title-desc " style="font-size:14px" >Class has a dynamic set of teaching tools built to be deployed and used during class. Teachers can handout assignments in real-time for students to complete and submit.
                    </p>

                </div>
                <div class="col-xl-3 col-lg-3 text-xl-start " ></div>
                <div class="col-xl-5 col-lg-5 text-xl-start " >
                <img src="assets/images/frontend/img/besttool.png" style="width: 100%"  />
            </div>



            </div>

            <br><br><br><br> --}}
            {{-- <div class="row gy-4 mt-3 p-3" >
                <div class="col-xl-5 col-lg-5 text-xl-start " >
                <img src="assets/images/frontend/img/assessment.png" style="width: 100%"  />
            </div>
            <div class="col-xl-2 col-lg-2 text-xl-start " ></div>

                <div class="col-xl-5 col-lg-5 text-xl-start " >
                     <h6 class="title-head" style="color:#2F327D;margin-top:30px">Assessments, <br><span style="color:#00CBB8">Quizzes,</span> Tests</h6>
              <br>
                    <p class="title-desc " style="font-size:14px" >Easily launch live assignments, quizzes, and tests. Student results are automatically entered in the online gradebook.
                    </p>

                </div>

            </div>

            <br><br><br><br> --}}
            {{-- <div class="row gy-4 mt-3" >

            <div class="col-xl-5 col-lg-5 text-xl-start " >
                     <h6 class="title-head" style="color:#2F327D;margin-top:30px"><span style="color:#00CBB8">Class Management</span> <br>Tools for Educators</h6>
              <br>
                    <p class="title-desc " style="font-size:14px" >Class provides tools to help run and manage the class such as Class Roster, Attendance, and more. With the Gradebook, teachers can review and grade tests and quizzes in real-time.
                    </p>

                </div>
                <div class="col-xl-2 col-lg-2 text-xl-start " ></div>

                <div class="col-xl-5 col-lg-5 text-xl-start " >
                <img src="assets/images/frontend/img/classmanagment.png" style="width: 100%"  />
            </div>

            </div>


            <br><br><br><br> --}}
            {{-- <div class="row gy-4 mt-3" >
                <div class="col-xl-5 col-lg-5 text-xl-start " >
                <img src="assets/images/frontend/img/oneonone.png" style="width: 100%"  />
            </div>
            <div class="col-xl-2 col-lg-2 text-xl-start " ></div>
            <div class="col-xl-5 col-lg-5 text-xl-start " >
                     <h6 class="title-head" style="color:#2F327D;margin-top:50px">One-on-One <br><span style="color:#00CBB8">Discussions</span> </h6>
              <br>
                    <p class="title-desc " style="font-size:14px" >Teachers and teacher assistants can talk with students privately without leaving the Zoom environment.
                    </p>

                </div>




            </div> --}}
        </div>

    </section> -->

    <!-- Student's Feedback Section -->
    <section class="py-5 my bg-light">
        <div class="container-fluid">
            <div class="section-header">
                <h2 class="section-title">Student’s Feedback</h2>
                <p class="section-subtitle">Testimonials from our CEEYIT alumnis.</p>
            </div>

            <!-- <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel"> -->
            <div id="" class="owl-carousel owl-theme">
                @foreach(\App\Models\Review::InRandomOrder()->distinct('user_id')->take(9)->get() as $review)
                    <div class="">
                        <div class="" style="height:40%;">
                            <div
                                class="position-relative align-items-center justify-content-center {{$loop->index % 3 == 0 ? 'bg-pink' : ($loop->index % 3 == 1 ? 'bg-orange' : 'bg-purple')}} card-width">
                                <img src="../../assets/images/angle_image.svg" alt="Angle Image" class="position-absolute"
                                    style="top:-20px; left: 185px; width:240px;">
                                <p class="para">{{$review->review}}</p>
                                <div class="img-container">
                                    <img src="{{getImage('/assets/images/user/profile/' . $review->user->image, '350x350')}}"
                                        class="img-bottom" alt="Student Feedback">
                                    <div class="professional-title">
                                        <h5 class="mb-0">{{$review->user->fullname}}</h5>
                                        <p class="mb-0">@if($review->course){{$review->course->category->name}} Student,
                                        @endif{{$review->user->address->country ?? ''}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Consultation Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="section-title">Get Expert Consultation</h2>
            <p class="section-subtitle">Speak with our experts for insights and support to achieve your goals.</p>
            <a href="{{ url('consultation')}}" class="btn btn-consult">Get Consultation</a>
        </div>
    </section>

    <!-- <section class="first-section">
        <div class="container">
            <div class="row gy-4">
                <h6 class="title-head headerHod text-center" style="font-weight:500">GET EXPERT <br>CONSULTATION & GET <br>YOUR DREAM JOB.</h6>

                <center>
                    <a href="{{ url('consultation')}}">
                        <p class="title-desc text-white" style="width: 280px; font-weight:600;background:#252641;padding:10px;border-radius:8px">GET CONSULTATION</p>
                    </a>
                </center>
            </div>
            <br>

        </div>

    </section> -->
    <br>
    @push('script')
        <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
        <!-- owl carousel -->
        <script src="{{ asset('assets/global/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('assets/global/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".owl-carousel").owlCarousel({
                    items: 5,
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 1500, // Time in milliseconds between transitions (3 seconds)
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1 // 1 item for small screens
                        },
                        600: {
                            items: 2 // 2 items for medium screens
                        },
                        1000: {
                            items: 3 // 3 items for large screens
                        },
                    }
                });
            });
        </script>
    @endpush
    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            <!-- @include($activeTemplate.'sections.'.$sec) -->
        @endforeach
    @endif
@endsection