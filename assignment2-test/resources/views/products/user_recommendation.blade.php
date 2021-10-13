@extends('layouts.master2')

@section('title')
    User recommendation
@endsection

@section('headline')
  <h1 class="display-4 fw-normal">User recommendation</h1>
  <p> Here you will find users that you might want to follow!</p>
@endsection

@section('content')

    <table style:>
        <tr bgcolor="#9966ff">
            <th>User</th>
            <th>Reason for recommendation</th>
        </tr>
        @foreach ($recommended_users_reason1 as $recommended_user_reason1)
            <tr>
                <td><a href = '{{ url("user/$recommended_user_reason1->id") }}'>{{$recommended_user_reason1->name}}</a></td>
                <td>Having highest number of likes</td>
            </tr>
        @endforeach

        @foreach ($recommended_users_reason2 as $recommended_user_reason2)
            <tr>
                <td><a href = '{{ url("user/$recommended_user_reason2->id") }}'>{{$recommended_user_reason2->name}}</a></td>
                <td>Wrote the most amount of reviews</td>
            </tr>
        @endforeach

        @foreach ($recommended_users_reason3 as $recommended_user_reason3)
            <tr>
                <td><a href = '{{ url("user/$recommended_user_reason3->id") }}'>{{$recommended_user_reason3->name}}</a></td>
                <td>Have the most followers</td>
            </tr>
        @endforeach
    </table>
@endsection