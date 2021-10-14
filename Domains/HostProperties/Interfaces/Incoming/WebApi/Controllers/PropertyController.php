<?php

namespace Domains\HostProperties\Interfaces\Incoming\WebApi\Controllers;

use App\Http\Controllers\Controller;
use Domains\HostProperties\Application\UseCases\Property\CreatePropertyInput;
use Domains\HostProperties\Application\UseCases\Property\ICreatePropertyUseCase;
use Domains\HostProperties\Infrastructure\Framework\Transformers\PropertyResource;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function create(Request $request, ICreatePropertyUseCase $createPropertyUseCase)
    {
        $createPropertyUseCase->execute(new CreatePropertyInput($request->street, $request->city, $request->state, $request->country, $request->zipcode, $request->roomWidth, $request->roomHeight));
        return new PropertyResource($createPropertyUseCase->property);
    }
}
