<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- moving letter css  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <!-- anime style css  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inner.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Engage</title>
    <link rel="icon" type="image/x-icon" href="images/fav-icon.png">

</head>

<body></body>
<!-- <div class="top-header">
     <div class="container">
          <div class="row p-0">
               <div class="col-lg-12">
                    <div class="top-line">
                         <h4>We've helped <b>1739</b> people from this month</h4>
                    </div>
               </div>
          </div>
     </div>
</div> -->
<style>


</style>


<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo_1.png" class="img-fluid">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link active" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="nav-item main_drop">
                                <!-- insurance-services.php -->
                                <a class="nav-link" href="#">Insurance Services</a>
                                <ul class="drop-menu">
                                    <li><a href="{{route('front.health-insurance')}}">Health</a></li>
                                    <li><a href="{{route('front.dental-insurance')}}">Dental</a></li>
                                    <li><a href="{{route('front.vision-insurance')}}">Vision</a></li>
                                    <li><a href="{{route('front.affordable-care-act-aca')}}">ACA</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('front.learning')}}">Learning ACA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('front.blogs')}}">Articles/Blog </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('front.contact')}}">Contact</a>
                            </li>
                            <!-- <li class="nav-item">
                                        <a class="nav-link" href="#">Enroll Now</a>
                                   </li> -->

                        </ul>
                        <a href="tel:+833-775-1105" class="call"><i
                                class="fa-solid fa-phone-volume fa-shake"></i>833-775-1105</a>
                        <a href="javascript:;" class="btn btn-custom" data-toggle="modal"
                            data-target="#exampleModal">Enroll Now</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<style>
.aetna-img img {
    width: 14%;
    filter: sepia(1);
}
</style>

