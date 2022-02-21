<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyGroupRequest;
use App\Http\Requests\Tenant\StoreGroupRequest;
use App\Http\Requests\Tenant\UpdateGroupRequest;
use App\Models\Group;
use App\Models\Promotion;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Group::with(['promotion', 'students'])->select(sprintf('%s.*', (new Group())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'group_show';
                $editGate = 'group_edit';
                $deleteGate = 'group_delete';
                $crudRoutePart = 'groups';

                return view('partials.admin.datatablesActions', compact(
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('promotion_name', function ($row) {
                return $row->promotion ? $row->promotion->name : '';
            });

            $table->editColumn('promotion.starting_date', function ($row) {
                return $row->promotion ? (is_string($row->promotion) ? $row->promotion : $row->promotion->starting_date) : '';
            });
            $table->editColumn('promotion.ending_date', function ($row) {
                return $row->promotion ? (is_string($row->promotion) ? $row->promotion : $row->promotion->ending_date) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'promotion']);

            return $table->make(true);
        }

        return view('tenant.groups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $promotions = Promotion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('first_name', 'id');

        return view('tenant.groups.create', compact('promotions', 'students'));
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        $group->students()->sync($request->input('students', []));

        return redirect()->route('admin.groups.index');
    }

    public function edit(Group $group)
    {
        abort_if(Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $promotions = Promotion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('first_name', 'id');

        $group->load('promotion', 'students');

        return view('tenant.groups.edit', compact('group', 'promotions', 'students'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->students()->sync($request->input('students', []));

        return redirect()->route('admin.groups.index');
    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->load('promotion', 'students');

        return view('tenant.groups.show', compact('group'));
    }

    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        return back();
    }

    public function massDestroy(MassDestroyGroupRequest $request)
    {
        Group::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
