@extends('templates.master')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="container">
            <form class="needs-validation" novalidate="" action="{{route('peyerCreditCard')}}" method="post">
                @csrf
                <hr class="mb-4">

                <h4 class="mb-3">Pagamento com Cielo</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" name="holder" class="form-control" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Full name as displayed on card</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" name="numberCard" class="form-control" id="cc-number" placeholder="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Flag Card</label>
                        <input type="text" name="flag" class="form-control" placeholder="" required="">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" name="date" class="form-control" id="cc-expiration" placeholder="" required="">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" name="cvv" class="form-control" id="cc-cvv" placeholder="" required="">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" id="" placeholder="" required="">
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Pagar agora</button>
            </form>
        </div>
    </div>
@endsection
