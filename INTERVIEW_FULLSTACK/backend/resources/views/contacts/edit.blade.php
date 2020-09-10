@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Редактировать данные</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br/>
            @endif
            <form method="post" action="{{ route('contacts.update', $contact->id) }}">
                @method('PATCH')
                <div class="form-group">

                    <label for="first_name">Имя:</label>
                    <input type="text" class="form-control" name="first_name" value={{ $contact->first_name }} />
                </div>

                <div class="form-group">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" class="form-control" name="last_name" value={{ $contact->last_name }} />
                </div>

                <div class="form-group">
                    <label for="email">Почта:</label>
                    @foreach($contact->emails as $email)
                        <form action="{{ route('contacts.emDestroy', $email->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="text" class="form-control" name="email" value={{ $email->email }}>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="company_name">Компания:</label>
                    <input type="text" class="form-control" name="company_name" value={{ $contact->company_name }} />
                </div>
                <div class="form-group">
                    <label for="age">Возраст:</label>
                    <input type="text" class="form-control" name="age" value={{ $contact->age }} />
                </div>
                <div class="form-group">
                    <label for="job_title">Должность:</label>
                    <input type="text" class="form-control" name="job_title" value={{ $contact->job_title }} />
                </div>
                <button type="submit" class="btn btn-primary">Редактировать</button>
                <a href="{{route('contacts.index')}}" class="btn btn-primary">Назад</a>
            </form>
        </div>
    </div>
@endsection
