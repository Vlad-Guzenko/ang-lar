@extends('base')
@extends('layouts.app')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            {{--<h1 class="display-3">Emails</h1>--}}
            <table class="table table-striped">
                <tbody>
               {{-- <a href="{{route('contacts.email')}}" class="btn btn-primary">Emails: {{$countEmails}}</a>--}}
                <h1>К-во почтовых адресов: {{$countEmails}}</h1>
                </tbody>
            </table>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Имя</td>
                    <td>Почта</td>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                        <td>
                            @foreach($contact->emails as $email)
                                {{$email->email}}
                                <br>
                            @endforeach
                        </td>
                        {{--<td>
                            <div class="form-group row" style="width: 390px">
                                <div class="col-sm-8">
                                    <select class="form-control" id="selectEmail" name="email_selected" required focus>
                                        @foreach($contact->emails as $email)
                                            <option value="{{$email->email}}"><br>{{$email->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </td>--}}
                        <td>
                            <a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            {{--<form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <a href="{{ route('contacts.index')}}" class="btn btn-primary">Назад</a>
                <a href="{{--{{ route('some-router')}}--}}" class="btn btn-success">Заспамить</a>
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
