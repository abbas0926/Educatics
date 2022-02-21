<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreSalaryRequest;
use App\Http\Requests\Tenant\UpdateSalaryRequest;
use App\Http\Resources\Tenant\SalaryResource;
use App\Models\Salary;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalaryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('salary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalaryResource(Salary::with(['employee'])->get());
    }

    public function store(StoreSalaryRequest $request)
    {
        $salary = Salary::create($request->all());

        return (new SalaryResource($salary))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Salary $salary)
    {
        abort_if(Gate::denies('salary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalaryResource($salary->load(['employee']));
    }

    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        $salary->update($request->all());

        return (new SalaryResource($salary))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Salary $salary)
    {
        abort_if(Gate::denies('salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
