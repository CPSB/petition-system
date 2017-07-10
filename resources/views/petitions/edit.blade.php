@extends('layouts.app')

@section('title', 'Wijzig petitie')

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

                            <div class="col-md-10">
                                <input type="text" class="form-control" {{ old('title') }} placeholder="Petitie titel" name="title">
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
