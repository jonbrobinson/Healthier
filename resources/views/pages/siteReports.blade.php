@extends('layouts/app')

@section('content')
    <div class="container">
    @if(!empty($reports))
        @foreach($reports as $report)
            <div class="card">
                <div class="card-body">
                    @if($report->healthy)
                        <h5 class="card-title">{{ $report->getSite()->name }} <span class="badge badge-success">Healthy</span></h5>
                    @else
                        <h5 class="card-title">{{ $report->getSite()->name }} <span class="badge badge-danger">Not Healthy</span></h5>
                    @endif

                    <h6 class="card-subtitle mb-2 text-muted">{{ $report->getSite()->baseUrl }}</h6>
                    <p class="card-text">{{ $report->getSite()->description }}</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Method</th>
                            <th scope="col">Endpoint</th>
                            <th scope="col">Status Code</th>
                            <th scope="col">Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($report->urlStatuses as $urlStatus)
                            <tr class="{{ $urlStatus->code == 200 ? "table-success" : "table-danger" }}">
                            <td>{{ $urlStatus->method }}</td>
                            <td>{{ str_replace("//", "", $urlStatus->url) }}</td>
                            <td>{{ $urlStatus->code }}</td>
                            <td>{{ $urlStatus->code == 200 ? "Success":  $urlStatus->message }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <br><br>
        @endforeach
    @endif
    </div>

@endsection