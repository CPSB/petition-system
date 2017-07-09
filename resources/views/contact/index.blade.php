@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-info-circle" aria-hidden="true"></span> {{ trans('contact.contact-panel-heading') }}
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['contact.store'], 'class' => 'form-horizontal' ]) !!}

                        <div class="form-group @if ($errors->has('first_name')) has-error @endif @if ($errors->has('last_name')) has-error @endif"> {{-- Name form group --}}
                            <div class="col-md-6"> {{-- First name input --}}
                                {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => trans('contact.placeholder-first-name')]) !!}
                                @if ($errors->has('first_name')) <p class="help-block">{{ ucfirst($errors->first('first_name')) }}</p> @endif
                            </div> {{-- /First name input --}}

                            <div class="col-md-6"> {{-- Last name input --}}
                                {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => trans('contact.placeholder-last-name')]) !!}
                                @if ($errors->has('last_name')) <p class="help-block">{{ ucfirst($errors->first('first_name')) }}</p> @endif
                            </div> {{-- /Last name input --}}
                        </div> {{-- /Name form group --}}

                        <div class="form-group @if ($errors->has('email')) has-error @endif"> {{-- Email form group --}}
                            <div class="col-md-12">
                                {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('contact.placeholder-email')]) !!}
                                @if ($errors->has('email')) <p class="help-block">{{ ucfirst($errors->first('email')) }}</p> @endif
                            </div>                            
                        </div> {{-- /Email contact form --}}

                        <div class="form-group @if ($errors->has('subject')) has-error @endif"> {{-- Subject form group --}}
                            <div class="col-md-12">
                                {!! Form::text('subject', old('subject'), ['class' => 'form-control', 'placeholder' => trans('contact.placeholder-subject')]) !!}
                                @if ($errors->has('subject')) <p class="help-block">{{ ucfirst($errors->first('subject')) }}</p> @endif
                            </div>
                        </div> {{-- /Subject form group --}}

                        <div class="form-group @if ($errors->has('message')) has-error @endif"> {{-- Message form-group --}}
                            <div class="col-md-12">
                                {!! Form::textarea('message', old('message'), ['class' => 'form-control', 'placeholder' => trans('contact.placeholder-message')]) !!}
                                @if ($errors->has('message')) <p class="help-block">{{ ucfirst($errors->first('message')) }}</p> @endif
                            </div>
                        </div> {{-- /Message form group --}}

                        {!! Form::button('<span class="fa fa-check" aria-hidden="true"></span> '. trans('contact.btn-send'), ['class' => 'btn btn-sm btn-success', 'type' => 'submit']) !!}
                        {!! Form::button('<span class="fa fa-undo" aria-hidden="true"></span> '. trans('contact.btn-reset'), ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection