<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyPromotionRequest;
use App\Http\Requests\Tenant\StorePromotionRequest;
use App\Http\Requests\Tenant\UpdatePromotionRequest;
use App\Models\Formation;
use App\Models\Promotion;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('promotion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Promotion::with(['formation', 'students'])->select(sprintf('%s.*', (new Promotion())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'promotion_show';
                $editGate = 'promotion_edit';
                $deleteGate = 'promotion_delete';
                $crudRoutePart = 'promotions';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('formation_title', function ($row) {
                return $row->formation ? $row->formation->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'formation']);

            return $table->make(true);
        }

        return view('tenant.promotions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('promotion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formations = Formation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('first_name', 'id');

        return view('tenant.promotions.create', compact('formations', 'students'));
    }

    public function store(StorePromotionRequest $request)
    {
        $promotion = Promotion::create($request->all());
        $promotion->students()->sync($request->input('students', []));

        return redirect()->route('tenant.promotions.index');
    }

    public function edit(Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formations = Formation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('first_name', 'id');

        $promotion->load('formation', 'students');

        return view('tenant.promotions.edit', compact('formations', 'promotion', 'students'));
    }

    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $promotion->update($request->all());
        $promotion->students()->sync($request->input('students', []));

        return redirect()->route('tenant.promotions.index');
    }

    public function show(Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $promotion->load('formation', 'students', 'promotionGroups');

        return view('tenant.promotions.show', compact('promotion'));
    }

    public function destroy(Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $promotion->delete();

        return back();
    }

    public function massDestroy(MassDestroyPromotionRequest $request)
    {
        Promotion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
