@extends('base')
@extends('layouts.app')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Клиенты {{--{{$countClients}}--}}</h1>
            <table class="table table-striped">
                <tbody>
                <a href="{{--{{route('contacts.email')}}--}}" class="btn btn-primary">К-во адресов: {{--{{$countEmails}}--}}</a><br><br>
                <h1 href="{{--{{route('contacts.email')}}--}}" class="btn btn-dark">К-во
                    клиентов: {{--{{$countClients}}--}}</h1><br>
                </tbody>
            </table>
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
                @foreach($con as $contact)
                    <tr>
                        <td>{{$contact->id}}</td>
                        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                        <td>
                            <div class="form-group row" style="width: 200px">
                                <div class="col-sm-12">
                                    <select class="form-control" id="selectEmail" name="email_selected" required focus>
                                        {{--@foreach($contact->emails as $email)
                                        <option value="{{$email->email}}"><br>{{$email->email}}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>{{$contact->job_title}}</td>
                        <td>{{$contact->company_name}}</td>
                        <td>{{$contact->age}}</td>
                        <td>{{$contact->created_at}}</td>
                        <td>{{$contact->updated_at}}</td>
                        <td>
                            <a href="{{--{{ route('contacts.edit',$contact->id)}}--}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{--{{ route('contacts.destroy', $contact->id)}}--}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <a href="{{--{{ route('contacts.create')}}--}}" class="btn btn-primary">Новый клиент</a>
            </div>
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
    <script type="text/javascript">
        var mytextbox = document.getElementById('displayEmail');
        var mydropdown = document.getElementById('selectEmail');
        mydropdown.hover = function () {
            mytextbox.value = mytextbox.value + this.value; //to appened
            mytextbox.innerHTML = this.value;
        }
    </script>
@endsection

