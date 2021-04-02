<?php

namespace App\Domains\Setting\Http\Controllers\AdminPanel;

use DB;
use Session;
use Exception;
use Illuminate\Http\Request;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\Setting\Repositories\Contracts\BlogRepository;
use App\Domains\Setting\Http\Requests\AdminPanel\AdminBlogsRequest;

class AdminBlogsController extends AdminResourceController
{
    /**
     * @param BlogRepository; $repository
     */
    public function __construct(BlogRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "settings";

        $this->crudName = "blogs";

        $this->resourceRequestValidation = AdminBlogsRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Blog",
            "create"  => "Create_Blog",
            "edit"    => "Edit_Blog",
            "delete"  => "Delete_Blog",
            "statu"   => "Statu_Blog",
        ];
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validation = new $this->resourceRequestValidation;
        $this->validate(request(), $validation->rules());
        DB::beginTransaction();
        try {
            $store = $this->repository->eloquentCreate([
                "name_en"        => request("blog_create_name_en"),
                "name_ar"        => request("blog_create_name_ar"),
                "category_id"    => request("blog_create_category_id"),
                "author_id"      => auth()->id(),
                "editor_id"      => auth()->id(),
                "data" => [
                    "description_en" => request("blog_create_description_en"),
                    "description_ar" => request("blog_create_description_ar"),
                ],
            ]);
            if ($store) {
                Session::flash("success", " [ ". (!is_array($store->name) && $store->name ? $store->name : $store->name_val) ." ] " . __("main.session_created_message"));
            } else {
                Session::flash("danger", __("main.session_falid_created_message"));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resourceValidation = new $this->resourceRequestValidation;
        $this->validate(request(), $resourceValidation->rules());
        DB::beginTransaction();
        try {
            $update = $this->repository->eloquentUpdate($id, [
                "name_en"        => request("blog_edit_name_en"),
                "name_ar"        => request("blog_edit_name_ar"),
                "category_id"    => request("blog_edit_category_id"),
                "editor_id"      => auth()->id(),
                "data" => [
                    "description_en" => request("blog_edit_description_en"),
                    "description_ar" => request("blog_edit_description_ar"),
                ]
            ]);
            Session::flash("success", " [ ". (!is_array($update->name) && $update->name ? $update->name : $update->name_val) ." ] " . __("main.session_updated_message"));
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }


}
