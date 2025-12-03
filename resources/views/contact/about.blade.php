@extends('layouts.app') <!-- uses default for navbar and footer -->

@section('content')
<div class="main-container">
    <!-- text -->
    <div class="text">
        <h1>About Us</h1>

        <h2>More about OmniCart</h2>
       <p>OmniCart consists of a small team of 7 Aston University Students studying Computer Science and Cyber Security.
                Our shared passion for innovative technology drives us to create an user-friendly, modern
              e-commerce website.</p>
              <p> Our site hosts a diverse range of categories to cater to many demographics, ensuring there's something for everyone.
                Whether you're looking for the latest tech or want brand new sports equipment, OmniCart makes it easy to find exactly what you need.
              </p>
              <p>At OmniCart, we are always listening to feedback and reviews so we can constantly update our selection of items
                to meet our customer's needs. We hope this is the start of something big and we're excited to have you with us on this journey.
              </p>

        <h2>Our Team</h2>
        <div class="team">
            <div class="member">
                <h3>Junaid Hussain</h3>
                <p>Backend Engineer</p>
            </div>
            <div class="member">
                <h3>Bader Almutairi</h3>
                <p>Frontend Engineer</p>
            </div>
            <div class="member">
                <h3>Adam Sandhu</h3>
                <p>Backend Engineer</p>
            </div>
            <div class="member">
                <h3>Olamide Odusote</h3>
                <p>Backend Engineer</p>
            </div>
            <div class="member">
                <h3>Yasin Wahid</h3>
                <p>Frontend Engineer</p>
            </div>
            <div class="member">
                <h3>Hamid Ahmed</h3>
                <p>Frontend Engineer</p>
            </div>
            <div class="member">
                <h3>Yuvraj Kular</h3>
                <p>Frontend Engineer</p>
            </div>
        </div>
    </div>

    <!-- image -->
    <div class="image">
        <img src="{{ asset('images/aboutusproductspic.png') }}" alt="Products Image">
    </div>
</div>
@endsection
