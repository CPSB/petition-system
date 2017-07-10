<div class="panel panel-default">
    <div class="panel-heading">
        <span class="fa fa-users" aria-hidden="true"></span> Account informatie.
    </div>

    <div class="panel-body">
        <form action="{{ route('settings.info') }}" class="form-horizontal" method="post">
            {{ csrf_field() }}

            <fieldset>
                <legend>Persoonsgegevens:</legend>

                <div class="form-group">
                    <label class="control-label col-md-2">
                        Naam: <span class="text-danger">*</span>
                    </label>

                    <div class="col-md-5 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="first_name" value="{{ auth()->user()->first_name }}" placeholder="Voornaam">
                    </div>

                    <div class="col-md-5 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="last_name" value="{{ auth()->user()->last_name }}" placeholder="Achternaam">
                    </div>

                    @if ($errors->has('last_name') || $errors->has('first_name'))
                        <div class="col-md-offset-2 col-md-12">
                            @if ($errors->has('first_name')) <small class="text-danger"> {{ $errors->first('first_name') }} </small> <br/> @endif
                            @if ($errors->has('last_name'))  <small class="text-danger"> {{ $errors->first('last_name') }}  </small> @endif
                        </div>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">
                        E-mail: <span class="text-danger">*</span>
                    </label>

                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" value="" placeholder="Email adres">
                        @if ($errors->has('email')) <small class="text-danger"> {{ $errors->first('email') }} </small> @endif
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Woonplaats:</legend>

                <div class="form-group">
                    <label class="control-label col-md-2">
                        Woonplaats:
                    </label>

                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Postcode" value="{{ auth()->user()->postal_code }}" name="postal_code">
                    </div>

                    <div class="col-md-7">
                        <input type="text" class="form-control" placeholder="Uw stad" value="{{ auth()->user()->city }}" name="city">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">
                        Land:
                    </label>

                    <div class="col-md-10">
                        <select class="form-control" name="country">
                            <option value="">-- Selecteer je land van woonst --</option>

                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" @if ((int) auth()->user()->country === $country->id) selected @endif>
                                    {{ $country->long_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success">
                        <span class="fa fa-check" aria-hidden="true"></span> Aanpassen
                    </button>

                    <button type="reset" class="btn btn-danger">
                        <span class="fa fa-undo" aria-hidden="true"></span> Reset
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
