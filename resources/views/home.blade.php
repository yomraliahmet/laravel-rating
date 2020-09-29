@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ __('You are logged in!') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="row">
                            <input type="hidden" id="beforeChecked">
                            @foreach($users as $user)
                                <?php
                                    $checked1 = ""; $checked2 = ""; $checked3 = ""; $checked4 = ""; $checked5 = "";
                                    if(!is_null($user->rating)){
                                        if($user->rating->rate == 1) $checked1 = 'checked';
                                        if($user->rating->rate == 2) $checked2 = 'checked';
                                        if($user->rating->rate == 3) $checked3 = 'checked';
                                        if($user->rating->rate == 4) $checked4 = 'checked';
                                        if($user->rating->rate == 5) $checked5 = 'checked';
                                    }
                                ?>
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-center font-weight-bold">{{ $user->name ?? "" }}</h5>

                                            <div class="stars">
                                                <form action="">
                                                    <input {{  $checked5 }} data-user="{{ $user->id ?? "" }}" data-rate="5" class="star star-5" id="star-5-{{ $user->id ?? "" }}" type="radio" name="star"/>
                                                    <label class="star star-5" for="star-5-{{ $user->id ?? "" }}"></label>

                                                    <input {{ $checked4 }} data-user="{{ $user->id ?? "" }}" data-rate="4" class="star star-5" id="star-4-{{ $user->id ?? "" }}" type="radio" name="star"/>
                                                    <label class="star star-4" for="star-4-{{ $user->id ?? "" }}"></label>

                                                    <input {{ $checked3 }} data-user="{{ $user->id ?? "" }}" data-rate="3" class="star star-3" id="star-3-{{ $user->id ?? "" }}" type="radio" name="star"/>
                                                    <label class="star star-3" for="star-3-{{ $user->id ?? "" }}"></label>

                                                    <input {{ $checked2 }} data-user="{{ $user->id ?? "" }}" data-rate="2" class="star star-2" id="star-2-{{ $user->id ?? "" }}" type="radio" name="star"/>
                                                    <label class="star star-2" for="star-2-{{ $user->id ?? "" }}"></label>

                                                    <input {{ $checked1 }} data-user="{{ $user->id ?? "" }}" data-rate="1" class="star star-1" id="star-1-{{ $user->id ?? "" }}" type="radio" name="star"/>
                                                    <label class="star star-1" for="star-1-{{ $user->id ?? "" }}"></label>
                                                </form>
                                            </div>

                                            <div style="text-align: center;">
                                                <button class="btn btn-danger btn-clear" data-user="{{ $user->id ?? "" }}"><i class="fa fa-trash-o"></i> Clear</button>
                                            <br><br>
                                            <h5><b>Total:</b> <span class="totalRate-{{ $user->id ?? "" }}">{{ round($user->ratings->avg("rate")) ?? 0 }}</span> / 5</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
