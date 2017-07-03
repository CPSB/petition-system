@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <div class="row">
        <div class="col-md-9">  {{-- Content --}}
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header" style="margin-top: -20px;">
                        <h2 style="margin-bottom: -5px;">Activisme_BE - Petities</h2>
                    </div>

                    @if ((int) count($petitions) > 0) {{-- Petitions found --}}
                        @foreach ($petitions as $petition)
                            <div style="margin-left: -15px;" class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4><strong><a href="{{ route('petitions.show', $petition) }}">{{ $petition->title }}</a></strong></h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('petitions.show', $petition) }}" class="thumbnail">
                                            <img src="{{ asset($petition->image_path) }}" alt="{{ $petition->title }}">
                                        </a>
                                    </div>

                                    <div class="col-md-9">
                                        <p>{{ strip_tags($petition->text) }}</p>
                                        <p>
                                            <a class="btn btn-sm btn-info" href="{{ route('petitions.show', $petition) }}">
                                                <span class="fa fa-chevron-right" aria-hidden="true"></span> Lees meer
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px;">
                                        <p></p>

                                        <p>
                                            <i class="fa fa-user" aria-hidden="true"></i> Autheur: {{ $petition->author->name }}
                                            | <i class="fa fa-calendar" aria-hidden="true"></i> {{ $petition->created_at->format('d/m/Y') }}
                                            | <i class="fa fa-pencil" aria-hidden="true"></i> {{ $petition->signatures->count() }} handtekeningen
                                            | <i class="fa fa-tags" aria-hidden="true"></i> Tags:

                                            @if ($petition->categories()->count() > 0)
                                                @foreach($petition->categories as $category)
                                                    <span class="label label-danger">{{ $category->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="label label-primary">Geen</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else {{-- No petitions found --}}
                        <div class="alert alert-info alert-important" role="alert">
                            <strong>Info:</strong> Er zijn momenteel geen lopende petities.
                        </div>
                    @endif

                </div>
            </div>
        </div> {{-- /End content --}}

        <div class="col-md-3"> {{-- Sidebar --}}
            <div class="well well-sm"> {{-- search well --}}
                <form action="{{ route('petitions.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="term" class="form-control" placeholder="Zoek bericht">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div> {{-- /search well --}}

            <div class="panel panel-default"> {{-- Categories --}}
                <div class="panel-heading">
                    <span class="fa fa-tags" aria-hidden="true"></span> Categorieen:
                </div>

                <div class="panel-body">
                    @if ((int) count($categories) > 0) {{-- Categories found. --}}
                        @foreach ($categories as $category)
                            <a class="label label-danger" href="">{{ $category->name }}</a>
                        @endforeach
                    @else {{-- No) categories found --}}
                        <small><i>(Er zijn geen categorieen gevonden.)</i></small>
                    @endif
                </div>
            </div> {{-- Categories --}}
        </div> {{-- /Sidebar --}}
    </div>
@endsection
