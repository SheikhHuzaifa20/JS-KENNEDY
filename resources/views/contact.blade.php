@extends('layouts.app')
@section('title', 'Home')

@section('css')
@endsection

@section('content')


<section class="hm-banner inner-banners" id="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="main-book-sldier">
                    <div class="inner-banner-heading">
                        <h1>Contact</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="contact-form-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-form">
                    <p>Have a Question about the books? Want to just chat? Contact the author below.</p>
                    <form>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="" placeholder="First Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="" placeholder="Last Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="email" name="" placeholder="Email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="" placeholder="Phone" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="" rows="6" id="textarea" class="form-control" placeholder="Message"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-form-btn" type="submit">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')
@endsection