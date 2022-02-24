<?php

namespace App\Http\Controllers\API;

use App\Services\ParcelService;
use App\Models\Parcel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParcelController extends APIController
{
    /**
     * @var ParcelFacade $parcelFacade
     */
    private $parcelService;

    /**
     * ParcelController constructor.
     * @param ParcelService $parcelService
     */
    public function __construct(ParcelService $parcelService)
    {
        $this->parcelService = $parcelService;
    }

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $parcels = $this->parcelService->get();

        return $this->sendResponse($parcels, 'parcels retrieved successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id) : JsonResponse
    {
        $parcel = $this->parcelService->show($id);

        if (is_null($parcel)) {
            return $this->sendError('Parcel not found.');
        }

        return $this->sendResponse($parcel, 'Parcel retrieved successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pickup_address' => 'required',
            'delivery_address' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $parcel = $this->parcelService->store();

        return $this->sendResponse($parcel, 'parcels created successfully.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function pickup(Request $request, $id) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:App\Models\Parcel,id'
        ],[
            "id.required" => "Parsal ID is required",
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $parcel = $this->parcelService->pickup($id);

        if($parcel)
            return $this->sendResponse($parcel, 'parcels picked up successfully.');

        return $this->sendError('This Parcel is already picked by other biker');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:App\Models\Parcel,id'
        ],[
            "id.required" => "Parsal ID is required",
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $parcel = $this->parcelService->show($id);
        if (!$parcel || $parcel->status == 'waiting' || $parcel->status == 'delivered' ) {
            return $this->sendError('Deliver must be greater than pickup', ['Parcel status not valid']);
        }

        if ($parcel->status == 'picked' && strtotime($parcel->pickup_time) > strtotime($request->delivery_time)) {
            return $this->sendError('Invalide Parcel', ['Parcel time not valid']);
        }

        $parcel = $this->parcelService->updateParcel($id);

        if($parcel)
            return $this->sendResponse($parcel, 'parcel udpated up successfully.');

        return $this->sendError('Error updating parcel');
    }
}
