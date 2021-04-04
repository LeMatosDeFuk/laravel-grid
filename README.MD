# Laravel grid

[![Latest Stable Version](https://poser.pugx.org/lematosdefuk/laravel-grid/v/stable)](https://packagist.org/packages/lematosdefuk/laravel-grid)
[![Latest Unstable Version](https://poser.pugx.org/lematosdefuk/laravel-grid/v/unstable)](https://packagist.org/packages/lematosdefuk/laravel-grid)
[![Total Downloads](https://poser.pugx.org/lematosdefuk/laravel-grid/downloads)](https://packagist.org/packages/lematosdefuk/laravel-grid)

Live demo: [here](http://laravel-grid.herokuapp.com/)

This repository is a copy of https://github.com/leantony/laravel-grid/ with **LARAVEL 8 SUPPORT**

_So all credits goes to him._


# Install
`composer require lematosdefuk/laravel-grid`


I created this repository because it looks like it's no longer maintained.


# Added features

Translation - around 30% done -> PR are welcome.

Laravel 8 support

Custom sort query

            "columnName"          => [
                "filter"    => [...],
                "sort"      => [
                    "query" => function ($query, $sortBy, $sortDir) {
                        return $query->join() // do whatever you want
                                     ->select()
                                     ->orderBy();
                    }
                ]
            ],
