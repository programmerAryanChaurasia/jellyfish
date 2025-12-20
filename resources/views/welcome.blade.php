<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Complete Website Layout</title>
		<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		/* FIX FOR CKEDITOR TEXT SIZE - ADD ONLY THIS */
		.lead p, .card-text p, p.lead, .card-text {
			font-size: 1.25rem !important;
			line-height: 1.6 !important;
		}
		.jumbotron p.lead {
			font-size: 1.25rem !important;
		}
		.welcome p.lead {
			font-size: 1.25rem !important;
		}
		.text-center.padding p {
			font-size: 1rem !important;
		}

        
	</style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img src="img/logo6.jpg"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Services</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Team</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Connect</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!--- Image Slider -->
@php
    $heroSliders = $sections['hero_slider']->content['sliders'] ?? [];
@endphp

<div id="slides" class="carousel slide" data-ride="carousel" data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<ul class="carousel-indicators">
        @if(count($heroSliders) > 0)
            @foreach($heroSliders as $index => $slider)
            <li data-target="#slides" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
            @endforeach
        @else
            <li data-target="#slides" data-slide-to="0" class="active"></li>
            <li data-target="#slides" data-slide-to="1"></li>
            <li data-target="#slides" data-slide-to="2"></li>
        @endif
	</ul>
	<div class="carousel-inner">
        @if(count($heroSliders) > 0)
            @foreach($heroSliders as $index => $slider)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                @if(!empty($slider['image']))
                    <img class="image" src="{{ Storage::url($slider['image']) }}">
                @else
                    @if($index == 0)
                        <img class="image" src="img/background.png">
                    @elseif($index == 1)
                        <img class="image" src="img/background2.png">
                    @else
                        <img class="image" src="img/background3.png">
                    @endif
                @endif

                @if($index == 0)
                <div class="carousel-caption">
                    <h1 class="display-2">{{ $slider['heading'] ?? 'Website' }}</h1>
                    <h3>{{ $slider['sub_heading'] ?? 'Complete Website Layout' }}</h3>
                    <button type="button" class="btn btn-outline-light btn-lg">VIEW DEMO</button>
                    <button type="button" class="btn btn-primary btn-lg">Get Started</button>
                </div>
                @endif
            </div>
            @endforeach
        @else
            <div class="carousel-item active">
                <img class="image" src="img/background.png">
                <div class="carousel-caption">
                    <h1 class="display-2">Website</h1>
                    <h3>Complete Website Layout</h3>
                    <button type="button" class="btn btn-outline-light btn-lg">VIEW DEMO</button>
                    <button type="button" class="btn btn-primary btn-lg">Get Started</button>
                </div>
            </div>
            <div class="carousel-item">
                <img class="image" src="img/background2.png">
            </div>
            <div class="carousel-item">
                <img class="image" src="img/background3.png">
            </div>
        @endif
	</div>
</div>

<!--- Jumbotron -->
@php
    $jumbotron = $sections['jumbotron'] ?? null;
@endphp

<div class="container-fluid" data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<p class="lead">
                @if($jumbotron && !empty($jumbotron->content['description']))
                    <div style="font-size: 1.25rem; line-height: 1.6;">{!! $jumbotron->content['description'] !!}</div>
                @else
                    A web hosting service allows individuals and organizations to make their website accessible via the World Wide Web.
                @endif
            </p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
			<a href="#"><button type="button" class="btn btn-outline-secondary btn-lg">
                @if($jumbotron && !empty($jumbotron->content['button_text']))
                    {{ $jumbotron->content['button_text'] }}
                @else
                    Web Hosting
                @endif
            </button></a>
		</div>
	</div>
</div>

<!--- Welcome Section -->
@php
    $builtWithEase = $sections['built_with_ease'] ?? null;
@endphp

