<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyEmployeePresenceRequest;
use App\Http\Requests\Tenant\StoreEmployeePresenceRequest;
use App\Http\Requests\Tenant\UpdateEmployeePresenceRequest;
use App\Models\EmployeePresence;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmployeePresenceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('employee_presence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EmployeePresence::with(['employee'])->select(sprintf('%s.*', (new EmployeePresence())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'employee_presence_show';
                $editGate = 'employee_presence_edit';
                $deleteGate = 'employee_presence_delete';
                $crudRoutePart = 'employee-presences';

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
            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? EmployeePresence::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee']);

            return $table->make(true);
        }

        return view('tenant.employeePresences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('employee_presence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.employeePresences.create', compact('employees'));
    }

    public function store(StoreEmployeePresenceRequest $request)
    {
        $employeePresence = EmployeePresence::create($request->all());

        return redirect()->route('tenant.employee-presences.index');
    }

    public function edit(EmployeePresence $employeePresence)
    {
        abort_if(Gate::denies('employee_presence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeePresence->load('employee');

        return view('tenant.employeePresences.edit', compact('employeePresence', 'employees'));
    }

    public function update(UpdateEmployeePresenceRequest $request, EmployeePresence $employeePresence)
    {
        $employeePresence->update($request->all());

        return redirect()->route('tenant.employee-presences.index');
    }

    public function show(EmployeePresence $employeePresence)
    {
        abort_if(Gate::denies('employee_presence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeePresence->load('employee');

        return view('tenant.employeePresences.show', compact('employeePresence'));
    }

    public function destroy(EmployeePresence $employeePresence)
    {
        abort_if(Gate::denies('employee_presence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeePresence->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeePresenceRequest $request)
    {
        EmployeePresence::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
