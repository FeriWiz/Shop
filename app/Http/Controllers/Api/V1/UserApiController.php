<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\Http\Services\keys;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{

    /**
     * @OA\Post(
     ** path="/api/v1/register",
     *  tags={"User Api"},
     *   security={{"sanctum":{}}},
     *  description="use to signin user with recieved code",
     * @OA\RequestBody(
     *    required=true,
     *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               @OA\Property(
     *                  property="image",
     *                  description="user image",
     *                  type="array",
     *                  @OA\Items(
     *                       type="string",
     *                       format="binary",
     *                  ),
     *               ),
     *           @OA\Property(
     *                  property="phone",
     *                  description="user phone number",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="name",
     *                  description="user name",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="address",
     *                  description="user address",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="postal_code",
     *                  description="user postal code",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="lat",
     *                  description="user location latitude",
     *                  type="double",
     *               ),
     *          @OA\Property(
     *                  property="lang",
     *                  description="user location longitude",
     *                  type="double",
     *               ),
     *           ),
     *       )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Data saved",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function register(Request $request)
    {
        $user = auth()->user();
        //7|5WVox985QFQbKcecYyTjT4ocZQTKbjatAMAozzY5aa048ba7
        if ($user) {
            User::updateUserInfo($user, $request);
            return response()->json([
               'result' => true,
                'message' => 'User updated',
                'date' => [
                    'user' => new UserResource($user)
                ]
            ], 201);
        } else {
            return response()->json([
                'result' => true,
                'message' => 'User not found',
                'date' => [
                    'user' => ""
                ]
            ], 403);
        }
    }


    /**
     * @OA\Get (
     * path="/api/v1/profile",
     *   tags={"User info"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function profile()
    {
        $user = auth()->user();
        return response()->json([
            'result' => true,
            'message' => 'User profile',
            'date' => [
                keys::user => new UserResource($user),
                keys::user_process_count => UserRepository::processingUserOrderCount($user),
                keys::user_received_count => UserRepository::receiverUserOrderCount($user),
                keys::user_rejected_count => UserRepository::rejectedUserOrderCount($user),
            ]
        ], 200);
    }

    public function receivedOrders()
    {
        $user = auth()->user();
        return response()->json([
            'result' => true,
            'message' => 'User received orders',
            'date' => UserRepository::receiverUserOrder($user)
        ], 200);
    }
}
