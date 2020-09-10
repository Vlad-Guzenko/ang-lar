@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Имя</td>
                    <td>Почта</td>
                    {{--<td>Пароль</td>--}}
                    <td>Дата создания</td>
                    <td>Дата редактирования</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                        <a href="{{ route('users.edit')}}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
            </div>
            <div class="col-sm-12">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

