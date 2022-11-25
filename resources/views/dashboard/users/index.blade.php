@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">{{ __('Add User') }}</h4>
                        <a href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#addUserModal"
                            style="float: right"
                            class="btn btn-success mb-2">
                            <i class="fa fa-plus"></i>
                                {{ __('Add New User') }}
                        </a>
                        <div class="card-body">
                            <table class="table table-sm table-hover table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $key=> $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            @if ($item->is_admin==1)
                                                {{ __('Admin') }}
                                            @elseif ($item->is_admin==2)
                                                {{ __('Cashier') }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal{{ $item->id }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="fa fa-edit"></i>
                                                {{ __('Edit') }}
                                            </a>
                                            <a href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteUserModal{{ $item->id }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                                {{ __('Delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal right fade"
                                        id="editUserModal{{ $item->id }}"
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false"
                                        tabindex="-1"
                                        aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                        <form action="{{ route('users.update',$item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">{{ __('Edit User') }}</h1>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nameLabel" class="form-label">Full Name</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="name"
                                                                id="name"
                                                                placeholder="Enter Full Name"
                                                                value="{{ $item->name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="emailLabel" class="form-label">Email Address</label>
                                                            <input
                                                                type="email"
                                                                class="form-control"
                                                                name="email"
                                                                id="email"
                                                                placeholder="Enter Email Address"
                                                                value="{{ $item->email }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phoneLabel" class="form-label">Phone Number</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="phone"
                                                                id="phone"
                                                                placeholder="Enter Phone Number"
                                                                value="{{ $item->phone }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="passwordLabel" class="form-label">Password</label>
                                                            <input
                                                                type="password"
                                                                readonly="true"
                                                                class="form-control"
                                                                name="password"
                                                                id="password" placeholder="Enter Password" value="{{ $item->password }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for=roleLabel class="form-label">Select Role </label>
                                                            <select class="form-select" name="is_admin">
                                                                <option selected>{{ __('-- Choose User Role --') }}</option>
                                                                <option value="1" @if ($item->is_admin==1) selected @endif> {{ __('Admin') }} </option>
                                                                <option value="2" @if($item->is_admin==2) selected @endif> {{ __('Cashier') }} </option>
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button  class="btn btn-primary btn-block">
                                                        {{ ('EDIT USER') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    <div
                                        class="modal right fade"
                                        id="deleteUserModal{{ $item->id }}"
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false"
                                        tabindex="-1"
                                        aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                        <form action="{{ route('users.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">{{ __('Delete User') }}</h1>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete <span class="text-danger">{{ $item->name }}</span>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        {{ __('DISCARD DELETE') }}
                                                    </button>
                                                    <button type="submit"  class="btn btn-danger">
                                                        {{ ('DELETE USER') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Search User</h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Window for Adding Users Information-->
<div
    class="modal right fade"
    id="addUserModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ __('Add New User') }}</h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                    <div class="mb-3">
                        <label for="nameLabel" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name">
                    </div>
                    <div class="mb-3">
                        <label for="emailLabel" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address">
                    </div>
                    <div class="mb-3">
                        <label for="phoneLabel" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
                    </div>
                    <div class="mb-3">
                        <label for="passwordLabel" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPasswordLabel" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirm" id="password" placeholder="Enter Confirm Password">
                    </div>
                    <div class="mb-3">
                        <label for=roleLabel class="form-label">Select Role </label>
                        <select class="form-select" name="is_admin">
                            <option selected>{{ __('-- Choose User Role --') }}</option>
                            <option value="1">Admin</option>
                            <option value="2">Cashier</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary btn-block">
                    {{ ('SAVE USER') }}
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
