@extends('layouts.default')

@section('content')
    <!-- Hero Start -->
    @include('sections.hero')
    <!-- Hero End -->

    <!-- Featurs Section Start -->
    @include('sections.features')
    <!-- Featurs Section End -->


    <!-- Fruits Shop Start-->
    @include('sections.fruits')
    <!-- Fruits Shop End-->


    <!-- Featurs with img Start -->
    @include('sections.features-i')
    <!-- Featurs with img End -->


    <!-- Vesitable Shop Start-->
    @include('sections.product-carousel')
    <!-- Vesitable Shop End -->


    <!-- Banner Section Start-->
    @include('sections.banner')
    <!-- Banner Section End -->


    <!-- Bestsaler Product Start -->
    @include('sections.bestseller')
    <!-- Bestsaler Product End -->


    <!-- Fact Start -->
    @include('sections.fact')
    <!-- Fact Start -->


    <!-- Tastimonial Start -->
    @include('sections.testimonials')
    <!-- Tastimonial End -->
@endsection