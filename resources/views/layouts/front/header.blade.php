<div class="top-banner-header">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-email">
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" id="newForm">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="newsletter_email" id="newemail" placeholder="Email"
                                            class="form-control" required>
                                        <button type="submit" class="btn btn-black email-btn">
                                            Subscribe
                                            <img src="{{ asset('asset/images/send.png') }}" class="img-fluid"
                                                alt="">
                                        </button>
                                    </div>
                                </form>

                                {{-- <div id="newsresult" style="margin-top:10px;"></div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('asset/images/logo.png') }}" class="img-fluid" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('release_schedule') }}"> Release Schedule</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books') }}">Books</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bonus_scenes') }}"> Bonus Scenes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                            <form class="d-flex side-top">
                                <a href="https://www.amazon.com/stores/JS-Kennedy/author/B095VMYZK1?ref=ap_rdr&isDramIntegrated=true&shoppingPortalEnabled=true"
                                    class="btn btn-black" href="#">
                                    Buy From Amazon
                                    <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt="">
                                </a>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</div>
