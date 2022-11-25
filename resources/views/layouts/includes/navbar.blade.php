<a
    class="navbar-brand"
    href="{{ url('/') }}">
        <img src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo.svg"
            alt="Bootstrap"
            width="30"
            height="24">
</a>
<a
    href="#"
    data-bs-toggle="modal"
    data-bs-target="#staticBackdrop"
    class="btn btn-outline btn-sm ">
    <i class="fa fa-list"></i>
    Menu
</a>

<a
    href="{{ route('users.index') }}"
    class="btn btn-outline-success btn-sm ">
    <i class="fa fa-users"></i>
    {{ __('Users') }}
</a>

<a
    href="{{ route('products.index') }}"
    class="btn btn-outline-success btn-sm">
    <i class="fa fa-box"></i>
    {{ __('Products') }}
</a>

<a
    href="{{ route('orders.index') }}"
    class="btn btn-outline-success btn-sm">
    <i class="fa fa-desktop"></i>
    {{ __('Cashier') }}
</a>
<a
    href="#"
    class="btn btn-outline-success btn-sm">
    <i class="fa fa-file"></i>
    {{ __('Reports') }}
</a>
<a
    href="{{ route('transactions.index') }}"
    class="btn btn-outline-success btn-sm">
    <i class="fa fa-money-bill"></i>
    {{ __('Transactions') }}
</a>
<a
    href="#"
    class="btn btn-outline-success btn-sm">
    <i class="fa fa-industry"></i>
    {{ __('Suppliers') }}
</a>

<a
    href="#"
    class="btn btn-outline-success btn-sm">
    <i class="fa fa-users"></i>
    {{ __('Customers') }}
</a>


<style>

</style>
