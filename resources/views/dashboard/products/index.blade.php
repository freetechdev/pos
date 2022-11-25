@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">{{ __('Add Product') }}</h4>
                        <a
                            href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#addProductModal"
                            style="float: right"
                            class="btn btn-success mb-2">
                            <i class="fa fa-plus"></i>
                                {{ __('Add New Product') }}
                        </a>
                        <div class="card-body">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Price [NPR]</th>
                                        <th>Quantity</th>
                                        <th>Quantity Alert</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $key=> $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{number_format($item->unit_price,2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            @if ($item->quantity <= $item->alert_stock)
                                                <span class="text-danger">{{ __('Stock Alert @') }}-[{{ $item->alert_stock }}]</span>
                                            @else
                                                <span class="text-success">{{ __('Stock Alert @') }}-[{{ $item->alert_stock }}]</span>
                                            @endif

                                        </td>
                                        <td>
                                            <a
                                                href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editProductModal{{ $item->id }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="fa fa-edit"></i>
                                                {{ __('Edit') }}
                                            </a>
                                            <a
                                                href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteProductModal{{ $item->id }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                                {{ __('Delete') }}
                                            </a>
                                        </td>
                                    </tr>
                                    <div
                                        class="modal right fade"
                                        id="editProductModal{{ $item->id }}"
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false"
                                        tabindex="-1"
                                        aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                        <form action="{{ route('products.update',$item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">{{ __('Edit Product') }}</h1>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nameLabel" class="form-label">
                                                            {{ __('Product Name') }}
                                                        </label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="name"
                                                            id="name"
                                                            placeholder="Enter Product Name"
                                                            value="{{ $item->name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="floatingTextarea">
                                                            {{ __('Product Description') }}
                                                        </label>
                                                        <textarea
                                                            class="form-control"
                                                            id="description"
                                                            name="description" rows="3">
                                                                {{ $item->description }}
                                                        </textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="emailLabel" class="form-label">
                                                            {{ __('Product Brand') }}
                                                        </label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="brand"
                                                            id="brand"
                                                            placeholder="Enter Brand Name"
                                                            value="{{ $item->brand }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phoneLabel" class="form-label">Product Unit Price</label>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            name="unit_price"
                                                            id="unit_price"
                                                            placeholder="Enter Product Price"
                                                            value="{{ $item->unit_price }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="passwordLabel" class="form-label">Product Quantity</label>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            name="quantity"
                                                            id="quantity"
                                                            placeholder="Enter Product Quantity"
                                                            value="{{ $item->quantity }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="passwordLabel" class="form-label">Stock Alert</label>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            name="alert_stock"
                                                            id="alert_stock"
                                                            placeholder="Enter Stock Quantity"
                                                            value="{{ $item->alert_stock }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button  class="btn btn-primary btn-block">
                                                        {{ ('EDIT Product') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    <div
                                        class="modal right fade"
                                        id="deleteProductModal{{ $item->id }}"
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false"
                                        tabindex="-1"
                                        aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                        <form action="{{ route('products.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">{{ __('Delete Product') }}</h1>
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
                                                        {{ ('DELETE Product') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                                {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Search Product</h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Window for Adding products Information-->
<div
    class="modal right fade"
    id="addProductModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ __('Add New Product') }}</h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nameLabel" class="form-label">Product Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        placeholder="Enter Product Name"
                        value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="emailLabel" class="form-label">Product Brand </label>
                    <input
                        type="text"
                        class="form-control"
                        name="brand"
                        id="brand"
                        placeholder="Enter Brand Name"
                        value="{{ old('brand') }}">
                </div>
                <div class="mb-3">
                    <label for="productDescription">Product Description</label>
                    <textarea
                        class="form-control"
                        id="description"
                        name="description" rows="3">
                        {{ old('description') }}
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="phoneLabel" class="form-label">Product Unit Price</label>
                    <input
                        type="number"
                        class="form-control"
                        name="unit_price"
                        id="unit_price"
                        placeholder="Enter Product Price"
                        value="{{ old('unit_price') }}">
                </div>
                <div class="mb-3">
                    <label for="passwordLabel" class="form-label">Product Quantity</label>
                    <input
                        type="number"
                        class="form-control"
                        name="quantity"
                        id="quantity"
                        placeholder="Enter Product Quantity"
                        value="{{ old('quantity') }}">
                </div>
                <div class="mb-3">
                    <label for="stockAlertLabel" class="form-label">Stock Alert</label>
                    <input
                        type="number"
                        class="form-control"
                        name="alert_stock"
                        id="alert_stock"
                        placeholder="Please Enter Product Quanity for Alert"
                        value="{{ old('alert_stock') }}">
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary btn-block">
                    {{ ('SAVE Product') }}
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
