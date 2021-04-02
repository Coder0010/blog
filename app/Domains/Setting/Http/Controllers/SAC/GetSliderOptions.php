<?php

namespace App\Domains\Setting\Http\Controllers\SAC;

use App\Core\Abstracts\ResourceController;
use Illuminate\Database\Eloquent\Collection;
use App\Domains\General\Entities\Categories\Category;

class GetSliderOptions extends ResourceController
{
    /**
     *
     * @return void
     */
    public function __invoke()
    {
        switch (request("id")) {
            case "products":
                $data = Product::active()->get();
                break;
            case "categories":
                $data = Category::active()->get();
                break;
            default:
                $data = new Collection();
                break;
        }
        return $this->userJsonResponse($data->map(function ($entity) {
            return [
                "id"   => $entity->id,
                "text" => $entity->name_val,
            ];
        }));
    }
}
