@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header"><strong>Comment Tweet</strong></div>
                    <div class="card-body">
                        @include('flashMessage')
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
                        <div>
                            @php
                                $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                $profileImage = \App\User::find($tweets->user_id)->profile;
                            @endphp
                            @isset($profileImage)
                                <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="/storage/{{$profileImage->profile_pic}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                            @endisset
                            @empty($profileImage)
                                <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="/storage/profile_images/noimage.jpg" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                            @endempty
                            <a class = "text-center" href="/profile/{{$tweets->user->id}}"><p><strong>{{$tweets-> user->name}}</strong></p></a>
                            <p>{{$tweets-> content}}</p>
                            <div class="form-group shadow-textarea">
                                <form action="/commentPost/{{$tweets->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <input type="hidden" name="tweet_id" value={{$tweets->id}} >
                                    <textarea class="form-control z-depth-1 border border-primary"  rows="4" cols="93" type="text" name="content" placeholder="What are your thoughts?"></textarea>
                                    <input class="btn btn-primary rounded-pill" type="submit" name="submit"  style="margin: 15px 0; float:right">
                                </form>
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

                            @if ($tweets-> user_id == Auth::user()->id)
                                @php
                                    $likeCount = count(\App\Tweet::find($tweets->id)->like);

                                @endphp
                                @include('navbarsUser')
                                <br>

                                @if (checkLike($tweets->id, Auth::user()->like))
                            <form action="/unlike/{{$tweets->id}}" method="post">
                                @csrf
                            <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">
                                <input class="btn btn-warning rounded-pill" type="submit" value="Unlike">
                            </form>
                            @else
                                <form action="/like/{{$tweets->id}}" method="post">
                                    @csrf
                                    <input class="btn btn-success rounded-pill"type="submit" value="Like">
                                    <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">

                                </form>
                            @endif
                            @else
                                @php
                                    $likeCount = count(\App\Tweet::find($tweets->id)->like);

                                 @endphp
                                @include('navbarsGuest')
                                <br>

                                @if (checkLike($tweets->id, Auth::user()->like))
                            <form action="/unlike/{{$tweets->id}}" method="post">
                                @csrf
                            <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">
                                <input class="btn btn-warning rounded-pill" type="submit" value="Unlike">
                            </form>
                            @else
                                <form action="/like/{{$tweets->id}}" method="post">
                                    @csrf
                                    <input class="btn btn-success rounded-pill"type="submit" value="Like">
                                    <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">

                                </form>
                            @endif

                            @endif
                            <hr>
                            <hr>
                            <h3>Comments Section</h3>
                            <hr>
                                <hr>

                            @if (count($comments)>0)
                                @foreach ($comments as $comment)
                                    @if ($comment-> user_id == Auth::user()->id)
                                        <a href="/profile/{{$comment->user->id}}"><p><strong>{{$comment-> user->name}}</strong></p></a>
                                        <p>{{$comment-> content}}</p>
                                        <p><i>Commented on: {{$comment-> created_at}}</i></p>
                                        @include('navbarCommentUser')
                                        <br>
                                        <hr>
                                    @else
                                        <a href="/profile/{{$comment->user->id}}"><p><strong>{{$comment-> user->name}}</strong></p></a>
                                        <p>{{$comment-> content}}</p>
                                        <p><i>Commented on: {{$comment-> created_at}}</i></p>
                                        @include('navbarCommentGuest')
                                        <hr>
                                    @endif
                                @endforeach
                            @else
                                <br>
                                <h3>No Comments found!</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @include('layouts.rightbar')

    </div>
</div>

@endsection
