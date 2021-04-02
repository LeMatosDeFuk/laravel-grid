# Laravel grid

Live demo: [here](http://laravel-grid.herokuapp.com/)

This repository is a copy of https://github.com/leantony/laravel-grid/ with **LARAVEL 8 SUPPORT**

_So all credits goes to him._


# Install
`composer require lematosdefuk/laravel-grid`


I created this repository because it looks like it's no longer maintained.


# Added features

Translation - around 30% done -> PR are welcome.

Laravel 8 support

If you have order grid with Order - Invoice one to one relationship and you want to filter all orders by invoice name, u can add "relationship" parameter to filter.

So it's gonna look like:

            "invoiceName" => [
                "label"     => "Name",
                "presenter" => function ($columnData, $columnName) {
                    return $columnData->invoice->name;
                },
                "filter"    => [
                    "enabled"      => true,
                    "operator"     => "=",
                    "type"         => "select",
                    "relationship" => [
                        "modelQuery" => Invoice::query(),
                        "column"     => "name",
                        "key"        => "invoiceId"
                    ],
                    "data"         => Invoice::pluck('name', 'name'),
                ],
            ],
            
This example can be used in many more cases. Old solution was made only with validated column data, in my case I could filter only by InvoiceId key, so I couldn't sort by many parameters from invoice. For example I couldn't filter by Invoice name, Invoice address, ....
