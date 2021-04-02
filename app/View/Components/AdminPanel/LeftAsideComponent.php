<?php

namespace App\View\Components\AdminPanel;

use Illuminate\View\Component;

class LeftAsideComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('adminpanel.components.left-aside-component', [
            "data" => $this->data()
        ]);
    }

    public function data()
    {
        return [
            [
                "type"   => "single-level-menu",
                "id"     => "website-link",
                "title"  => "main.website",
                "icon"   => "menu-icon flaticon-home",
                "route"  => "index",
                "target" => "_blank",
                "roles"  => "Super_Role||Manager_Role",
            ],/* View Website */
            [
                "type"  => "header-level-menu",
                "id"    => "settings",
                "title" => "main.settings",
            ],/* settings */
            [
                "type"        => "single-level-menu",
                "id"          => "settings-link",
                "title"       => "main.settings",
                "icon"        => "kt-menu__link-bullet--line",
                "route"       => "admin.settings.edit",
                "roles"       => "Super_Role||Manager_Role",
                "permissions" => "Edit_GeneralSetting||",
            ],
            [
                "type"        => "single-level-menu",
                "id"          => "blogs-link",
                "title"       => "main.blogs",
                "icon"        => "kt-menu__link-bullet--line",
                "route"       => "admin.blogs.index",
                "roles"       => "Super_Role||Manager_Role",
                "permissions" => "Create_Blog||Show_Blog||Edit_Blog||Delete_Blog||Statu_Blog",
            ],

            [
                "type"  => "header-level-menu",
                "id"    => "auths",
                "title" => "main.auths",
            ],/* auths */
            [
                "type"        => "single-level-menu",
                "id"          => "roles-link",
                "title"       => "main.roles",
                "icon"        => "kt-menu__link-bullet--line",
                "route"       => "admin.roles.index",
                "roles"       => "Super_Role||Manager_Role",
                "permissions" => "Create_Role||Show_Role||Edit_Role||Delete_Role",
            ],
            [
                "type"        => "single-level-menu",
                "id"          => "users-link",
                "title"       => "main.users",
                "icon"        => "kt-menu__link-bullet--line",
                "route"       => "admin.users.index",
                "roles"       => "Super_Role||Manager_Role",
                "permissions" => "Create_User||Show_User||Edit_User||Delete_User||Statu_User",
            ],

            [
                "type"  => "header-level-menu",
                "id"    => "generals",
                "title" => "main.generals",
            ],/* generals */
            [
                "type"        => "single-level-menu",
                "id"          => "categories-link",
                "title"       => "main.categories",
                "icon"        => "kt-menu__link-bullet--line",
                "route"       => "admin.categories.index",
                "roles"       => "Super_Role||Manager_Role",
                "permissions" => "Create_Category||Show_Category||Edit_Category||Delete_Category||Statu_Category"
            ],

        ];
    }
}
