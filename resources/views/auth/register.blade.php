@extends('layouts.app')

@section('specific_js_css_code')
    <!-- Se encarga de dar estilo a las tablas mediante el plugin Datatables -->
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                "pageLength": 3,
                "lengthMenu": [3, 10, 20, 50, 100],
                "responsive": true,
                "language": {
                    "sProcessing":     "{{__('Processing')}}...",
                    "sLengthMenu":     "{{ __('Showing') }} _MENU_",
                    "sZeroRecords":    "{{ __('No Results Found') }}",
                    "sEmptyTable":     "{{ __('No data available in this table') }}",
                    "sInfo":           "{{ __('Number of records') }}: _TOTAL_",
                    "sInfoEmpty":      "{{__('Number of records') }}: 0",
                    "sInfoFiltered":   "({{ __('Filtering a total of') }} _MAX_ {{ __('records') }})",
                    "sInfoPostFix":    "",
                    "sSearch":         "{{__('Search')}}:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "{{ __('Loading') }}...",
                    "oPaginate": {
                        "sFirst":    "{{ __('First') }}",
                        "sLast":     "{{ __('Last') }}",
                        "sNext":     "{{ __('Next') }}",
                        "sPrevious": "{{ __('Previous') }}"
                    },
                    "oAria": {
                        "sSortAscending":  ": {{ __('Activate to sort the column in ascending order') }}",
                        "sSortDescending": ": {{ __('Activate to sort the column in descending order') }}"
                    }
                },
            });
        } );
    </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="d-flex justify-content-center">
                    <img style="width: 135px; height: 135px" src="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/add_user.png">
                </div>
                <div class="card-body" id="formAddUser">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" minlength=8 type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" onkeyup="checkPasswordMatch();">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" minlength="8" type="password" class="form-control" name="password_confirmation"  required autocomplete="new-password" onkeyup="checkPasswordMatch();">
                                <small id="passwordError" class="text-danger" style="display: none">
                                    Las contraseñas no coinciden
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="role" id="role" required>
                                    <option value="user">{{ __('User') }}</option>
                                    <option value="admin">{{ __('Admin') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="addButton" type="submit" class="btn btn-primary" disabled>
                                    {{ __('Add User') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8" style="padding-top: 20px">
            <table id="miTabla" class="table table-striped" style="text-align: center">
                <thead style="background-color: #56c5c9;">
                    <tr>
                        <th>Id</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('E-Mail Address') }}</th>
                        <th> {{ __('Role') }} </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_datos">
                    @foreach($allUsers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('auth.userDetails', $user->id) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>

                                @if($user->role == 'admin')
                                   <td>{{ __('Admin') }}</td>
                                @else
                                   <td>{{ __('User') }}</td>
                                @endif()
                            <td>
                                <form method="POST" action="{{ route('auth.userDetails',$user->id) }}" style="display: inline;">
                                    @CSRF
                                    <input type="image" src="https://img.icons8.com/flat_round/64/000000/settings--v4.png" alt="Submit" width="25px" height="25px">
                                </form>
                                <form method="POST" action="{{route('auth.deleteUser', $user->id) }}" style="display: inline;">
                                    @CSRF @method('DELETE')
                                    <input type="image" src="https://img.icons8.com/flat_round/64/000000/delete-sign.png" alt="Submit" width="25px" height="25px">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