<div class="container-fluid padding"data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">
                @if($builtWithEase && !empty($builtWithEase->content['heading']))
                    {{ $builtWithEase->content['heading'] }}
                @else
                    Built with ease.
                @endif
            </h1>
		</div>
		<hr>
		<div class="col-12">
			<p class="lead">
                @if($builtWithEase && !empty($builtWithEase->content['description']))
                    <div style="font-size: 1.25rem; line-height: 1.6;">{!! $builtWithEase->content['description'] !!}</div>
                @else
                    Welcome to my website tutorial! Bootstrap is a free and open-source front-end library with HTML and CSS based designs.
                @endif
            </p>
		</div>
	</div>
</div>

<!--- Three Column Section -->
@php
    $services = $sections['services']->content['services'] ?? [];
@endphp

<div class="container-fluid padding"data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<div class="row text-center padding">
        @if(count($services) >= 3)
            @foreach($services as $index => $service)
                @if($index < 3) {{-- Show only first 3 services --}}
                <div class="col-xs-12 col-sm-6 col-md-4">
                    @if(!empty($service['icon']))
                        <i class="{{ $service['icon'] }}"></i>
                    @else
                        @if($index == 0)
                            <i class="fas fa-code"></i>
                        @elseif($index == 1)
                            <i class="fas fa-bold"></i>
                        @else
                            <i class="fab fa-css3"></i>
                        @endif
                    @endif
                    <h3>{{ $service['title'] ?? ($index == 0 ? 'HTML5' : ($index == 1 ? 'BOOTSTRAP' : 'CSS3')) }}</h3>
                    <p><div style="font-size: 1rem;">{!! $service['description'] ?? 'Built with the latest version...' !!}</div></p>                </div>
                @endif
            @endforeach
        @else
            <div class="col-xs-12 col-sm-6 col-md-4">
                <i class="fas fa-code"></i>
                <h3>HTML5</h3>
                <p>Built with the latest version of HTML, HTML5.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <i class="fas fa-bold"></i>
                <h3>BOOTSTRAP</h3>
                <p>Built with the latest version of Bootstrap, Bootstrap 4.</p>
            </div>
            <div class="col-xs-12 col-md-4">
                <i class="fab fa-css3"></i>
                <h3>CSS3</h3>
                <p>Built with the latest version of CSS, CSS3.</p>
            </div>
        @endif
	</div>
	<hr class="my-4">
</div>

<!--- Two Column Section -->
<div class="container-fluid padding"data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<div class="row padding">
		<div class="col-md-12 col-lg-6">
			<h2>If you build it...</h2>
			<p>The columns will automatically stack on each other when
				the screen is less than 576px wide.</p>
			<p>Resize the browserwindow to see the effect. Responsive web
				design has become more important as the amount of mobile traffic now
				accounts for more than half of total internet traffic.</p>
			<p>It can also display the web page differently depending on the
				screen size or viewing device.</p>
				<br>
				<a href="#" class="btn btn-primary">Learn More</a>
		</div>
		<div class="col-lg-6">
			<img src="img/desk.png" class="img-fluid">
		</div>
	</div>
</div>

<hr class="my-4">


<!--- Meet the team -->
<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Meet the Team </h1>
		</div>
	</div>
</div>

<!--- Cards -->
@php
    $teamMembers = $sections['team']->content['members'] ?? [];
@endphp

