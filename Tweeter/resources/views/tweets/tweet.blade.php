@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <strong>Tweet View</strong>
                </div>
                    <div class="card-body">
                        <div>
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

                            @if ($tweets-> user_id == Auth::user()->id)
                                @php
                                    $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                    $profileImage = \App\User::find($tweets->user_id)->profile;
                                @endphp
                                <div class="row">
                                    <div class = "col-md-2">
                                        @isset($profileImage)
                                            <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="/storage/{{$profileImage->profile_pic}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                        @endisset
                                        @empty($profileImage)
                                            <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="/storage/profile_images/noimage.jpg" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                        @endempty
                                        <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><p><strong>{{$tweets->user->name}}</strong></p></a>
                                    </div>
                                    <div class = "col-md-10">
                                        <p>{{$tweets-> content}}</p>
                                        <p class = "time"><i>Posted: {{$tweets-> created_at->diffForHumans()}}</i></p>
                                        <p class = "time"><i>Updated: {{$tweets-> updated_at->diffForHumans()}}</i></p>
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
                                    </div>
                                </div>
                                <hr>
                            @else
                                @php
                                    $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                    $profileImage = \App\User::find($tweets->user_id)->profile;
                                @endphp
                                <div class="row">
                                    <div class = "col-md-2">
                                        @isset($profileImage)
                                        <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                        @endisset
                                        @empty($profileImage)
                                        <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><img class="img-fluid rounded mx-auto d-block" src="{{asset('/storage/profile_images/noimage.jpg/')}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a><br>
                                        @endempty
                                        <a  class = "text-center" href="/profile/{{$tweets->user->id}}"><p><strong>{{$tweets->user->name}}</strong></p></a>
                                    </div>
                                    <div class = "col-md-10">
                                        <p>{{$tweets-> content}}</p>
                                        <p class = "time"><i>Posted: {{$tweets-> created_at->diffForHumans()}}</i></p>
                                        <p class = "time"><i>Updated: {{$tweets-> updated_at->diffForHumans()}}</i></p>
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
                                    </div>
                                </div>
                                <hr>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @include('layouts.rightbar')
    </div>
</div>
@endsection
