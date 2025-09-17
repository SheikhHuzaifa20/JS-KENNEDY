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
                        {!! $page->content !!}
                        <form id="inquiryForm" action="{{ route('inquiry.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="fname" placeholder="First Name" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="lname" placeholder="Last Name" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="Phone" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="notes" rows="6" id="textarea" class="form-control" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button class="btn btn-form-btn" type="submit">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="responseMessage" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('js')
    <script>
        document.getElementById('inquiryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            fetch(form.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(async res => {
                    let data;
                    try {
                        data = await res.json(); // JSON parse karo
                    } catch {
                        throw new Error("Backend ne JSON ke bajaye HTML bheja hai");
                    }
                    return data;
                })
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!', // 👈 fixed text (ya data.title agar bhejna ho to)
                            text: data.message, // 👈 backend ka message show hoga
                            showConfirmButton: false,
                            timer: 1000
                        });
                        form.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: err.message
                    });
                });
        });
    </script>
@endsection
