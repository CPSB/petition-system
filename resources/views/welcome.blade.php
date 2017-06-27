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
                        <div style="margin-left: -15px;" class="col-sm-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4><strong><a href="#">Test</a></strong></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <a href="#" class="thumbnail">
                                        <img src="http://placehold.it/260x180" alt="">
                                    </a>
                                </div>

                                <div class="col-md-9">
                                    <p>test</p>
                                    <p><a class="btn btn-sm btn-info" href="">Lees meer...</a></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="margin-top: -20px;">
                                    <p></p>

                                    <p>
                                        <i class="fa fa-user" aria-hidden="true"></i> Autheur: <a href="#">Jhon doe</a>
                                        | <i class="fa fa-calendar" aria-hidden="true"></i> 00:00:00
                                        | <i class="fa fa-comment" aria-hidden="true"></i> <a href="#">0 Reacties</a>
                                        | <i class="fa fa-tags" aria-hidden="true"></i> Tags:
                                        <span class="label label-primary">Geen</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else {{-- No petitions found --}}
                        <div class="alert alert-info alert-important" role="alert">
                            <strong>Info:</strong> Er zijn momenteel ngeen lopende petities.
                        </div>
                    @endif

                </div>
            </div>
        </div> {{-- /End content --}}

        <div class="col-md-3"> {{-- Sidebar --}}
            <div class="well well-sm"> {{-- search well --}}
                <form method="POST" action="">
                    <div class="input-group">
                        <input type="text" name="term" class="form-control" placeholder="Zoek bericht">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
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
                            <a href="">{{ $category->name }}</a>
                        @endforeach
                    @else {{-- No) categories found --}}
                        <small><i>(Er zijn geen categorieen gevonden.)</i></small>
                    @endif
                </div>
            </div> {{-- Categories --}}
        </div> {{-- /Sidebar --}}
    </div>
@endsection
