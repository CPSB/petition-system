@extends('layouts.app')

@section('title', 'Nieuwe petitie')

@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Maak een nieuwe petitie.</div>
                <div class="panel-body"> {{-- Petition create box --}}
                    <form action="{{ route('petitions.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('title') || $errors->has('total_signatures') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">
                                Petitie titel: <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" {{ old('title') }} placeholder="Petitie titel" name="title">
                            </div>

                            <div class="col-md-3">
                                <input type="text" class="form-control" value="{{ old('total_signatures') }}" placeholder="Aantal handtekeningen" name="total_signatures">
                            </div>

                            <div class="col-md-offset-2 col-md-10">
                                @if ($errors->has('title') || $errors->has('total_signatures'))
                                    @if ($errors->has('title')) <small class="help-block"> {{ ucfirst($errors->first('title')) }} </small> @endif
                                    @if ($errors->has('total_signatures')) <small class="help-block"> {{ ucfirst($errors->first('total_signatures')) }} </small> @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">
                                Afbeelding: <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-10">
                                <input type="file" name="image" class="form-control">
                                @if ($errors->has('image')) <small class="help-block">{{ ucfirst($errors->first('image')) }}</small> @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('categories') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">
                                Categorieen: <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-10">
                                <input type="text" name="categories" value="{{ old('categories') }}" class="form-control" placeholder="Petitie categorieen">

                                @if ($errors->has('categories'))
                                    <small class="help-block"> {{ ucfirst($errors->first('categories')) }} </small>
                                @else
                                    <small class="help-block">* Categorieen kunnen gescheiden worden door een comma. bv: welzijn, politiek</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">
                                Petitie tekst: <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-10">
                                <textarea name="text" id="summernote">
                                    @if (! is_null(old('text'))) {{ old('text') }}
                                    @else <p><b>Zet hier je petitie tekst</b></p>
                                    @endif
                                </textarea>

                                @if ($errors->has('text')) <small class="help-block"> {{ ucfirst($errors->first('text')) }} </small> @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-check" aria-hidden="true"></span> Aanmaken
                                </button>

                                <button type="reset" class="btn btn-danger">
                                    <span class="fa fa-undo" aria-hidden="true"></span> Reset
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
