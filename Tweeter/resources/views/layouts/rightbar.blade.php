<div class="col-md-3 d-flex  " >
    <div class="card flex-fill">
        <div class="card-header">
            <div class="form-group shadow-textarea">

                <form action="{{route('search')}}" method="get" class="navbar-nav ml-auto">
                    @csrf
                    <input type="text" name="search" class="form-control rounded-pill border border-primary m-1" placeholder="&#128269;      Search users...">
                    <button class="btn btn-primary rounded-pill m-1 "  type="submit">Go</button>

                </form>
            </div>
        </div>
        <div class="card-body"class="card-body">
            <h2 class="text-center">Trending Users</h2>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                                        @php
                                            $users = \App\User::simplePaginate(4);

                                            function checkFollowing($userToCheck, $users) {
                                            foreach ($users as $user) {
                                                if($user->followed == $userToCheck) {
                                                return true;
                                                }
                                            }
                                                return false;
                                            }


                                        @endphp
                                        @foreach ($users as $user)
                                        {{-- @php
                                            $profileImage = \App\User::find($allUser->id)->profile;
                                        @endphp --}}
                                            {{-- <div class="col-md-12"> --}}
                                                <div class="box-card">
                                                    <div class="card-footer">
                                                        <div class="profile-result">
                                                            {{-- <img class="img-fluid" src="{{asset('/storage/'.$profileImage->profile_pic)}}" style="border-radius:50%;height:100px;width:100px;" alt="Image"> --}}

                                                                <span>
                                                                    <a href="/profile/{{$user->id}}"><h4 class="card-title text-center" style="margin-bottom:0;"><b>{{$user->name}}</b></h4></a>
                                                                </span>
                                                                {{-- <hr> --}}
                                                                <br>
                                                                @if($user->id !== Auth::user()->id)
                                                                    @if (checkFollowing($user->id, Auth::user()->follow))
                                                                        {{-- <p>Already Following</p> --}}
                                                                    <form class="text-center" action="/unfollow/{{$user->id}}" method="post">
                                                                        @csrf
                                                                    <input type="hidden" name="user_id" value = "{{$user->id}}">
                                                                        <input class="btn btn-warning rounded-pill" type="submit" value="Unfollow">
                                                                    </form>
                                                                    @else
                                                                        <form class="text-center" action="/following/{{$user->id}}" method="post">
                                                                            @csrf
                                                                            <input class="btn btn-success rounded-pill"type="submit" value="Follow">
                                                                            <input type="hidden" name="followed" value = "{{$user->id}}">
                                                                        </form>
                                                                    @endif
                                                                @else
                                                                    <p class="text-center">Your Profile</p>
                                                                @endif

                                                            {{-- <div class="button-lg">
                                                                <a href="/profile/{{$user->id}}" class="btn btn-primary btn-block rounded-pill">Show Profile</a>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                        @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
