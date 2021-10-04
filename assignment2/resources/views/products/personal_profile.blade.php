@extends('layouts.master2')

@section('title')
  User's profile
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">Your profile</h1>
  <h1> {{$user->name}} </h1>
  <p> Email: {{$user->email}} </p>
  <p> Here you can find a list of the people you have followed! </p>
@endsection

@section('content')

    <?php
    if (count($users) > 0) { ?>
      <p>You have followed these people: </p>
      @foreach ($users as $user)
        <p><a style="min-width: 500px" class="btn btn-outline-secondary" href='{{ url("user/$user->id") }}'>{{$user->name}}</a></p>
      @endforeach
    <?php } else { ?>
      <p> You haven't followed anyone </p>
    <?php } ?>

@endsection