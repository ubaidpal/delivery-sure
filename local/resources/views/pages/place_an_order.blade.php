
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

<!-- Place An Order -->
<div class="place-an-order autoheight">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Place an order</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            <div class="place-an-order-group col-md-9">
                <ul class=" list-group">
                    <li class="list-group-item">
                        <div class="h3b">Your Order Information</div>
                        <form action="">
                            <div class="form-group">
                                <input type="text" placeholder="Enter your order title" class="form-control form-control-animate-border">
                            </div><!-- /.form-group animate-label -->
                            <div class="form-group">
                                <input type="text" placeholder="What driver needs to know?" class="form-control form-control-animate-border">
                            </div><!-- /.form-group animate-label -->

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control form-control-animate-border">
                                            <option></option>
                                            <option>1</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                    <div class="form-group dollar">
                                        <input type="text" placeholder="Estimated delivery fees" class="form-control form-control-animate-border">
                                    </div><!-- /.form-group animate-label -->
                                </div>
                            </div><!-- /.row -->
                        </form>
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="h3b">Create a list of items to be deliverd</div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" placeholder="Where you want your items to be delivered?" class="form-control form-control-animate-border">
                                </div><!-- /.form-group animate-label -->
                            </div><!-- col-md-8 -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-animate-border">
                                    <button type="button" class="btn toltip" data-toggle="tooltip" data-placement="top" title="Tooltip on bottom"></button>
                                </div><!-- /.form-group animate-label -->
                            </div><!-- col-md-3 -->
                            <div class="col-md-1 col-btn-del">
                                <a href="javascript:void(0);" class="btn btn-del">&times;</a>
                            </div>
                        </div><!-- row -->

                        <a href="javascript:void(0);" class="btn btn-link btn-link-add">+ Add New</a>
                    </li><!-- list-group-item -->

                    <li class="list-group-item">
                        <div class="h3b">Delivery location and time</div>

                        <div class="form-group">
                            <label class="animate-label">Where you want your items to be delivered?</label>
                            <input type="text" class="form-control form-control-animate-border">
                            <button type="button" class="btn toltip" data-toggle="tooltip" data-placement="top" title="Tooltip on bottom"></button>
                        </div><!-- /.form-group animate-label -->

                        <p>Place the pin using the address above</p>
                        <img src="{!! asset('local/public/assets/images/place-an-order.jpg') !!}" alt="image">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control form-control-animate-border">
                                        <option>Esitimated delivery fees</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control form-control-animate-border">
                                        <option>Esitimated delivery fees</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row -->

                        <div class="checkbox">
                            <label>
                                <input type="checkbox">Add a pick up point
                            </label>
                        </div><!-- /.checkbox -->

                    </li><!-- /.list-group-item -->
                </ul><!-- /.place-an-order-group .list-group -->


            </div><!-- /.col-md-9 -->

            <div class="list-group-green-header col-md-3 col-xs-6">
                <ul class=" list-group">
                    <li class="list-group-item active">Your Order Information</li><!-- /.list-group-item -->

                    <li class="list-group-item">List Item</li><!-- /.list-group-item -->

                    <li class="list-group-item">Delivery information</li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <p class="small">You will Pay</p>
                        <div class="h3">$ 0.00</div>
                    </li><!-- /.list-group-item -->

                </ul><!-- /.list-group-green-header -->

                <a class="btn btn-green btn-block" href="my_orders.blade.php">PLACE YOUR ORDER</a>
            </div><!-- /.list-group-green-header -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.place-an -->

@endsection

