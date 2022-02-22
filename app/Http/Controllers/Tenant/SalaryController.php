<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroySalaryRequest;
use App\Http\Requests\Tenant\StoreSalaryRequest;
use App\Http\Requests\Tenant\UpdateSalaryRequest;
use App\Models\Employee;
use App\Models\Salary;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('salary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Salary::with(['employee'])->select(sprintf('%s.*', (new Salary())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'salary_show';
                $editGate = 'salary_edit';
                $deleteGate = 'salary_delete';
                $crudRoutePart = 'salaries';

                return view('partials.tenant.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('employee_last_name', function ($row) {
                return $row->employee ? $row->employee->last_name : '';
            });

            $table->editColumn('employee.first_name', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->first_name) : '';
            });
            $table->editColumn('month', function ($row) {
                return $row->month ? Salary::MONTH_SELECT[$row->month] : '';
            });
            $table->editColumn('taken_salary', function ($row) {
                return $row->taken_salary ? $row->taken_salary : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee']);

            return $table->make(true);
        }

        return view('tenant.salaries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('salary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.salaries.create', compact('employees'));
    }

    public function store(StoreSalaryRequest $request)
    {
        $salary = Salary::create($request->all());

        return redirect()->route('tenant.salaries.index');
    }

    public function edit(Salary $salary)
    {
        abort_if(Gate::denies('salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salary->load('employee');

        return view('tenant.salaries.edit', compact('employees', 'salary'));
    }

    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        $salary->update($request->all());

        return redirect()->route('tenant.salaries.index');
    }

    public function show(Salary $salary)
    {
        abort_if(Gate::denies('salary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary->load('employee');

        return view('tenant.salaries.show', compact('salary'));
    }

    public function destroy(Salary $salary)
    {
        abort_if(Gate::denies('salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary->delete();

        return back();
    }

    public function massDestroy(MassDestroySalaryRequest $request)
    {
        Salary::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
