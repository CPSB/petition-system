@extends('layouts.app')

@section('title', 'Helpdesk admin')

@section('content')
    <div class="row">
        <div class="col-md-9"> {{-- Main content --}}
            <div class="panel panel-default">
                <div class="panel-body">
                    @if ($base->where('open', 'Y')->count() === 0)
                        <div class="alert alert-info alert-important" role="alert">
                            <strong><span class="fa fa-info-circle" aria-hidden="true"></span> Info:</strong>
                            Er zijn geen helpdesk tickets in het systeem. 
                        </div> 
                    @else 
                        @php($results = $base->with(['categories', 'author', 'comments'])->paginate(25))

                        <table class="table table-hover table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category:</th>
                                    <th>Reacties:</th>
                                    <th colspan="2">Title:</th> {{-- Colspan="2" needed for the options --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    @if ($result->open === 'N') {{-- Ticket is not closed. --}}
                                        <tr class="danger"> 
                                    @elseif($result->open === 'Y') {{-- Ticket is closed. --}}
                                        <tr class="success">
                                    @endif

                                         <td><code>#Q{{ $result->id }}</code></td>
                                         <td><span class="label label-info">{{ $result->categories->name }}</span></td>
                                         <td>{{ $result->comments()->count() }} reacties.</td>
                                         <td>{{ $result->title }}</td>

                                         <td class=""> {{-- Options --}}
                                            <a href="" class="btn btn-default btn-xs">
                                                <span class="fa fa-asterisk" aria-hidden="true"></span> Bekijk
                                            </a>

                                            @if ($result->open === 'N') {{-- Ticket is not open so we need to a function to re-open. --}}
                                                <a href="{{ route('helpdesk.status', $result) }}" class="btn btn-xs btn-default">
                                                    <span class="fa fa-check" aria-hidden="true"></span> Heropen
                                                </a>
                                            @elseif($result->open === 'Y') {{-- Tickit is open. So need a function to close it. --}}
                                                <a href="{{ route('helpdesk.status', $result) }}" class="btn btn-xs btn-default">
                                                    <span class="fa fa-close" aria-hidden="true"></span> Sluit
                                                </a>
                                            @endif
                                         </td> {{-- END Options --}}

                                    </tr> {{-- Formatted wrongly because the IF/ELSE statement. --}}

                                @endforeach
                            </tbody>
                        </table>

                        @if ($results->count() >= 25) {{-- There arez more then 25 roàws.  --}}
                            {{ $results->links() }}
                        @endif {{-- /End paginator check. --}}
                    @endif
                </div>
            </div>
        </div> {{-- END main content --}}
    
        <div class="col-md-3">
            <div class="well well-sm"> {{-- Search form --}}
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="term" class="form-control" placeholder="Zoek bericht">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div> {{-- end search form --}}
        </div>
    </div>
@endsection