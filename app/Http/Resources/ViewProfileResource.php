<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewprofileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'userID'=> $this->userID,
            'firstName'=> $this->firstName,
            'lastName'=> $this->lastName,
            'IDnumber'=> $this->IDnumber,
            'email'=> $this->email,
            'phoneNumber'=> $this->phoneNumber,

        ];
    }
}
