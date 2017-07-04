@extends('layouts.app')

@section('title', 'handtekeningen')

@section('content')
    <div class="row">
        <div class="col-md-12"> {{-- Petition title --}}
            <div class="jumbotron text-center">
                <h2>{{ ucfirst($petition->title) }}</h2>
                <p class="lead">- {{ ucfirst($petition->author->name) }}</p>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix"> {{-- Panel heading --}}
                    <span class="fa fa-list" aria-hidden="true"></span> Handtekeningen:

                    @if ($petition->signatures()->count() > 0)
                        <div class="pull-right">
                            <a href="{{ route('export', ['type' => 'xls', 'id' => $petition->id]) }}" class="label label-success">Exporteer (XLS)</a>
                            {{-- <a href="{{ route('export', ['type' => 'pdf', 'id' => $petition->id]) }}" class="label label-success">Exporteer (PDF)</a> --}}
                        </div>
                    @endif
                </div> {{-- Panel heading --}}

                <div class="panel-body"> {{-- Panel body --}}
                    @if ($petition->signatures()->count() === 0) {{-- Er zijn geen handtekeningen gevonden. --}}
                        <div class="alert alert-info alert-important" role="alert">
                            <strong><span class="fa fa-info-circle" aria-hidden="true"></span></strong>
                            Er zijn nog geen handtekeningen voor deze petitie.
                        </div>
                    @else {{-- Er zijn hantekeningen gevonden --}}
                        <p class="lead">
                            @if ($petition->signatures()->count() === 1) {{-- Er is maar 1 steunbetuiging :( --}}
                                Er is 1 steunbetuiging.
                            @else {{-- Er zijn meerdere steunbetuigingen --}}
                                Er zijn {{ $petition->signatures()->count() }} steunbetuigingen.
                            @endif
                        </p>

                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Naam:</th>
                                    <th>Land:</th>
                                    <th>Stad:</th>
                                    <th>Getekend op:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $data = $petition->signatures()->paginate(35) @endphp

                                @foreach ($data as $signature) {{-- Loop through signatures. --}}
                                    <tr>
                                        <td><strong>#{{ $signature->id }}</strong></td>
                                        <td>{{ $signature->name }}</td>
                                        <td>
                                            <span class="flag-icon flag-icon-{{ strtolower($signature->country->short_name) }}"></span>
                                            {{ $signature->country->long_name }}
                                        </td>
                                        <td>{{ $signature->postal_code }} {{ ucfirst($signature->city) }}</td>
                                        <td>{{ $signature->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $data->render() }} {{-- pagination instance --}}
                    @endif

                </div> {{-- /Panel body --}}
            </div>
        </div>
    </div>
@endsection
