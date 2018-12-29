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
                        <table class="table-striped table-boarder">
                            <tbody> <!-- 
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->loginid }}</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>



@endsection