@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6 d-flex ">
            <div class="card flex-fill">
                <div class="card-header">
                    <strong>Profile</strong>
                </div>
                <div class="card-body">
                    @include('flashMessage')
                </div>
            </div>
        </div>
        @include('layouts.rightbar')

    </div>
</div>


@endsection




