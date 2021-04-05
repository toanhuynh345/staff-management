<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTeamProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'team_project_id' => $this->team_project_id,
            'start_join' => $this->start_join,
            'end_join' => $this->end_join,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
