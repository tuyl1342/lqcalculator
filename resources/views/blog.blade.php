@extends('layouts.app')

@section('title', 'Blog')

@section('content')
  <!-- Konten dari blog.html -->
  <div class="page-title">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Blog</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li class="current">Blog</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- Blog Posts Section -->
  <section id="blog-posts" class="blog-posts section">
    <div class="container">
      <div class="row gy-4">
        <!-- Daftar artikel blog -->
      </div>
    </div>
  </section>
  <!-- Blog Pagination Section -->
  <section id="blog-pagination" class="blog-pagination section">
    <div class="container">
      <div class="d-flex justify-content-center">
        <ul>
          <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
          <li><a href="#">1</a></li>
          <li><a href="#" class="active">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
        </ul>
      </div>
    </div>
  </section>
@endsection