<section class="inner-banner health-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-heading" aos-init aos-animate="" data-aos="fade-left" data-aos-offset="300"
                    data-aos-easing="ease-in-sine" data-aos-duration="1500">
                    <h1>Health <span class="blue">
                            <span class="ml6">
                                <span class="text-wrapper">
                                    <span class="letters">Insurance</span>
                                </span>
                            </span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="vision-pg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="main-collaps">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Health
                                Insurance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Dental
                                Insurance</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Vision
                                Insurance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Affordable Care
                                Act</a>
                        </li>
                    </ul>
                </div>
                <div class="talk-insurance">
                    <img src="images/circle-phone.png" class="img-fluid" alt="">
                    <h4>Talk to Our <span class="d-block">Insurance Agent</span></h4>
                    <h3><a href="tel:+833-775-1105">833-775-1105</a></h3>
                    <!-- <span class="d-block">
                                   Call to Our Experts</span> -->
                </div>
            </div>
            <div class="col-lg-9">
                <div class="tabs-show-nav">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="tabs-coverage">
                                <h2>Health Insurance Protects You and Yours</h2>
                                <p>We all need health care and often help paying for it. A good health insurance
                                    plan can help you prioritize your health without paying more than you
                                    should and to be prepared for both preventative care and the unexpected.
                                </p>

                                <p>The primary purpose of health insurance is to provide financial protection
                                    against the high costs of medical care and access to great networks of
                                    providers. This helps you to access necessary medical care without worrying
                                    about the financial implications especially when faced with serious illness
                                    or injury.
                                    Health insurance can be obtained through various sources, including
                                    employers, government programs (such as Medicare and Medicaid), private
                                    insurance companies, or through healthcare marketplace exchanges.</p>
                                <p>Engage Health Insurance LLC is here to help you make an informed decision on
                                    your health insurance and to match you up with the best plan for your
                                    needs. We work with multiple trusted health insurance carriers for unbiased
                                    recommendations tailored to your unique circumstances. </p>
                                <h2>Insurance Options</h2>
                                <p><span>Health Management Networks:</span> Depending on how many plans are offered in
                                    your area, you may find several network types such as, HMO, PPO, EPO, and POS, at
                                    each metal level—Bronze, Silver, Gold and Platinum. </p>
                                <p><span>Individual and Family Plans: </span>Affordable health plans bring peace
                                    of mind to individuals and families in providing effective financial
                                    support for the costs of medical care. Engage Health Insurance LLC will
                                    help to navigate the ACA Certified Individual and Family plans with you to
                                    help determine eligibility for cost savings or even $0 premium plans.
                                </p>



                                <p><span>Short-Term Medical Insurance:</span>These plans are designed to help
                                    with gaps in insurance coverage such as those created when you leave one
                                    job and take another before you can enroll in the new plan. These plans can
                                    run from 1 to 12 months and can be a prudent precaution.
                                </p>
                                <p><span>Hospital Indemnity:</span>Hospital indemnity insurance is an insurance
                                    plan you can purchase in addition to your health insurance plan. You will
                                    have a monthly premium as you would with other insurance. Should you end up
                                    spending time in the hospital, you receive a fixed benefit amount paid
                                    directly to you to help cover expenses. These plans are supplemental to
                                    health insurance for hospitalization and do not replace your health
                                    insurance.
                                </p>
                                <p><span>Accident Expense Insurance:</span> These plans are ancillary health
                                    plans which can be combined with your primary coverage that will pay a cash
                                    benefit in the event of an accidental injury or sickness. They may pay a
                                    lump sum for the ambulance, emergency room, hospital, doctors,
                                    rehabilitation, nursing, or prescriptions which are the result of the
                                    accident. Often accident plans do not have a requirement to stay in-network
                                    for coverage.
                                </p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="plan-insurance">
                                            <img src="images/couple.png" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="include-health">
                                            <h2 class="side-heading aos-init aos-animate="" aos-init=""
                                                            aos-animate="" data-aos=" fade-down" data-aos-offset="300"
                                                data-aos-easing="ease-in-sine" data-aos-duration="1000">
                                                Health <span class="blue">Insurance </span> Plans include
                                            </h2>
                                            <p>Health Management Networks such as HMO, PPO, EPO, POS and some
                                                plans meant to coordinate with a health savings account.</p>
                                            <ul>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                    <p>Individual and Family Plans.</p>
                                                </li>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                    <p>Short-Term Medical.</p>
                                                </li>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                    <p>Hospital Indemnity.</p>
                                                </li>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                    <p>Accident.</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p>The friendly agents at Engage Health Insurance LLC can review vision plan
                                             options with you on the phone and provide a quotation for your review and
                                             enrollment.</p> -->
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="tabs-coverage">
                                <h2>Why should I consider vision insurance?</h2>
                                <p>The purpose of vision insurance is to assist individuals in managing the
                                    costs associated with eye care and vision-related expenses. Vision
                                    insurance is designed to cover services and products related to maintaining
                                    good eye health and correcting vision problems. Having vision insurance
                                    helps promote a preventative approach to eyecare and encouragement to
                                    prioritize eye health.</p>
                                <h2>Your sight is precious – coverage is priceless!</h2>
                                <p>The purpose of vision insurance is to assist individuals in managing the
                                    costs associated with eye care and vision-related expenses. Vision
                                    insurance is designed to cover services and products related to maintaining
                                    good eye health and correcting vision problems. Having vision insurance
                                    helps promote a preventative approach to eyecare and encouragement to
                                    prioritize eye health.</p>

                            </div>
                            <div class="point-bot">
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial.png" class="img-fluid" alt="">
                                        <h4>Financial Assistance</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>Health Insurance doesn’t generally cover vision care but eyecare
                                            plays an important
                                            role in your overall health. Vision coverage is relatively
                                            inexpensive and can save
                                            on many out-of-pocket eye care expenses including prescription
                                            glasses and contact
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial-1.png" class="img-fluid" alt="">
                                        <h4>Coverage</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>Like health insurance you pay a monthly premium and have access to
                                            providers, such as
                                            optometrists and opthalmologists.
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial-2.png" class="img-fluid" alt="">
                                        <h4>Prevention</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>Yearly exams are recommended but it is also advisable to see the
                                            doctor anytime you
                                            notice a change in your vision. Eyesight changes over time and
                                            prescriptions for
                                            glasses need to keep pace with those changes. Coverage makes
                                            regular eye exams
                                            affordable so that you can take appropriate corrective action.
                                            Regular exams can
                                            catch conditions like glaucoma, cataracts, retina abnormalities
                                            or cancer at an early
                                            state.
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial-3.png" class="img-fluid" alt="">
                                        <h4>Other Benefits</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>Participating in a vision plan can give you discounts on vision
                                            expenses, eyeglasses
                                            and even allowances on designer frames.
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial-4.png" class="img-fluid" alt="">
                                        <h4>Choosing a Plan</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>What does the plan cover? What are the deductibles and co-pays? Are
                                            there waiting
                                            periods? What the allowances are given for eyeglasses, frames,
                                            contacts or laser
                                            vision correction? Are doctors in the carrier’s network
                                            convenient to your location?
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance llc-assistance">
                                    <div class="financial-name">
                                        <img src="images/setting.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="financial-discription">
                                        <!-- <p>The friendly agents at Engage Health Insurance LLC can review
                                                       vision plan options with
                                                       you on the phone and provide a quotation for your review and
                                                       enrollment.
                                                  </p> -->
                                    </div>
                                </div>
                                <div class="amerities-img">
                                    <img src="images/ameritas-logo.png" class="img-fluid" alt="">
                                    <img src="images/uniterd.png" class="img-fluid" alt="">
                                    <img src="images/vision-logo.png" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="tabs-coverage">
                                <h2>Your sight is precious – coverage is priceless!</h2>
                                <p>The purpose of vision insurance is to assist individuals in managing the
                                    costs associated with eye care and vision-related expenses. Vision
                                    insurance is designed to cover services and products related to maintaining
                                    good eye health and correcting vision problems. Having vision insurance
                                    helps promote a preventative approach to eyecare and encouragement to
                                    prioritize eye health.</p>
                                <h2>Why should I consider vision insurance?</h2>
                                <p>The purpose of vision insurance is to assist individuals in managing the
                                    costs associated with eye care and vision-related expenses. Vision
                                    insurance is designed to cover services and products related to maintaining
                                    good eye health and correcting vision problems. Having vision insurance
                                    helps promote a preventative approach to eyecare and encouragement to
                                    prioritize eye health.</p>
                            </div>
                            <div class="point-bot">
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial.png" class="img-fluid" alt="">
                                        <h4>Financial Assistance</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>Health Insurance doesn’t generally cover vision care but eyecare
                                            plays an important
                                            role in your overall health. Vision coverage is relatively
                                            inexpensive and can save
                                            on many out-of-pocket eye care expenses including prescription
                                            glasses and contact
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial-1.png" class="img-fluid" alt="">
                                        <h4>Coverage</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>Like health insurance you pay a monthly premium and have access to
                                            providers, such as
                                            optometrists and opthalmologists.
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial-2.png" class="img-fluid" alt="">
                                        <h4>Prevention</h4>
                                    </div>
                                    <div class="financial-discription">
                                        <p>Yearly exams are recommended but it is also advisable to see the
                                            doctor anytime you
                                            notice a change in your vision. Eyesight changes over time and
                                            prescriptions for
                                            glasses need to keep pace with those changes. Coverage makes
                                            regular eye exams
                                            affordable so that you can take appropriate corrective action.
                                            Regular exams can
                                            catch conditions like glaucoma, cataracts, retina abnormalities
                                            or cancer at an early
                                            state.
                                        </p>
                                    </div>
                                </div>
                                <div class="financial-assistance">
                                    <div class="financial-name">
                                        <img src="images/financial-3.png" class="img-fluid" alt="">