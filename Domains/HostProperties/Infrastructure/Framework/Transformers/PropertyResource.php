<?php

namespace Domains\HostProperties\Infrastructure\Framework\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param \Illuminate\Http\Request
   * @return array
   */
  public function toArray($request)
  {

    return [
      '_type'               => 'Property',
      'id'                  => $this->getIdentifier(),
      'street'         => $this->getAddress()->street,
      'city'         => $this->getAddress()->city,
      'state'         => $this->getAddress()->state,
      'country'         => $this->getAddress()->country,
      'zipcode'         => $this->getAddress()->zipcode,
      'Room width'      => $this->getRoom()->width,
      'Room weight'      => $this->getRoom()->weight,
    ];
  }
}
