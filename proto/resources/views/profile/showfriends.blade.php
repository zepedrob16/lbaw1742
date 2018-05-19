@extends('layouts.app')

@section('content')

@foreach($info[1] as $friend)
	@if($friend->user1 === $info[0]->id)
		@foreach($info[2] as $check_user)
			@if($check_user->id === $friend->user2)
				<p><a href="/publicprofile/{{$check_user->id}}">{{$check_user->username}}</a></p>
			@endif
		@endforeach
	@else
		@foreach($info[2] as $check_user)
			@if($check_user->id === $friend->user1)
				<p><a href="#">{{$check_user->username}}</a></p>
			@endif
		@endforeach
	@endif
@endforeach

@endsection