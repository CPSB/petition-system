@extends('layouts.app')

@section('title', ucfirst($petition->title))

@section('content')
    <div class="row">
        <div class="col-md-12"> {{-- Petition heading --}}
            <div class="jumbotron text-center">
                <h2>{{ $petition->title }}</h2>
                <p class="lead"> - {{ ucfirst($petition->author->name) }}</p>
            </div>
        </div> {{-- Petition heading --}}

        <div class="col-md-9"> {{-- Petition text --}}
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    @if (auth()->check() && auth()->user()->id == $petition->author_id)
                        <span class="pull-left">Opties:</span>

                        <form action="{{ route('signature.index') }}" method="GET" id="signatures">
                            <input type="hidden" name="petition" value="{{ $petition->id }}">
                        </form>

                        <div class="pull-right">
                            <a href="{{ route('petitions.edit', $petition) }}" class="btn btn-xs btn-default">
                                <span class="fa fa-pencil" aria-hidden="true"></span> Wijzig
                            </a>

                            <button form="signatures" class="btn btn-xs btn-default">
                                <span class="fa fa-bars" aria-hidden="true"></span> Handtekeningen
                            </button>

                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#petitionDelete">
                                <span class="fa fa-trash" aria-hidden="true"></span> Verwijder
                            </button>
                        </div>
                    @else
                        <span class="pull-right">Handtekeningen:
                            <strong>{{ $petition->signatures()->count() }} / {{ $petition->total_signatures }}</strong>
                        </span>
                    @endif
                </div>

                <div class="panel-body">
                    {!! $petition->text !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <a target="_blank" href="{{ $share['twitter'] }}" class="btn btn-block btn-social btn-twitter">
                        <span class="fa fa-twitter"></span> Deel op Twitter
                    </a>
                </div>
                <div class="col-md-4">
                    <a target="_blank" href="{{ $share['facebook'] }}" class="btn btn-block btn-social btn-facebook">
                        <span class="fa fa-twitter"></span> Deel op Facebook
                    </a>
                </div>
                <div class="col-md-4">
                    <a target="_blank" href="{{ $share['gplus'] }}" class="btn btn-block btn-social btn-google">
                        <span class="fa fa-google"></span> Deel op Google+
                    </a>
                </div>
            </div>
        </div> {{-- //Petition text --}}

        <div class="col-md-3"> {{-- Sidebar (Signature) --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Ondersteun deze petitie:
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="sign" method="POST" action="{{ route('signature.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="petition" value="{{ $petition->id }}">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input class="form-control input-sm" placeholder="Uw naam" value="{{ old('name') }}" name="name">
                                @if ($errors->has('name')) <small class="help-block">{{ ucfirst($errors->first('name')) }}</small> @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input class="form-control input-sm" value="{{ old('email') }}" placeholder="Uw email adres" name="email">
                                @if ($errors->has('email')) <small class="help-block">{{ ucfirst($errors->first('email')) }}</small> @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('postal_code') ? ' has-error' : '' }}">
                            <div class="col-md-4">
                                <input class="form-control input-sm" placeholder="Code" value="{{ old('postal_code') }}" name="postal_code">
                            </div>

                            <div class="col-md-8 {{ $errors->has('city') ? ' has-error' : '' }}">
                                <input class="form-control input-sm" placeholder="Woonplaats" value="{{ old('city') }}" name="city">
                            </div>

                            @if ($errors->has('postal_code') || $errors->has('city'))
                                <div class="col-md-12">
                                    @if ($errors->has('city'))          <small class="help-block"> {{ ucfirst($errors->first('city')) }}        </small> @endif
                                    @if ($errors->has('postal_code'))   <small class="help-block"> {{ ucfirst($errors->first('postal_code')) }} </small> @endif
                                </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <select class="input-sm form-control" name="country_id">
                                    <option value="">-- Selecteer uw land --</option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->long_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="checkbox" name="publish" value="N"> Teken anoniem
                            </div>
                        </div>
                    </form>
                </div>

                <div class="panel-footer">
                    <button class="btn btn-xs btn-success" form="sign" type="submit">
                        <span class="fa fa-pencil" aria-hidden="true"></span> Teken
                    </button>

                    <button class="btn btn-xs btn-danger" form="reset" type="reset">
                        <span class="fa fa-undo" aria-hidden="true"></span> Reset
                    </button>
                </div>
            </div>
        </div> {{-- Sidebar (Signature) --}}
    </div>

    @if (auth()->check() && auth()->user()->id == $petition->author_id)
        @include('petitions.alert.delete')
    @endif
@endsection
