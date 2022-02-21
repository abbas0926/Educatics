<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreEmployeePresenceRequest;
use App\Http\Requests\Tenant\UpdateEmployeePresenceRequest;
use App\Http\Resources\Tenant\EmployeePresenceResource;
use App\Models\EmployeePresence;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeePresenceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employee_presence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeePresenceResource(EmployeePresence::with(['employee'])->get());
    }

    public function store(StoreEmployeePresenceRequest $request)
    {
        $employeePresence = EmployeePresence::create($request->all());

        return (new EmployeePresenceResource($employeePresence))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeePresence $employeePresence)
    {
        abort_if(Gate::denies('employee_presence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeePresenceResource($employeePresence->load(['employee']));
    }

    public function update(UpdateEmployeePresenceRequest $request, EmployeePresence $employeePresence)
    {
        $employeePresence->update($request->all());

        return (new EmployeePresenceResource($employeePresence))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeePresence $employeePresence)
    {
        abort_if(Gate::denies('employee_presence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeePresence->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
