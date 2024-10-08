@php
   $dir= app()->getLocale()=='ar'?'rtl':'ltr';
@endphp
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/feather.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/quill.snow.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/app-light.css')}}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{asset('css/'.$dir.'/app-dark.css')}}" id="darkTheme">
       <link rel="stylesheet" href="{{asset('css/'.$dir.'/added.css')}}">

  </head>
  <script src="{{asset('jquery-3.7.1.js')}}"></script>

    <body class="vertical  dark {{$dir}} ">
          @if (session('message'))
    <div id="notification" class="notification">
        {{ session('message') }}
    </div>
      @endif
