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
                    <div class="table-responsive">
                        <table class="table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>LoginID</th>
                                    <th>名前</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><a href="{{ route('admin/user/show', $user->id) }}">{{ $user->loginid }}</a></td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $users->links() }}
            </div>
        </div>
        
    </div>


@endsection