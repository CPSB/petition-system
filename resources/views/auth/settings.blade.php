@extends('layouts.app')

@section('title', 'Acount configuratie' . $user->firstname)

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="list-group"> {{-- Sidebar content --}}
                <a data-toggle="tab" href="#info" class="list-group-item">
                    <span class="fa fa-info-circle" aria-hidden="true"></span> Account informatie
                </a>

                <a data-toggle="tab" href="#security" class="list-group-item">
                    <span class="fa fa-key" aria-hidden="true"></span> Account beveiliging
                </a>
            </div> {{-- /Sidebar content --}}

            <div class="list-group">
                <a href="" class="list-group-item list-group-item-danger">
                    <span class="fa fa-close" aria-hidden="true"></span> Verwijder account
                </a>
            </div>
        </div>

        <div class="col-md-9"> {{-- Content --}}
            <div class="tab-content"> {{-- Tab content --}}
                <div id="info" class="tab-pane fade in active">
                    @include('settings.info')
                </div>

                <div id="security" class="tab-pane fade in">
                    @include('settings.security')
                </div>
            </div> {{-- /Tab content --}}
        </div> {{-- /Content --}}
    </div>
@endsection
