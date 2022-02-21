<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreLeadRequest;
use App\Http\Requests\Tenant\UpdateLeadRequest;
use App\Http\Resources\Tenant\LeadResource;
use App\Models\Lead;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lead_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeadResource(Lead::with(['formations', 'events', 'marketing_campaign'])->get());
    }

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->all());
        $lead->formations()->sync($request->input('formations', []));
        $lead->events()->sync($request->input('events', []));

        return (new LeadResource($lead))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Lead $lead)
    {
        abort_if(Gate::denies('lead_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeadResource($lead->load(['formations', 'events', 'marketing_campaign']));
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->update($request->all());
        $lead->formations()->sync($request->input('formations', []));
        $lead->events()->sync($request->input('events', []));

        return (new LeadResource($lead))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Lead $lead)
    {
        abort_if(Gate::denies('lead_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
