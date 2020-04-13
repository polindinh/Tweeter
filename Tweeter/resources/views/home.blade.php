@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      @include('layouts.leftbar')

        <div class="col-md-6 d-flex ">
            <div class="card flex-fill">
                <div class="card-header">
                    <strong>Home</strong>
                </div>
                <div class="card-body">
                    @include('flashMessage')
                    @guest
                        <div class="row justify-content-center">
                            <p>You are not authorized to access this page. Please login or register</p>
                        </div>
                    @else
                        @php
                            function checkLike($tweetToCheck, $users){
                                foreach ($users as $user) {
                                    if($user->tweet_id == $tweetToCheck) {
                                    return true;
                                    }
                                }
                                    return false;
                            }
                        @endphp
                            <div class="form-group shadow-textarea">
                                <form action="/tweets/addTweet" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <input id="field" class="form-control form-control-lg rounded-pill border border-primary"  rows="4" cols="93" type="text" name="content" value="{{old('content')}}" placeholder="What's on your mind?" ></input>
                                    <input class="btn btn-primary rounded-pill border border-primary" type="submit" name="submit" value="Tweet" style="margin: 10px 0; float:right ">
                                </form>
                                <br>
                            </div>
                            @if($errors->any())
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="color:red">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h3>Recent Tweets</h3>
                            <hr>
                            @if (count($tweets)>0)
                                @foreach ($tweets as $tweet)
                                    @php
                                        $likeCount = count(\App\Tweet::find($tweet->id)->like);
                                        $commentCount = count(\App\Tweet::find($tweet->id)->comment);
                                        $profileImage = \App\User::find($tweet->user_id)->profile;
                                    @endphp
                                    @if ($tweet-> user_id == Auth::user()->id)
                                        <div class="row">
                                            <div class = "col-md-3">
                                                @isset($profileImage)
                                                    <a  class = "text-center" href="/profile/{{$tweet->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                                @endisset
                                                @empty( $profileImage)
                                                    <a class = "text-center" href="/profile/{{$tweet->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/profile_images/noimage.jpg/')}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                                @endempty
                                                <a  class = "text-center" href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet->user->name}}</strong></p></a>
                                            </div>
                                            <div class = "col-md-9">
                                                <p>{{substr($tweet-> content,0,150)}}</p>
                                                <p class = "time"><i>Posted: {{$tweet-> created_at->diffForHumans()}}</i></p>
                                                <p class = "time"><i>Updated: {{$tweet-> updated_at->diffForHumans()}}</i></p>
                                                @include('navbarUser')
                                                @if (checkLike($tweet->id, Auth::user()->like))
                                                    <form action="/unlike/{{$tweet->id}}" method="post">
                                                        @csrf
                                                    <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
                                                        <input class="btn btn-warning rounded-pill float-right" type="submit" value="Unlike" style="margin-right:10px;">
                                                    </form>
                                                    <br><br>
                                                @else
                                                    <form action="/like/{{$tweet->id}}" method="post">
                                                        @csrf
                                                        <input class="btn btn-success rounded-pill float-right"type="submit" value="Like" style="margin-right:10px;">
                                                        <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
                                                    </form>
                                                    <br><br>
                                                @endif
                                                <hr>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class = "col-md-3">
                                                @isset($profileImage)
                                                    <a class = "text-center" href="/profile/{{$tweet->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                                @endisset
                                                @empty($profileImage)
                                                    <a class = "text-center" href="/profile/{{$tweet->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/profile_images/noimage.jpg/')}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                                @endempty
                                                <a class = "text-center" href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                            </div>
                                            <div class = "col-md-9">
                                                <p>{{substr($tweet-> content,0,150)}}</p>
                                                <p class = "time"><i>Posted: {{$tweet-> created_at->diffForHumans()}}</i></p>
                                                <p class = "time"><i>Updated: {{$tweet-> updated_at->diffForHumans()}}</i></p>
                                                @include('navbarGuest')
                                                @if (checkLike($tweet->id, Auth::user()->like))
                                                    <form action="/unlike/{{$tweet->id}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
                                                        <input class="btn btn-warning rounded-pill float-right" type="submit" value="Unlike" style="margin-right:10px;">
                                                    </form>
                                                    <br><br>
                                                @else
                                                    <form action="/like/{{$tweet->id}}" method="post">
                                                        @csrf
                                                        <input class="btn btn-success rounded-pill float-right"type="submit" value="Like" style="margin-right:10px;">
                                                        <input type="hidden" name="user_id" value = "{{$tweet->user_id}}">
                                                    </form>
                                                <br><br>
                                                @endif
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p>No tweet found!</p>
                            @endif
                    @endguest
                    <br>
                    <div class="text-center">
                        {{ $tweets->links()}}
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.rightbar')
    </div>
</div>
@endsection