<div class="container-fluid padding" data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<div class="row padding">
        @if(count($teamMembers) >= 3)
            @foreach($teamMembers as $index => $member)
                @if($index < 3) {{-- Show only first 3 team members --}}
                <div class="col-md-4">
                    <div class="card">
                        @if(!empty($member['image']))
                            <img class="card-img-top" src="{{ Storage::url($member['image']) }}">
                        @else
                            @if($index == 0)
                                <img class="card-img-top" src="img/team1.png">
                            @elseif($index == 1)
                                <img class="card-img-top" src="img/team2.png">
                            @else
                                <img class="card-img-top" src="img/team3.png">
                            @endif
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">{{ $member['name'] ?? ($index == 0 ? 'John Doe' : ($index == 1 ? 'Mary Jo' : 'Phil Ho')) }}</h4>
                            <p class="card-text">
                                {!! $member['description'] ?? ($index == 0 ? 'John is an Internet entrepreneur with almost 20 years of experience.' : ($index == 1 ? 'Mary is a designer with almost 10 years of digital design experience.' : 'Phil is a developer with over 5 years of web development experience.')) !!}
                            </p>
                            <a href="#" class="btn btn-outline-secondary">See Profile</a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @else
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="img/team1.png">
                    <div class="card-body">
                        <h4 class="card-title">John Doe</h4>
                        <p class="card-text">John is an Interent entrepreneur with almost 20 years of experience.</p>
                        <a href="#" class="btn btn-outline-secondary">See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="img/team2.png">
                    <div class="card-body">
                        <h4 class="card-title">Mary Jo</h4>
                        <p class="card-text">Mary is a designer with a almost 10 years of digital design experience.</p>
                        <a href="#" class="btn btn-outline-secondary">See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="img/team3.png">
                    <div class="card-body">
                        <h4 class="card-title">Phil Ho</h4>
                        <p class="card-text">Phil is an developer with over 5 years of web development experience.</p>
                        <a href="#" class="btn btn-outline-secondary">See Profile</a>
                    </div>
                </div>
            </div>
        @endif
	</div>
</div>

<!--- Two Column Section -->
@php
    $philosophy = $sections['philosophy'] ?? null;
@endphp

<div class="container-fluid padding" data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<div class="row padding">
		<div class="col-md-12 col-lg-6">
			<h2>Our Philosophy</h2>
            @if($philosophy && !empty($philosophy->content['description']))
                {!! $philosophy->content['description'] !!}
            @else
                <p>We know that greatness in a disruptive era requires bold ambition, curious talent and a culture that believes we're smarter together.</p>
                <p>We approach every challenge hostically, with best-in-class expertise in data, creativity, media, technology, search, social and more. We call this Alchemy. It has the power to build our clients' brands and transform their business. And white it may seem like magic, we've got it down to a science.</p>
            @endif
		</div>
		<div class="col-lg-6">
            @if($philosophy && !empty($philosophy->images['main_image']))
                <img src="{{ Storage::url($philosophy->images['main_image']) }}" class="img-fluid">
            @else
                <img src="img/bootstrap2.png" class="img-fluid">
            @endif
		</div>
	</div>
	<hr class="my-4">
</div>

<!--- Connect -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-12">
			<h2>Connect</h2>
		</div>
		<div class="col-12 social padding">
			<a href="#"><i class="fab fa-facebook"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-google-plus-g"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-youtube"></i></a>
		</div>
	</div>
</div>

<!--- Footer -->
<footer>
	<div class="container-fluid padding" data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
		<div class="row text-center">
			<div class="col-md-4 pt-0">
				<div class="footer-image">
				<img src="img/logo6.jpg"></div>
				<hr class="light">
				<p>555-555-5555</p>
				<p>email@hhemail.com</p>
				<p>69 Street Name</p>
				<p>City, State, 888</p>
			</div>
			<div class="col-md-4">
				<hr class="light">
				<h5>Our hours</h5>
				<hr class="light">
				<p>Monday: 9am - 5pm</p>
				<p>Saturday: 10am - 4pm</p>
				<p>Sunday: Closed</p>
			</div>
			<div class="col-md-4">
				<hr class="light">
				<h5>Service Area</h5>
				<hr class="light">
				<p>City, State, 900</p>
				<p>City, State, 800</p>
				<p>City, State, 700</p>
				<p>City, State, 600</p>
			</div>
			<div class="col-12">
				<hr class="light-100">
				<h5>&copy; Website Learning </h5>
			</div>
		</div>
	</div>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
AOS.init();
</script>

</body>
</html>