@extends('layouts.userApp')
<?php use Illuminate\Support\Facades\Storage; ?>

@section('title', 'Online Shop Contact')

@section('content')

  {{-- <div class="shop-type">
    
    <div class="shop-type-column">
      <img class="shop-type-img" src="{{ Storage::url('websitePictures/food.jpg') }}">
    </div>

    <div class="shop-type-column">
      <img class="shop-type-img" src="{{ Storage::url('websitePictures/clothes.jpg') }}">
    </div>

    <div class="shop-type-column">
      <img class="shop-type-img" src="{{ Storage::url('websitePictures/electronics.jpg') }}">
    </div>
  </div> --}}

  <div class="description">
    <div class="description-content">

      <div class="content-row">
        <div class="content-text">
          <a class="content-text-button" href="{{ route('user.index') }}">Shop Food
            <i class="fa-solid fa-coins"></i>
          </a>
          <p> You can choose from all kinds off FOOD and to create
              your own recipe.
              You are just a touch away from a healthy and tasty food. 
              Order from more than 100 kinds of fruits or vegetables.
              Everythig just at the tips of you finger.
          </p>
        </div>
        <div class="content-image">
          {{-- <div class="dark-cover"></div> --}}
          <img id="imageDesc" src="{{ Storage::url('websitePictures/food.jpg') }}" alt="">
        </div>
      </div>

      <div class="content-row-reverse">
        <div class="content-text">
          <a class="content-text-button" href="{{ route('user.index') }}">Shop Clothes
            <i class="fa-solid fa-shirt"></i>
          </a>
          <p> Our purpose at Cents of Style is to empower women to lead bold and full lives. We believe that if you look good,
             you feel good. And when you feel good you can do good for others around you.
            Cents of Style brings you a wide range of trendy clothes
            all at affordable prices to make them accessible to you. 
          </p>
        </div>
        <div class="content-image">
          {{-- <div class="dark-cover"></div> --}}
          <img id="imageDesc" src="{{ Storage::url('websitePictures/clothes.jpg') }}" alt="">
        </div>
      </div>

      <div class="content-row">
        <div class="content-text">
          <a class="content-text-button" href="{{ route('user.index') }}">Shop Tech
            <i class="fa-solid fa-mobile-screen-button"></i>
          </a>
          <p> This shop will make sure you get what you order, 
            even if we talk about technology or that new phone you wanted to get 
            for so long.
            Here we got your back.
          </p>
        </div>
        <div class="content-image">
          {{-- <div class="dark-cover"></div> --}}
          <img id="imageDesc" src="{{ Storage::url('websitePictures/electronics.jpg') }}" alt="">
        </div>
      </div>

    </div>
  </div>

  
  @endsection