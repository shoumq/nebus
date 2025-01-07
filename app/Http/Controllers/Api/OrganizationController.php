<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    /**
     * @OA\Get(
     *     path="/organizations/building/{buildingId}",
     *     summary="Получить организации по ID здания",
     *     @OA\Parameter(
     *         name="buildingId",
     *         in="path",
     *         required=true,
     *         description="ID of the building",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="ООО “Рога и Копыта”"),
     *                 @OA\Property(property="building_id", type="integer", example=1),
     *                 @OA\Property(property="phone_numbers", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="number", type="string", example="2-222-222"),
     *                         @OA\Property(property="organization_id", type="integer", example=1)
     *                     )
     *                 ),
     *                 @OA\Property(property="activities", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Еда"),
     *                         @OA\Property(property="parent_id", type="integer", nullable=true, example=null),
     *                         @OA\Property(property="pivot", type="object",
     *                             @OA\Property(property="organization_id", type="integer", example=1),
     *                             @OA\Property(property="activity_id", type="integer", example=1)
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Building not found"
     *     )
     * )
     */
    public function indexByBuilding($buildingId)
    {
        return Organization::where('building_id', $buildingId)->with('phoneNumbers', 'activities')->get();
    }

    /**
     * @OA\Get(
     *     path="/organizations/activity/{activityId}",
     *     summary="Получить организации по ID деятельности",
     *     @OA\Parameter(
     *         name="activityId",
     *         in="path",
     *         required=true,
     *         description="ID деятельности",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="ООО “Рога и Копыта”"),
     *                 @OA\Property(property="building_id", type="integer", example=1),
     *                 @OA\Property(property="phone_numbers", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="number", type="string", example="2-222-222"),
     *                         @OA\Property(property="organization_id", type="integer", example=1)
     *                     )
     *                 ),
     *                 @OA\Property(property="activities", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Еда"),
     *                         @OA\Property(property="parent_id", type="integer", nullable=true, example=null),
     *                         @OA\Property(property="pivot", type="object",
     *                             @OA\Property(property="organization_id", type="integer", example=1),
     *                             @OA\Property(property="activity_id", type="integer", example=1)
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Building not found"
     *     )
     * )
     */
    public function indexByActivity($activityId)
    {
        $activity = Activity::find($activityId);
        if (!$activity) {
            return response()->json(['error' => 'Activity not found'], 404);
        }

        $activities = $this->getAllChildActivities($activity);
        return Organization::whereHas('activities', function ($query) use ($activities) {
            $query->whereIn('activities.id', $activities);
        })->with('phoneNumbers', 'activities')->get();
    }

    /**
     * @OA\Get(
     *     path="/organizations/radius",
     *     summary="Получить организации по радиусу",
     *     @OA\Parameter(
     *         name="lat",
     *         in="query",
     *         required=true,
     *         description="Широта точки",
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="lng",
     *         in="query",
     *         required=true,
     *         description="Долгота точки",
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="radius",
     *         in="query",
     *         required=true,
     *         description="Радиус в километрах",
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="ООО “Рога и Копыта”"),
     *                 @OA\Property(property="building_id", type="integer", example=1),
     *                 @OA\Property(property="phone_numbers", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="number", type="string", example="2-222-222"),
     *                         @OA\Property(property="organization_id", type="integer", example=1)
     *                     )
     *                 ),
     *                 @OA\Property(property="activities", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Еда"),
     *                         @OA\Property(property="parent_id", type="integer", nullable=true, example=null),
     *                         @OA\Property(property="pivot", type="object",
     *                             @OA\Property(property="organization_id", type="integer", example=1),
     *                             @OA\Property(property="activity_id", type="integer", example=1)
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Организации не найдены"
     *     )
     * )
     */
    public function indexByRadius(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $radius = $request->input('radius');

        $buildings = Building::select('id')
            ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$lat, $lng, $lat])
            ->having('distance', '<=', $radius)
            ->get();

        if (count($buildings) == 0) {
            return response()->json(['error' => 'Activity not found'], 404);
        }

        $buildingIds = $buildings->pluck('id');
        return Organization::whereIn('building_id', $buildingIds)->with('phoneNumbers', 'activities')->get();
    }

    /**
     * @OA\Get(
     *     path="/organizations/{id}",
     *     summary="Получить организацию по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID организации",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="ООО “Рога и Копыта”"),
     *             @OA\Property(property="building_id", type="integer", example=1),
     *             @OA\Property(property="phone_numbers", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="number", type="string", example="2-222-222"),
     *                     @OA\Property(property="organization_id", type="integer", example=1)
     *                 )
     *             ),
     *             @OA\Property(property="activities", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Еда"),
     *                     @OA\Property(property="parent_id", type="integer", nullable=true, example=null),
     *                     @OA\Property(property="pivot", type="object",
     *                         @OA\Property(property="organization_id", type="integer", example=1),
     *                         @OA\Property(property="activity_id", type="integer", example=1)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Организация не найдена"
     *     )
     * )
     */
    public function show($id)
    {
        $organization = Organization::with('phoneNumbers', 'activities')->find($id);
        return $organization
            ? $organization
            : response()->json(['error' => 'Organization not found'], 404);
    }

    public function searchByName($name)
    {
        return Organization::where('name', 'like', '%' . $name . '%')->with('phoneNumbers', 'activities')->get();
    }

    private function getAllChildActivities($activity)
    {
        $activities = [$activity->id];
        if ($activity->children) {
            foreach ($activity->children as $child) {
                $activities = array_merge($activities, $this->getAllChildActivities($child));
            }
        }
        return $activities;
    }
}
