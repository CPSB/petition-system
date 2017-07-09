@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-plus" aria-hidden="true"></span> Koppel een mail adres aan de petitie.</div>

                <div class="panel-body">
                    <form action="" class="form-horizontal" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3">
                                Ontvanger email: <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-10">
                                <input class="form-control" name="email" placeholder="Email adres van de ontvanger.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-10">

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
