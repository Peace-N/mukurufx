@extends('mukurufx::layouts.app')

@section('content')

                <div class="row">
                    @if (session('error_message'))
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                {{ session('error_message') }}
                            </div>
                        </div>
                    @endif

                    @if (session('success_message'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        </div>
                    @endif

                    @if($errors->count() > 0)
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
       <div class="row col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">Purchase MukuruFX</div>
            <div class="panel-body">
                <div ng-app="mukuruFX">
                    <div ng-controller="mukuruCtrl" id="div1">
                        <div ng-bind-html="responsetext"></div>
                        <label for="fx-db-c">Choose Foreign Currency you wish to buy</label>
                        <select id="fx-db-c" class="form-control" ng-model="currency" ng-options="rate.currency_fx for rate in rates track by rate.exchange_rate" ></select>
                        <div class="form-group">
                            <label for="fx-Currency">Enter Amount of Forex you wish to buy</label>
                            <input type="number" id="fx-Currency" ng-model="forexBuy" class="form-control forexBuy" placeholder="Enter Amount of Forex you wish to buy" aria-label="Amount (to the nearest dollar)">
                        </div>
                        <button id="exchange" type="button" class="btn btn-success">View Totals</button>
                        <span class="label label-primary"><% currency.currency_fx %></span>
                        Exchange Rate:
                        <span class="label label-success"><% currency.exchange_rate %></span>
                        <hr>
                        <p>
                            <h5>Surchage Amount(ZAR)</h5>
                            <input type="text" style="display:none" ng-model="surchargeAmount" name="exchange_total" id="exchange_total" />
                            <input type="text" style="display:none" ng-model="surchargeAmountUF" name="exchange_total" id="exchange_total_nf" />

                            <input type="text" style="display:none" ng-model="surchargeTotal" name="exchange_total" id="sur_exchange_total" />
                            <input type="text" style="display:none" ng-model="surchargeTotalUF" name="exchange_total" id="sur_exchange_total_nf" />
                            {{--<strong><% currency.exchange_rate %></strong>--}}
                            <h4><% surchargeAmount %></h4>
                            <h3>Total with Surcharge (ZAR)</h3>
                            <h1 style="font-weight:bold"><% surchargeTotal %></h1>
                            <hr>
                        </p>
                        <button id="order" type="button" class="btn btn-primary btn-lg btn-block" ng-click="orderForex()">Order Foreign Currency</button>
                    </div>
                    </div>

                </div>
            </div>
        </div>
      </div>
                <script src="{{ url('/vendor/mukurufx/js/money.js') }}"></script>
                <script type="text/javascript">
                    //var money = fx.noConflict();
                    //var value = $('#fx-db-c').val();
                    $(document).ready(function() {
                        fx.base = 'ZAR';
                    });
                </script>

                <script>
                    $(document).ready(function(){
                        $('#fx-Currency').on('input', function() {

                            if($(this).val().length)
                                $('.forexFX').prop('disabled', true);
                            else
                                $('.forexFX').prop('disabled', false);
                        });

                        $('#exchange').click(function(){
                            fx.rates = {
//                                KES: $('#fx-db-c option').filter(function () { return $(this).html() == "KES"; }).val(),
                                KES: $("#fx-db-c option[label='KES']").val(),
                                EUR: $("#fx-db-c option[label='EUR']").val(),
                                USD: $("#fx-db-c option[label='USD']").val(),
                                GBP: $("#fx-db-c option[label='GBP']").val(),
                                ZAR: 1
                            };
                            alias = $('#fx-db-c :selected').attr('label');
                            fx.settings = { from: alias , to: "ZAR" };
                            var changetoZAR = fx.convert($('#fx-Currency').val());

                            if (alias == 'KES') {
                                var inputs = $('#exchange_total');
                                var totals = changetoZAR * 0.025;
                                inputs.val(accounting.formatMoney(totals, { symbol: "ZAR",  format: "%v" }));
                                inputs.trigger('input');
                                inputs.trigger('change');

                                var noformat = $('#exchange_total_nf');
                                noformat.val(accounting.unformat(totals));
                                noformat.trigger('input');
                                noformat.trigger('change');

                                var kes = $('#sur_exchange_total');
                                var total = changetoZAR * 0.025 + changetoZAR;
                                kes.val(accounting.formatMoney(total, { symbol: "ZAR",  format: "%v" }));
                                kes.trigger('input');
                                kes.trigger('change');

                                var noformat_nf = $('#sur_exchange_total_nf');
                                noformat_nf.val(accounting.unformat(total));
                                noformat_nf.trigger('input');
                                noformat_nf.trigger('change');
                            }

                            if (alias == 'EUR') {
                                var inputs = $('#exchange_total');
                                var totals = changetoZAR * 0.05;
                                inputs.val(accounting.formatMoney(totals, { symbol: "ZAR",  format: "%v" }));
                                inputs.trigger('input');
                                inputs.trigger('change');

                                var noformat = $('#exchange_total_nf');
                                noformat.val(accounting.unformat(totals));
                                noformat.trigger('input');
                                noformat.trigger('change');

                                var eur = $('#sur_exchange_total');
                                var total = changetoZAR * 0.05 + changetoZAR;
                                eur.val(accounting.formatMoney(total, { symbol: "ZAR",  format: "%v" }));
                                eur.trigger('input');
                                eur.trigger('change');

                                var noformat_nf = $('#sur_exchange_total_nf');
                                noformat_nf.val(accounting.unformat(total));
                                noformat_nf.trigger('input');
                                noformat_nf.trigger('change');
                            }

                            if (alias == 'USD') {
                                var inputs = $('#exchange_total');
                                var totals = changetoZAR * 0.075;
                                inputs.val(accounting.formatMoney(totals, { symbol: "ZAR",  format: "%v" }));
                                inputs.trigger('input');
                                inputs.trigger('change');

                                var noformat = $('#exchange_total_nf');
                                noformat.val(accounting.unformat(totals));
                                noformat.trigger('input');
                                noformat.trigger('change');

                                var usd = $('#sur_exchange_total');
                                var total = changetoZAR * 0.075 + changetoZAR;
                                usd.val(accounting.formatMoney(total, { symbol: "ZAR",  format: "%v" }));
                                usd.trigger('input');
                                usd.trigger('change');

                                var noformat_nf = $('#sur_exchange_total_nf');
                                noformat_nf.val(accounting.unformat(total));
                                noformat_nf.trigger('input');
                                noformat_nf.trigger('change');
                            }

                            if (alias == 'GBP') {
                                var inputs = $('#exchange_total');
                                var totals = changetoZAR * 0.05;
                                inputs.val(accounting.formatMoney(totals, { symbol: "ZAR",  format: "%v" }));
                                inputs.trigger('input');
                                inputs.trigger('change');

                                var noformat = $('#exchange_total_nf');
                                noformat.val(accounting.unformat(totals));
                                noformat.trigger('input');
                                noformat.trigger('change');

                                var usd = $('#sur_exchange_total');
                                var total = changetoZAR * 0.05 + changetoZAR;
                                usd.val(accounting.formatMoney(total, { symbol: "ZAR",  format: "%v" }));
                                usd.trigger('input');
                                usd.trigger('change');

                                var noformat_nf = $('#sur_exchange_total_nf');
                                noformat_nf.val(accounting.unformat(total));
                                noformat_nf.trigger('input');
                                noformat_nf.trigger('change');
                            }


                        });
                    });
                </script>
@endsection

@section('custom-scripts')

@endsection