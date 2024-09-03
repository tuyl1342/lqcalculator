@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <!-- Hero Section -->
  <section class="hero-section py-5">
    <div class="container text-center">
      <h1 class="display-3 mb-4">Welcome to My Website</h1>
      <p class="lead mb-5">Explore the features and make the most out of our services. We offer various tools and insights to help you achieve your goals.</p>
      <a href="{{ url('upload') }}" class="btn btn-primary btn-lg">Upload Your File</a>
    </div>
  </section>

  <!-- Breadcrumbs -->
  <section class="breadcrumbs-section py-3">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features-section py-5 bg-light">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="feature-box p-4 bg-white shadow-sm rounded">
            <i class="bi bi-graph-up display-4 mb-3"></i>
            <h3 class="h4 mb-3">Data Analysis</h3>
            <p>Gain insights from your data with powerful analytics tools and visualizations.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-box p-4 bg-white shadow-sm rounded">
            <i class="bi bi-file-earmark-spreadsheet display-4 mb-3"></i>
            <h3 class="h4 mb-3">File Upload</h3>
            <p>Upload and process your files seamlessly with our easy-to-use upload system.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-box p-4 bg-white shadow-sm rounded">
            <i class="bi bi-bar-chart display-4 mb-3"></i>
            <h3 class="h4 mb-3">Visual Reports</h3>
            <p>Create and view visual reports and charts to better understand your data.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials-section py-5">
    <div class="container">
      <h2 class="text-center mb-4">What Our Users Say</h2>
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="testimonial p-4 bg-light shadow-sm rounded">
            <p class="mb-3">"The data analysis tools are incredibly powerful and easy to use. I was able to gain valuable insights quickly!"</p>
            <footer class="blockquote-footer">Jane Doe, <cite title="Source Title">Business Analyst</cite></footer>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="testimonial p-4 bg-light shadow-sm rounded">
            <p class="mb-3">"Uploading and processing files has never been easier. The system is intuitive and reliable."</p>
            <footer class="blockquote-footer">John Smith, <cite title="Source Title">Data Scientist</cite></footer>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
