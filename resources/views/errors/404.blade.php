@extends('layouts.errors')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><span class="fa fa-frown-o red" aria-hidden="true"></span> 404 Not found.
            <p class="lead">We couldn't find what you're looking for on <em><span id="display-domain"></span></em></p>
            <p>
                <a onclick="javascript:checkSite();" class="btn btn-default btn-lg">
                    <span class="green">Take me to the homepage</span>
                </a>
            </p>
        </div>
    </div>
    
    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happend?</h2>
                    <p class="lead">A 404 status error implies that the file or page you're looking for could not be found.</p>
                </div>
                <div class="col-md-6">
                    <h2>What can i do?</h2>
                    
                    <p class="lead">If you're a site visitor</p>
                    <p>
                        Please use your browser's back button and check that you're in the right place. 
                        If you need immediate assistance, please send us an email instead.
                    </p>

                    <p class="lead">If you're the site owner.</p>
                        Please check that you're in the right place and get in touch with your website provider 
                        if you believe this to be an error.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection