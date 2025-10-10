<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-12">
                <div class="footer-logo">
                    <img src="{{ asset('asset/images/footer-logo.png') }}" class="img-fluid" alt="">
                    <ul>
                        <li>
                            <a href="{{ $facebook->flag_value }}" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $instagram->flag_value }}" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="quick-link">
                    <h5>Quick Links</h5>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('release_schedule') }}">Release Schedule</a>
                        </li>
                        <li>
                            <a href="{{ route('books') }}">Books</a>
                        </li>
                        <li>
                            <a href="{{ route('bonus_scenes') }}">Bonus Scenes</a>
                        </li>
                        <li>
                            <a href="{{ route('blog') }}">Blog</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="quick-link">
                    <h5>Newsletter</h5>
                    <div class="row">
                        <form action="{{ route('newsletterSubmit') }}" method="POST" id="newsletterFormFooter">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="newsletter_email" class="form-control" placeholder="Email">
                                <button type="submit" class="btn btn-black">
                                    Send
                                </button>
                            </div>
                        </form>
                        <div class="formLoader" style="display:none; text-align:center; margin-top:10px;">
                            <img src="{{ asset('asset/images/loader.gif') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-12">
                <div class="quick-link">
                    <div class="dmca-footer">
                        <img src="{{ asset('asset/images/dmca.webp') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copy-right">
    <p>Copyright © 2025, JS Kennedy. All rights reserved.</p>
</div>