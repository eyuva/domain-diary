@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       DNS Lookup for: <b>{{$dns[0]['host']}} ({{$dns[0]['class']}})</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Type</th>
                                <th>Value</th>
                                <th>TTL</th>
                                <th>Priority</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dns as $record)
                                <tr>
                                    <th>{{$record['type']}}</th>
                                    {{--Value--}}
                                    @if(isset($record['ip']))
                                        <td>{{$record['ip']}}</td>
                                    @elseif(isset($record['txt']))
                                        <td>{{$record['txt']}}</td>
                                    @elseif(isset($record['target']))
                                        <td>{{$record['target']}}</td>
                                    @endif
                                    @if($record['type'] == 'SOA')
                                        <td>
                                            <b>mname</b> : {{$record['mname']}} <br>
                                            <b>rname</b> : {{$record['rname']}} <br>
                                            <b>serial</b> : {{$record['serial']}} <br>
                                            <b>refresh</b> : {{$record['refresh']}} <br>
                                            <b>retry</b> : {{$record['retry']}} <br>
                                            <b>expire</b> : {{$record['expire']}} <br>
                                            <b>minimum-ttl</b> : {{$record['minimum-ttl']}} <br>
                                        </td>
                                    @endif
                                    <td>{{$record['ttl']}}</td>
                                    <td>{{$record['pri'] or ''}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection