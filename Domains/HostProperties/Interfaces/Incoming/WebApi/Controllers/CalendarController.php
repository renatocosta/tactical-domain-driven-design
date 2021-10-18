<?php

namespace Domains\HostProperties\Interfaces\Incoming\WebApi\Controllers;

use App\Http\Controllers\Controller;
use Domains\HostProperties\Application\UseCases\Calendar\CreateCalendarInput;
use Domains\HostProperties\Application\UseCases\Calendar\ICreateCalendarUseCase;
use Domains\HostProperties\Application\UseCases\Calendar\Queries\IGetCalendarQuery;
use Domains\HostProperties\Infrastructure\Framework\Transformers\CalendarResource;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function create(Request $request, ICreateCalendarUseCase $createCalendarUseCase)
    {
        $createCalendarUseCase->execute(new CreateCalendarInput($request->url, $request->property_id));
        return new CalendarResource($createCalendarUseCase->calendar);
    }

    public function fetchAll(Request $request, IGetCalendarQuery $getCalendarQuery)
    {
        return CalendarResource::collection($getCalendarQuery->execute());
    }
}
