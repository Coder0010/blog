<?php
    return [
        "version" => "v1.1.0",

        "default_password" => "12345678",

        "grouped_modules" => [
            "User",
            "Role",
            "Category",
            "Blog",
        ],

        "ungrouped_modules" => [
            "Edit_GeneralSetting",
        ],

        "permission_prefix" => [
            "Create",
            "Edit",
            "Show",
            "Statu",
            "Delete",
            // "Restore",
            // "Destory",
        ],

        "roles" => [
            "super"       => [ "id" => 1, "name" => "Super_Role",       "alias_name" => "Super_Role",       "guard_type" => "Super_Guard",       "status" => "active"],
            "manager"     => [ "id" => 2, "name" => "Manager_Role",     "alias_name" => "Manager_Role",     "guard_type" => "Manager_Guard",     "status" => "active"],
            "sub_manager" => [ "id" => 3, "name" => "Sub_Manager_Role", "alias_name" => "Sub_Manager_Role", "guard_type" => "Sub_Manager_Guard", "status" => "active"],
            "admin"       => [ "id" => 4, "name" => "Admin_Role",       "alias_name" => "Admin_Role",       "guard_type" => "Admin_Guard",       "status" => "active"],
            "normal"      => [ "id" => 5, "name" => "Normal_Role",      "alias_name" => "Normal_Role",      "guard_type" => "Normal_Guard",      "status" => "active"],
        ],

        "admin" => [
            "url_prefix"    => "admin",
            "url_alias"     => "admin.",
            "url_dashboard" => "admin/dashboard",
        ],

        "answers" => [
            "no" => "no",
            "yes" => "yes",
        ],

        "status" => [
            "active"       => "active",
            "pending"      => "pending",
            "waiting_list" => "waiting list",
            "deactivate"   => "deactivate",
        ],

        "developer" => [
            "id"        => "1",
            "name"      => "Mostafa.K.Masoud",
            "phone"     => "01122002864",
            "email"     => "mostafakamel000@gmail.com",
            "password"  => "15935755",
            "url"       => "https:www.linkedin.com/in/mostafakamel-93",
        ],

        "company" => [
            "id"        => "2",
            "name"      => "aqarmap",
            "phone"     => "012345678",
            "email"     => "aqarmap@yahoo.com",
            "password"  => "12345678",
            "url"       => "https://aqarmap.com.eg",
        ],

    ];
