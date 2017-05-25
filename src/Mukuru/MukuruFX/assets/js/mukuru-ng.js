/**
 * Created by Peace Ngara on 5/22/2017.
 * Angular Mukuru FX Remitex Test Front End
 * This Implementation uses Angular for restful and Forms App
 */

var fxrates = angular.module('mukuruFX', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

fxrates.controller('mukuruCtrl', function($sce, $scope, $http) {
    $scope.rates = [];
    $scope.fxcollection = []
    $scope.loading = false;



    $scope.init = function () {
        $scope.loading = true;
        $http.get('/mukurufx/orders/latestfxrates').
            then(function (response) {
            if(response.data == null){
                response.data = $scope.defaultData
            }
            $scope.rates = response.data;
            $scope.loading = false;
            $scope.fxcollection = $scope.fxcollect($scope.rates);
            $scope.fxcollection = (angular.toJson($scope.fxcollection));

        });
    };

    $scope.orderForex = function () {
        var url = "/mukurufx/orders/new";
        $http.post(url, {order: angular.toJson($scope.populateFX())})
            .then(function (response) {
                $scope.html = '<p class="alert alert-success" style="margin-top:5px;">' +
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                    '<strong>Success:</strong>&nbsp;Your Order has been Processed !!</p>';
                $scope.responsetext = $sce.trustAsHtml($scope.html);
            }, function (response) {
                //Second function handles error
            });
    }

    $scope.fxcollect = function(rates) {
        var records = [];
        for(var index = 0; index < rates.length; index++){
            var item =
            {
                [rates[index].currency_fx] : rates[index].exchange_rate

            }
            records.push(item);
        }
        var baseRate = {ZAR: 1};
        records.push(baseRate);
        return records;
    }

    $scope.populateFX = function() {
        var collection = [];
        var menuItems = {
            currency_id: $scope.currency.id,
            fx_purchased: $scope.currency.currency_fx,
            fx_exchange_rate: $scope.currency.exchange_rate,
            fx_purchased_amount_cents: $scope.forexBuy,
            total_zar_cents: $scope.surchargeTotal,
            surcharge_amount_cents: $scope.surchargeAmount,
            surcharge_amount_decimal: $scope.surchargeAmountUF,
            total_zar_decimal: $scope.surchargeTotalUF
        };

        collection.push(menuItems);

        return collection;
    };

    // $scope.clickEvent = function (obj) {
    //
    //     console.log(obj);
    //     alert(obj.target.attributes.data.value)
    //
    // };

    $scope.orderList = "title";
    $scope.init();
});