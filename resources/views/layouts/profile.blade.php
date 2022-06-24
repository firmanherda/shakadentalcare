<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="icon" type="image/jpg" href="{{asset("storage/Capture.JPG")}}"/>

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab - v4.3.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  @include('profile.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @include('profile.hero')
  <!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    @include('profile.main.why')
    <!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    @include('profile.main.about')
    <!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    @include('profile.main.statistic')
    <!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    @include('profile.main.services')
    <!-- End Services Section -->

    <!-- ======= Appointment Section ======= -->
    @include('profile.main.appointment')
    <!-- End Appointment Section -->

    <!-- ======= Departments Section ======= -->
    @include('profile.main.appointment')
    <!-- End Departments Section -->

    <!-- ======= Doctors Section ======= -->
    @include('profile.main.appointment')
    <!-- End Doctors Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    @include('profile.main.faq')
    <!-- End Frequently Asked Questions Section -->

    <!-- ======= Testimonials Section ======= -->
    @include('profile.main.testimonials')
    <!-- End Testimonials Section -->

    <!-- ======= Gallery Section ======= -->
    @include('profile.main.gallery')
    <!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    @include('profile.main.contact')
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('profile.footer')
  <!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/profile.js') }}"></script>

</body>

</html>
