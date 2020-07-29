<div class="modal-body">

<form method="POST" action="{{ route('store') }}">
    @csrf

    {{--name--}}
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    {{--email--}}
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    {{--website--}}
    <div class="form-group row">
        <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

        <div class="col-md-6">
            <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" autofocus>

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    {{--logo--}}
    <div class="form-group row">
        <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

        <div class="col-md-6">
            <input id="logo" type="file" class="@error('logo') is-invalid @enderror" name="logo" autofocus>

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>


</div>