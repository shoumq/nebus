<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/buildings",
     *     summary="Получить все здания",
     *     tags={"Здания"},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="address", type="string", example="г. Москва, ул. Ленина 1, офис 3"),
     *                 @OA\Property(property="latitude", type="string", example="55.75580000"),
     *                 @OA\Property(property="longitude", type="string", example="37.61730000")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Здания не найдены"
     *     )
     * )
     */
    public function index(): Collection
    {
        return Building::all();
    }
}
