@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')
        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header"><strong>Confirm Delete</strong></div>
                    <div class="card-body">
                        @include('flashMessage')
                        <h3 class="text-center">Are you sure you want to delete your account</h3>
                        <br>
                        <form class="text-center" action="/deleteUser/{{Auth::user()->id}}" method="POST" >
                            @csrf
                            <input type="hidden" name="id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                            <input type="submit" value="Delete Account"  class="btn btn-bg btn-danger rounded-pill text-center">
                        </form>
                        <br>
                        <form class="text-center" action="/profile/{{Auth::user()->id}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                            <input type="submit" value="Go Back"  class="btn btn-bg btn-success rounded-pill text-center">
                        </form>
                    </div>
                </div>
            </div>
        @include('layouts.rightbar')
    </div>
</div>


@endsection
