<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Capsule;
use App\Services\CapsuleService;
use Illuminate\Http\Request;

class CapsuleController extends Controller
{
protected $capsule_service;
    public function __construct(CapsuleService $capsule_service)
    {
        $this->capsule_service = $capsule_service;
    }

    /**
     * @OA\Get(
     *      path="/capsules",
     *      operationId="getCapsules",
     *      tags={"Capsules"},
     *      summary="Get list of capsules",
     *      description="Returns list of capsules",
     *     @OA\Parameter(
     *          name="status",
     *          description="Capsule Current Status active|retired|unknown|etc",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function all_capsules(Request $request)
    {
        // For now we are accept only status for filtering
        return $this->capsule_service->get_capsules_by_filters($request->only('status'));
    }

    /**
     * @OA\Get(
     *      path="/capsules/{capsule_serial}",
     *      operationId="getCapsuleByName",
     *      tags={"Capsules"},
     *      summary="Get capsule info by name",
     *      description="Returns info of a capsule",
     *     @OA\Parameter(
     *          name="capsule_serial",
     *          description="Capsule Serial Code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function capsule_by_name(Request $request, $capsule_serial)
    {
        return $this->capsule_service->get_capsule_by_name($capsule_serial);
    }

}
