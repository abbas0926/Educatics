<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDomainRequest;
use App\Http\Requests\Admin\UpdateDomainRequest;
use App\Http\Resources\Admin\DomainResource;
use App\Models\Domain;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DomainApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('domain_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DomainResource(Domain::with(['tenant', 'created_by'])->get());
    }

    public function store(StoreDomainRequest $request)
    {
        $domain = Domain::create($request->all());

        return (new DomainResource($domain))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Domain $domain)
    {
        abort_if(Gate::denies('domain_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DomainResource($domain->load(['tenant', 'created_by']));
    }

    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        $domain->update($request->all());

        return (new DomainResource($domain))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Domain $domain)
    {
        abort_if(Gate::denies('domain_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $domain->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
