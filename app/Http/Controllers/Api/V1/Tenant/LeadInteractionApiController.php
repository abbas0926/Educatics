<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreLeadInteractionRequest;
use App\Http\Requests\Tenant\UpdateLeadInteractionRequest;
use App\Http\Resources\Tenant\LeadInteractionResource;
use App\Models\LeadInteraction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadInteractionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lead_interaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeadInteractionResource(LeadInteraction::with(['lead', 'user'])->get());
    }

    public function store(StoreLeadInteractionRequest $request)
    {
        $leadInteraction = LeadInteraction::create($request->all());

        return (new LeadInteractionResource($leadInteraction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LeadInteraction $leadInteraction)
    {
        abort_if(Gate::denies('lead_interaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeadInteractionResource($leadInteraction->load(['lead', 'user']));
    }

    public function update(UpdateLeadInteractionRequest $request, LeadInteraction $leadInteraction)
    {
        $leadInteraction->update($request->all());

        return (new LeadInteractionResource($leadInteraction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LeadInteraction $leadInteraction)
    {
        abort_if(Gate::denies('lead_interaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leadInteraction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
