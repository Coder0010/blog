<?php

namespace App\Domains\Setting\Http\Controllers\AdminPanel;

use App\Core\Abstracts\AdminResourceController;
use App\Domains\Setting\Repositories\Eloquent\EloquentBlogRepository;

class AdminPanelSettingDomainController extends AdminResourceController
{
    public function __construct()
    {
        $this->domainAlias = "settings";

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
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.blogs.table",
                    "data"  => [
                        "data" => (new EloquentBlogRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.blogs._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.blogs._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "blogs",
                    ]
                ],
            ], //blogs
        ];
        return view("adminpanel.pages.domain.group", [
            "title"   => __("main.settings"),
            "charts"  => $charts,
            "cruds"   => $cruds,
        ]);
    }
}
