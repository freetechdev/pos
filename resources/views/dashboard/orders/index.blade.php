@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-success mb-3">
                        <div class="card-header">
                            <h5 style="float: left;">{{ __('Ordered Products') }}</h5>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#addProductModal" style="float: right"
                                class="btn btn-success btn-sm mb-2">
                                <i class="fa fa-plus"></i>
                                {{ __('Add New Product') }}
                            </a>
                        </div>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Product Price</th>
                                            <th>Discount [%]</th>
                                            <th>Total</th>
                                            <th>
                                                <a href="#" class="btn btn-sm btn-success addMoreOrder">
                                                    <i class="fa fa-plus-circle"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="addMoreProductDisplay">
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <select class="form-control product_id" name="product_id[]" id="product_id">
                                                    <option value="">
                                                        {{ __('Select An Item') }}
                                                    </option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            data-price="{{ $product->unit_price }}">
                                                            {{ $product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" id="quantity"
                                                    class="form-control quantity ">
                                            </td>
                                            <td>
                                                <input type="number" name="unit_price[]" id="unit_price"
                                                    class="form-control unit_price">
                                            </td>
                                            <td>
                                                <input type="number" name="discount[]" id="discount"
                                                    class="form-control discount">
                                            </td>
                                            <td>
                                                <input type="number" name="amount[]" id="amount"
                                                    class="form-control amount">
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success mb-3">
                        <div class="card-header">
                            <h5 style="float: left">
                                {{ __('Amount [NPR]: ') }}
                                <b class="total text-danger"> 0.0</b>
                            </h5>
                            <a href="{{ route('transactions.index') }}" style="float: right"
                                class="btn btn-success btn-sm mb-2">
                                <i class="fa fa-eye"></i>
                                {{ __('View Transaction') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="panel">
                                <div class="row">
                                    <table table-striped>
                                        <tr>
                                            <td>
                                                <div class="group-control">
                                                    <label for="customerNameLabel">
                                                        {{ __('Customer Name') }}
                                                    </label>
                                                    <input type="text" name="customer_name" id="customer_name"
                                                        class="form-control">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="group-control">
                                                    <label for="customerPhoneLabel">
                                                        {{ __('Customer Phone') }}
                                                    </label>
                                                    <input type="text" name="customer_phone" id="customer_phone"
                                                        class="form-control">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <td>
                                        <span class="text-success">
                                            <b>{{ __('Payment Method') }}</b>
                                        </span>
                                        <div class="group-control">

                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true"
                                                value="cash" checked="checked">
                                            <label for="paymentMethodCash">
                                                <i class="fa fa-money-bill text-success"></i>
                                                {{ __('Cash') }}
                                            </label>
                                            <input type="radio" name="payment_method" id="payment_method" class="true"
                                                value="bank_transfer">
                                            <label for="paymentMethodBankTransfer">
                                                <i class="fa fa-university text-danger"></i>
                                                {{ __('Bank Transfer') }}
                                            </label>
                                            <input type="radio" name="payment_method" id="payment_method" class="true"
                                                value="credit_card">
                                            <label for="paymentMethodCreditCard">
                                                <i class="fa fa-credit-card text-info"></i>
                                                {{ __('Credit Card') }}<br />
                                            </label>
                                        </span>
                                        </div>
                                    </td><br/>
                                    <td>
                                        <span class="text-success">
                                            <b>{{ __('Payment Amount') }}</b>
                                        </span>
                                        <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                    </td><br/>
                                    <td>
                                        <span class="text-success">
                                            <b>{{ __('Return Amount') }}</b>
                                            <br />
                                        </span>
                                        <input type="number" name="balance" readonly="true" id="balance"
                                            class="form-control">
                                    </td>
                                    <td><br />
                                        <button class="btn btn-primary btn-lg btn-block mt-2">{{ __('SAVE') }}</button>
                                    </td>
                                    <td><br />
                                        <button
                                            class="btn btn-secondary btn-lg btn-block mt-2">{{ __('CALCULATOR') }}</button>
                                    </td>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
{{-- Print Modal --}}

<div class="modal right fade" id="printModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
         @include('dashboard.reports.invoice')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
@endsection
