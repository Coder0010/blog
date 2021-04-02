<?php

namespace App\Domains\General\Http\Controllers\AdminPanel;

use App\Core\Abstracts\AdminResourceController;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;

class AdminPanelGeneralDomainController extends AdminResourceController
{
    public function __construct()
    {
        $this->domainAlias = "generals";

        $this->nameSpace = "adminpanel";
    }

    public function index()
    {
        $charts = [

        ];

        $cruds = [
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.categories.table",
                    "data"  => [
                        "data" => (new EloquentCategoryRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.categories._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.categories._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias"   => $this->domainAlias,
                        "nameSpace"     => $this->nameSpace,
                        "crudName" => "categories",
                    ]
                ],
            ], //categories
        ];
        return view("adminpanel.pages.domain.group", [
            "title"   => __("main.generals"),
            "charts"  => $charts,
            "cruds"   => $cruds,
        ]);
    }
}
