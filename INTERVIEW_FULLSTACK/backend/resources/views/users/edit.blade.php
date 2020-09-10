@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Редактировать данные пользователя</h1>
            <form method="POST" action="{{ route('users.update',Auth::user()->id)}}" class="form">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <label for="name">Имя:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value={{ $user->name }} />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Почта:</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value={{ $user->email }} />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"/>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Подтвердите пароль:</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"/>
                </div>

                <button type="submit" class="btn btn-primary" {{redirect('contacts.index')}}>Редактировать</button>
                <a href="{{route('users.index')}}" class="btn btn-primary">Назад</a>
            </form>
        </div>
    </div>
@endsection
