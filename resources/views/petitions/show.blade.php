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
                    @if ((int) auth()->user()->id === $petition->author_id)
                        <span class="pull-left">Opties:</span>

                        <div class="pull-right">
                            <a href="" class="btn btn-xs btn-default"><span class="fa fa-pencil" aria-hidden="true"></span> Wijzig</a>
                            <a href="" class="btn btn-xs btn-default"><span class="fa fa-bars" aria-hidden="true"></span> Handtekeningen</a>
                            <a href="{{ route('petitions.destroy', $petition) }}" class="btn btn-xs btn-danger">
                                <span class="fa fa-trash" aria-hidden="true"></span> Verwijder
                            </a>
                        </div>

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
                    <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="form-control input-sm" placeholder="Uw naam" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="form-control input-sm" placeholder="Uw ezmail adres" name="email">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> {{-- Sidebar (Signature) --}}
    </div>
@endsection
