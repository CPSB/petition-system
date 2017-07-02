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
            <form action="{{ route('petitions.destroy', $petition) }}" method="POST" id="verwijder">{{ csrf_field() }} {{ method_field('DELETE') }}</form>

            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    @if (auth()->check() && auth()->user()->id == $petition->author_id)
                        <span class="pull-left">Opties:</span>

                        <div class="pull-right">
                            <a href="" class="btn btn-xs btn-default"><span class="fa fa-pencil" aria-hidden="true"></span> Wijzig</a>
                            <a href="" class="btn btn-xs btn-default"><span class="fa fa-bars" aria-hidden="true"></span> Handtekeningen</a>
                            <button form="verwijder" type="submit" class="btn btn-xs btn-danger">
                                <span class="fa fa-trash" aria-hidden="true"></span> Verwijder
                            </button>
                        </div>
                    @else
                        <span class="pull-right">Handtekeningen: <strong>0 / {{ $petition->total_signatures }}</strong></span>
                    @endif
                </div>

                <div class="panel-body">
                    {!! $petition->text !!}
                </div>
            </div>
        </div> {{-- //Petition text --}}

        <div class="col-md-3"> {{-- Sidebar (Signature) --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Ondersteun deze petitie:
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="sign" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="form-control input-sm" placeholder="Uw naam" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="form-control input-sm" placeholder="Uw email adres" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <input class="form-control input-sm" placeholder="Code" name="postal_code">
                            </div>

                            <div class="col-md-8">
                                <input class="form-control input-sm" placeholder="Woonplaats" name="city">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <select class="input-sm form-control" name="country_id">
                                    <option value="">-- Selecteer uw land --</option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->long_name }}</option>
                                    @endforeach
                                </select>
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
@endsection
