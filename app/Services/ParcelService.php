<?php

namespace App\Services;

use App\Models\Parcel;
use App\Models\User;
use Illuminate\Http\Request;

class ParcelService
{
    private $request;
    private $parcelModel;

    /**
     * ParcelService constructor.
     * @param Parcel $parcelModel
     * @param Request $request
     */
    public function __construct(Parcel $parcelModel, Request $request)
    {
        $this->parcelModel = $parcelModel;
        $this->request = $request;
    }


    /**
     * @param $input
     * @return Parcel
     */
    public function get()
    {
        $parcelCondition = $this->request->user()->type == User::TYPE['sender'] ? ["sender_id" => $this->request->user()->id] : ["biker_id" => $this->request->user()->id];
        return $this->parcelModel->where($parcelCondition)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        if($this->request->user()->type == User::TYPE['sender'])
        {
            $parcel = $this->parcelModel
                ->select('parcels.id','parcels.delivery_address','parcels.pickup_address','parcels.status','parcels.pickup_time', 'users.name as biker_name')
                ->leftjoin('users','parcels.biker_id','=','users.id')
                ->where(['parcels.id' => $id, 'parcels.sender_id' => $this->request->user()->id])
                ->first();
        }
        elseif($this->request->user()->type == User::TYPE['biker'])
        {
            $parcel = $this->parcelModel
                ->select('parcels.id','parcels.delivery_address','parcels.pickup_address','parcels.status','parcels.pickup_time', 'users.name as sender_name')
                ->join('users','parcels.sender_id','=','users.id')
                ->where(['parcels.id' => $id, 'parcels.biker_id' => $this->request->user()->id])
                ->first();
        }
        return $parcel;
    }

    /**
     * @return mixed
     */
    public function store()
    {

        $input['sender_id'] = $this->request()->user()->id;

        return $this->parcelModel->create($input);
    }

    /**
     * @param $id
     * @return parcel collection
     */
    public function pickup($id)
    {
        $parcel = $this->parcelModel->whereNull("biker_id")->Where("id", $id)->first();

        if($parcel) {
            $parcel->biker_id = $this->request->user()->id;
            $parcel->status = 1;
            $parcel->pickup_time = now();
            $parcel->save();
            $parcel->status = Parcel::STATUS[$parcel->status];
        }
        return $parcel;
    }
}
