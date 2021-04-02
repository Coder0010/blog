<?php

namespace App\Domains\Auth\Http\Controllers\EndUser;

use DB;
use Session;
use Exception;
use App\Core\Abstracts\ResourceController;
use App\Domains\Auth\Http\Requests\EndUser\CommentRequest;

class EndUserAuthDomainController extends ResourceController
{
    protected $domainAlias = "auths";

    protected $nameSpace = "enduser";

    public function storeComment(CommentRequest $request)
    {
        try {
            $comment = auth()->user()->comments()->create([
                "commentable_id"   => request("blog_id"),
                "commentable_type" => "App\Domains\Setting\Entities\Blog",
                "message"          => request("message"),
            ]);
            return $this->userJsonResponse(
                "comment added sucessfully"
            );
        } catch (Exception $e) {
            return $this->userJsonResponse($e->getMessage());
        }
    }

    public function updateComment(CommentRequest $request)
    {
        try {
            $comment = auth()->user()->comments()->where("comments.id", request("id"))->update([
                "message"          => request("message"),
            ]);
            return $this->userJsonResponse(
                "comment updated sucessfully"
            );
        } catch (Exception $e) {
            return $this->userJsonResponse($e->getMessage());
        }
    }

    public function deleteComment(CommentRequest $request)
    {
        try {
            $comment = auth()->user()->comments()->where('comments.id', request("identifier"))->firstOrFail()->delete();
            return $this->userJsonResponse(
                "comment deleted sucessfully",
            );
        } catch (Exception $e) {
            return $this->userJsonResponse($e->getMessage());
        }
    }
}
