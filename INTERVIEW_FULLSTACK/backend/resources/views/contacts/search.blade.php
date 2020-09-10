@extends('base')
@extends('layouts.app')
@section('main')
    <a href="{{route('contacts.index')}}" class="btn btn-primary">Назад</a>
    <div class="row">
        <div class="col-sm-12">
            <form action="contacts.search" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="By name">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-success">Search</button>
                    </span>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Имя - Фамилия</td>
                    <td>Почта</td>
                    <td>Должность</td>
                    <td>Компания</td>
                    <td>Возраст</td>
                    <td>Дата создания</td>
                    <td>Дата редактирования</td>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $contact)
                    <tr>
                        <td>{{$contact->id}}</td>
                        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                        <td>
                            <div class="form-group row" style="width: 390px">
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectEmail" name="email_selected" required focus>
                                        @foreach($contact->emails as $email)
                                            <option value="{{$email->email}}"><br>{{$email->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>{{$contact->job_title}}</td>
                        <td>{{$contact->company_name}}</td>
                        <td>{{$contact->age}}</td>
                        <td>{{$contact->created_at}}</td>
                        <td>{{$contact->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
