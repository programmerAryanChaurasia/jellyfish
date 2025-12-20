@php
    use App\Models\HomePageSection;
    $sections = HomePageSection::where('is_active', true)->orderBy('sort_order')->get();
@endphp

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
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            @php
                $logo = $sections->firstWhere('section_name', 'header');
            @endphp
            @if($logo && $logo->image)
                <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo">
            @else
                <img src="img/logo6.jpg" alt="Logo">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @foreach($sections->where('section_name', 'nav_item') as $navItem)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $navItem->button_link ?? '#' }}">
                        {{ $navItem->title ?? 'Link' }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

@foreach($sections as $section)
    @if($section->section_name == 'hero')
    <!-- Hero Section -->
    <div id="slides" class="carousel slide" data-ride="carousel" data-aos="fade-up"
            data-aos-offset="200"
            data-aos-delay="50"
            data-aos-duration="1000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                @if($section->image)
                    <img class="image" src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}">
                @else
                    <img class="image" src="img/background.png" alt="Background">
                @endif
                <div class="carousel-caption">
                    <h1 class="display-2">{{ $section->title ?? 'Website' }}</h1>
                    <h3>{{ $section->content ?? 'Complete Website Layout' }}</h3>
                    @if($section->button_text)
                        <button type="button" class="btn btn-outline-light btn-lg">
                            {{ $section->button_text }}
                        </button>
                    @endif
                    @if($section->button_link)
                        <a href="{{ $section->button_link }}" class="btn btn-primary btn-lg">Get Started</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($section->section_name == 'welcome')
    <!-- Welcome Section -->
    <div class="container-fluid padding" data-aos="fade-up"
            data-aos-offset="200"
            data-aos-delay="50"
            data-aos-duration="1000">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4">{{ $section->title ?? 'Built with ease.' }}</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">{{ $section->content ?? 'Welcome to my website tutorial!' }}</p>
            </div>
        </div>
    </div>
    @endif

    @if($section->section_name == 'services')
    <!-- Services Section -->
    <div class="container-fluid padding" data-aos="fade-up"
            data-aos-offset="200"
            data-aos-delay="50"
            data-aos-duration="1000">
        <div class="row text-center padding">
            <!-- You can create separate sections for each service -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <i class="fas fa-code"></i>
                <h3>HTML5</h3>
                <p>Built with the latest version of HTML, HTML5.</p>
            </div>
            <!-- ... other services ... -->
        </div>
        <hr class="my-4">
    </div>
    @endif
@endforeach

