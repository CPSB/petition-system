@extends('layouts.app')

@section('title', 'Helpdesk')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-info-circle" aria-hidden="true"></span> Ik heb een nieuwe vraag:</div>

                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ route('helpdesk.index') }}">
                                <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/questions.svg') }}" alt="questions">
                            </a>
                        </div>
                        <div class="media-body">
                            {{-- <h4 class="media-heading">Vragen.</h4> --}}
                            <p>
                                Wij zijn altijd bereid je te helpen. Hiervoor kunt u hier uw vraag stellen. Maar veel antwoorden kunt u vinden in onze FAQ.<br>
                                We raden je aan om eerst eens rustig onze FAQ door te nemen. En als je het nodige antwoord niet hebt gevonden kunt u alsnog hier je vraag stellen.
                            </p>

                            <p>Als u een vraag stelt vragen wij u met de colgende regels rekening te houden.</p>

                            <ul class="list-unstyled">
                                <li><span class="text-danger">*</span> De helpdesk is geen pretpark.</li>
                                <li><span class="text-danger">*</span> Heropen geen vragen voor 'ok' of 'dank u'</li>
                                <li><span class="text-danger">*</span> We werken vrijwillig aan dit platform, dus blijf ten alle tijden vriendelijk.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Stel je vraag:</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('helpdesk.store') }}" method="post">
                        {{ csrf_field() }}                                                          {{-- CSRF protection field     --}}
                        <input type="hidden" name="author_id" value="{{ auth()->user()->id }}">     {{-- The authencated user id.  --}}
                        <input type="hidden" name="open" value="Y">                                 {{-- The open/closed indicator --}}

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-2">
                                Titel: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" value="{{ old('title') }}" name="title" placeholder="De titel van uw vraag.">

                                @if ($errors->has('title'))
                                    <small class="help-block">{{ ucfirst($errors->first('title')) }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-2">
                                Categorie: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-5">
                                <select class="form-control" name="category_id">
                                    <option value="">-- Selecteer je categorie: --</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block"><small>{{ ucfirst($errors->first('category')) }}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-2">
                                Vraag: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-6">
                                <textarea name="description" rows="8" class="form-control" placeholder="Beschrijf uw vraag"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block"><small>{{ ucfirst($errors->first('description')) }}</small></span>
                                @else
                                    <span class="help-block"><small>(Dit veld is markdown ondersteund)</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-2">
                                Publieke vraag: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-4">
                                <div class="radio">
                                    <label style="margin-right: 10px;"><input type="radio" name="publish" value="Y">Ja</label>
                                    <label><input type="radio" name="publish" value="N">Nee</label>
                                </div>

                                @if ($errors->has('publish'))
                                    <span class="help-block"><small>{{ ucfirst($errors->first('publish')) }}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-sm btn-success"><span class="fa fa-plus" aria-hidden="true"></span> Aanmaken</button>
                                <button type="reset" class="btn btn-sm btn-danger"><span class="fa fa-close" aria-hidden="true"></span> Reset</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
