<div class="col-md-3 d-flex ">
    <div class="card flex-fill">
        <div class="card-header">
            <strong>Your Profile</strong>
        </div>
        <div class="card-body" >
            @php
                $profileI = \App\User::find(Auth::user()->id)->profile;
                $followingCount = count(\App\Follow::where('user_id','=', Auth::user()->id)->get());
                $followersCount = count(\App\Follow::where('followed','=', Auth::user()->id)->get());
            @endphp
            @isset($profileI)
                <a href="/profile/{{Auth::user()->id}}"><img class="img-fluid rounded mx-auto d-block" src="/storage/{{$profileI->profile_pic}}" style="border-radius:50%;height:75px;width:75px;" alt="Image"></a>
                <br>
                <a href="/profile/{{Auth::user()->id}}"><h2 class = "text-center">{{Auth::user()->name}}</h2></a>
                <b>Gender :</b> {{$profileI->gender}} <br>
                <b>Date of Birth : </b>{{$profileI->date_of_birth}}<br>
                <b>Inspiring Quote : </b>{{$profileI->quote}}<br>
                <b>Member Since :</b> {{date("jS F, Y",strtotime($profileI->created_at))}}
                <hr>
                <div>
                    {{-- <h4 class="text-center" >Following ({{$followingCount}}) </h4>
                    <h4 class="text-center" >Followers ({{$followersCount}}) </h4> --}}

                    <a href="/follows/{{Auth::user()->id}}"><h4 class="text-center" style="color:#1DA1F2">Following ({{$followingCount}}) </h4></a>
                    <a href="/follows/{{Auth::user()->id}}"><h4 class="text-center" style="color:#1DA1F2">Followers ({{$followersCount}}) </h4></a>
                </div>
                <hr>
                <br>
                <ul>
                    <a href="/home"><h4><i class="fas fa-home"></i> Home</h4></a>
                    <br>
                    <a href="/profile/{{Auth::user()->id}}"><h4><i class="fas fa-address-card"></i> Your Profile</h4></a>
                    <br>
                    <a href="/users"><h4><i class="fas fa-users"></i> All Users</h4></a>
                </ul>

            @endisset
            @empty($profileI)

            <p>Oops! Looks like your profile is not set up yet. Please fill out the details below</p>
                <div>
                    <div class="card-body">
                        <form method="POST" action="/addProfile/{{Auth::user()->id}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="date_of_birth" class="col-md-12 col-form-label text-md-center">{{ __('Date of Birth') }}</label>

                                <div class="col-md-12">
                                    <input id="date_of_birth" type="text" class="form-control rounded-pill text-md-center @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus placeholder="YYYY-MM-DD">

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-12 col-form-label text-md-center">{{ __('Gender') }}</label>

                                <div class="col-md-12">
                                    <input id="gender" type="gender" class="form-control rounded-pill text-md-center @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" placeholder="Male/Female/Other">

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="quote" class="col-md-12 col-form-label text-md-center">{{ __('An Inspiring Quote') }}</label>

                                <div class="col-md-12">
                                    <input id="quote" type="quote" class="form-control rounded-pill text-md-center  @error('quote') is-invalid @enderror" name="quote" required autocomplete="quote" placeholder="Do one thing every day that scares you.">

                                    @error('quote')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profile_pic" class="col-md-12 col-form-label text-md-center">{{ __('Profile Image') }}</label>

                                <div class="col-md-12">
                                    <input id="profile_pic" type="file" class="form-control rounded-pill text-md-center" name="profile_pic" required autocomplete="profile_pic">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-md-center">
                                    <button type="submit" class="btn btn-primary rounded-pill">
                                        {{ __('Create Profile') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endempty

        </div>
    </div>
</div>
