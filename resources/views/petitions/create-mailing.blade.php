@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Koppel een mail adres aan de petitie.</div>

                <div class="panel-body">
                    <form action="{{ route('petition.mail.store') }}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="petition_id" value="{{ $petitionId }}">

                        <div class="form-group">
                            <label class="control-label col-md-3">
                                Ontvanger email: <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-9">
                                <input class="form-control" name="email" placeholder="Email adres van de ontvanger.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-success" type="submit">
                                    <span class="fa fa-check" aria-hidden="true"></span> Opslaan
                                </button>

                                <button class="btn btn-danger" type="reset">
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
