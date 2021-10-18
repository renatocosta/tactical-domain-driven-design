<?php

namespace Domains\HostProperties\Infrastructure\Framework\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
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
      '_type'               => 'Calendar',
      'id'                  => (string) $this->getIdentifier(),
      'url'         => (string) $this->getCalendarUrl(),
      'property_id'         => (string) $this->getPropertyId()
    ];
  }
}
