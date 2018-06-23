<?php include APPPATH.'views/auth/includes/header.php' ?>
<h1><a href="#"><?php echo $cart['data']['store']['store_name'] ?></a></h1>
<script src="<?php echo base_url("public/libs/angular.js"); ?>"></script>
<script src="<?php echo base_url("public/customer-app.js"); ?>"></script>
<br>
<div ng-app="cartify_customer" ng-controller="customer_controller">
    <script>
        var cart_products = <?php echo json_encode($cart['data']['products']) ?>;
        var all_countries = <?php echo json_encode($countries) ?>
    </script>
    <div class=" container" style="background-color: #fff !important; border: 2px solid #eee; border-radius: 3px; padding-top: 10px; padding-bottom: 10px;">
        <!-- <h3 class="row col-md-12">Checkout</h3>
        <div class="clearfix"></div><hr> -->
        <div class="col-sm-8" style="border-right: 1px solid #eee;">
            <big>Checkout</big>
            <div class="clearfix"></div><hr>
            <div ng-if="alreadyMember">
                <div class="col-xs-12" style="background:#f5f6f7; padding:5px; margin-bottom:10px; border-radius: 4px;">Customer information</div>
                <div class="form-group col-sm-6">
                    <label for="">Email Address *</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-sm-6">
                    <label for="">Phone No *</label>
                    <input type="text" class="form-control">
                </div>
                <div class="clearfix"></div><hr>
                <div class="col-xs-12" style="background:#f5f6f7; padding:5px; margin-bottom:10px; border-radius: 4px;">Shipping address</div>
    
                <div class="form-group col-sm-12">
                    <label for="">Name *</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-sm-12">
                    <label for="">Address *</label>
                    <textarea name="" id="" rows="4" class="form-control"></textarea>
                </div>
                <!-- <div class="clearfix"></div><hr> -->
                <div class="form-group col-sm-4">
                    <label for="">Country *</label>
                    <select name="" id="" class="form-control">
                        <option ng-repeat="c in countries" value="{{c.country_code}}">{{c.country_name}}</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">City *</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Postal Code *</label>
                    <input type="text" class="form-control">
                </div>
                <div class="clearfix"></div><hr>
                <div class="form-group col-sm-12">
                    <label for="later_account_use">
                        <input type="checkbox" name="later_account_use" ng-model="later_account_use" id="">    
                        Create an account for later use
                    </label>
                </div>
                <div ng-if="later_account_use">
                    <div class="form-group col-sm-6">
                        <label for="">Password *</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Retype Password *</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div><hr>
            </div>

            <div class="col-sm-6">
                <button class="btn btn-sm btn-default" ng-click="toggleAccount()" ng-if="alreadyMember">
                    Already have an account?
                </button>

                <button class="btn btn-sm btn-default" ng-click="toggleAccount()" ng-if="!alreadyMember">
                    Register new account
                </button>
            </div>
            <div class="col-sm-6">
                <button class="btn  btn-primary pull-right" disabled>CONTINUE TO CHECKOUT <i class="fa fa-arrow-right"></i></button>
            </div>
            <div class="clearfix"></div><br>
        </div>
        <div class="col-sm-4" ng-init="loadCart()">
            <big>Cart</big>
            <div class="clearfix"></div><hr>
            <table class="table">
                <tr ng-repeat="p in products">
                    <td>
                        <div class=" back-img img-thumbnail" style="background-image: url({{p.image_src}}); height: 60px; width:60px; padding:3px;"></div>
                    </td>
                    <td>
                        <p>
                            {{p.name}}
                            <br>
                            <small>{{p.sku}}</small>
                        </p>
                    </td>
                    <td>
                        <p>
                            <small>{{p.qty}} x {{p.sale_price|currency}}</small>
                            <br>
                            {{p.qty * p.sale_price|currency}}
                        </p>
                    </td>
                </tr>
            </table>
            <div class="clearfix"></div><hr>
            <div>
                <div class="col-xs-6"><strong>Subtotal</strong></div>
                <div class="col-xs-6"><span class="pull-right">{{cart.sub_total | currency}}</span></div>
            </div>
            <div>
                <div class="col-xs-6"><strong>Shipping</strong></div>
                <div class="col-xs-6"><span class="pull-right">{{cart.shipping | currency}}</span></div>
            </div>
            <div>
                <div class="col-xs-6"><strong>Tax</strong></div>
                <div class="col-xs-6"><span class="pull-right">{{cart.tax | currency}}</span></div>
            </div>
            <div>
                <div class="col-xs-6"><strong>Order Total</strong></div>
                <div class="col-xs-6"><span class="pull-right">{{cart.total | currency}}</span></div>
            </div>
            <div class="clearfix"></div><hr>
        </div>
        
    </div>
</div>

<?php include APPPATH.'views/auth/includes/footer.php' ?>
