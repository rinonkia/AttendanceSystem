@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">勤怠管理</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3 text-center">{{ Auth::user()->name }}</dt>
                        <dt class="col-sm-9 text-center">{{ Auth::user()->loginid }}</dt>
                    </dl>
                </div>
                <div class="user-content">
                    <div class="identity">
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->loginid }}</td>
                        </ol>
                    </div>
                    <div class="table-responsive">
                        <table class="table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>出勤</th>
                                    <th>退勤</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($timestamps)
                                    @foreach($timestamps as $timestamp)
                                        <tr>
                                            <td>{{ $timestamp->punchIn }}</td>
                                            <td>{{ $timestamp->punchOut }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>



@endsection