<?php

namespace App\Http\Controllers;

use App\MenuCategory;
use App\Repositories\Rest\RestRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuCategoryController extends Controller
{

    /**
     * @var RestRepository
     */
    private $rest;

    public function __construct(MenuCategory $model) {
        $this->rest = new RestRepository($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $response = $this->rest->getModel()
            ->with('hasManyProducts')
            ->get();

        return $this->response(
            "Menus Successfully Fetched.",
            $response,
            Response::HTTP_OK
        );
    }

    /**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse|Response
	 */
	public function show($id) {
		$response = $this->rest->getModel()
            ->with('hasManyProducts')
            ->first();

		return $this->response(
			"Menus Successfully Fetch.",
			$response,
			Response::HTTP_OK
		);
	}
}
