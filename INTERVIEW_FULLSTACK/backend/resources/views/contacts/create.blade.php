@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Create contact</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('contacts.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Имя:</label>
                        <input type="text" class="form-control" name="first_name"/>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Фамилия:</label>
                        <input type="text" class="form-control" name="last_name"/>
                    </div>

                    <div class="form-group">
                        <label for="email">Почта:</label>
                        <input type="text" id="newElementId" class="form-control" name="email"/>
                        <button type="button" value="Create Element" onclick="createNewElement()">Click</button>
                    </div>

                    <div class="form-group">
                        <label for="company_name">Компания:</label>
                        <input type="text" class="form-control" name="company_name"/>
                    </div>
                    <div class="form-group">
                        <label for="age">Возраст:</label>
                        <input type="text" class="form-control" name="age"/>
                    </div>
                    <div class="form-group">
                        <label for="job_title">Должность:</label>
                        <input type="text" class="form-control" name="job_title"/>
                    </div>
                    <button type="submit" class="btn btn-primary-outline">Добавить контакт</button>
                    <a href="{{route('contacts.index')}}" class="btn btn-primary">Назад</a>
                </form>
            </div>
        </div>
    </div>
    <script type="text/JavaScript">
        function createNewElement() {
            // First create a DIV element.
            var txtNewInputBox = document.createElement('div');

            // Then add the content (a new input box) of the element.
            txtNewInputBox.innerHTML = "<input type='text' id='newInputBox'>";

            // Finally put it where it is supposed to appear.
            document.getElementById("newElementId").appendChild(txtNewInputBox);
        }
    </script>
@endsection

