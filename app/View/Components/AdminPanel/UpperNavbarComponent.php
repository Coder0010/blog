<?php

namespace App\View\Components\AdminPanel;

use Illuminate\View\Component;

class UpperNavbarComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('adminpanel.components.upper-navbar-component', [
            "data" => $this->data()
        ]);
    }

    public function data()
    {
        return [
            [
                "type"   => "single-level-menu",
                "id"     => "auths-link",
                "title"  => "main.auths",
                "icon"   => "flaticon-user",
                "route"  => "admin.auths",
                "roles"  => "Super_Role",
            ],/* auths */
            [
                "type"   => "single-level-menu",
                "id"     => "generals-link",
                "title"  => "main.generals",
                "icon"   => "flaticon2-soft-icons",
                "route"  => "admin.generals",
                "roles"  => "Super_Role",
            ],/* generals */
            [
                "type"   => "single-level-menu",
                "id"     => "items-link",
                "title"  => "main.items",
                "icon"   => "flaticon2-plus-1",
                "route"  => "admin.items",
                "roles"  => "Super_Role",
            ],/* items */
            [
                "type"   => "single-level-menu",
                "id"     => "locations-link",
                "title"  => "main.locations",
                "icon"   => "flaticon-map-location",
                "route"  => "admin.locations",
                "roles"  => "Super_Role",
            ],/* locations */
            [
                "type"   => "single-level-menu",
                "id"     => "settings-link",
                "title"  => "main.settings",
                "icon"   => "flaticon-settings",
                "route"  => "admin.settings",
                "roles"  => "Super_Role",
            ],/* settings */
        ];
    }
}
