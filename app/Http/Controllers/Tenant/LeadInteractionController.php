<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyLeadInteractionRequest;
use App\Http\Requests\Tenant\StoreLeadInteractionRequest;
use App\Http\Requests\Tenant\UpdateLeadInteractionRequest;
use App\Models\Lead;
use App\Models\LeadInteraction;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LeadInteractionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lead_interaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LeadInteraction::with(['lead', 'user'])->select(sprintf('%s.*', (new LeadInteraction())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lead_interaction_show';
                $editGate = 'lead_interaction_edit';
                $deleteGate = 'lead_interaction_delete';
                $crudRoutePart = 'lead-interactions';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('tenant.leadInteractions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lead_interaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leads = Lead::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.leadInteractions.create', compact('leads', 'users'));
    }

    public function store(StoreLeadInteractionRequest $request)
    {
        $leadInteraction = LeadInteraction::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $leadInteraction->id]);
        }

        return redirect()->route('admin.lead-interactions.index');
    }

    public function edit(LeadInteraction $leadInteraction)
    {
        abort_if(Gate::denies('lead_interaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leads = Lead::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $leadInteraction->load('lead', 'user');

        return view('tenant.leadInteractions.edit', compact('leadInteraction', 'leads', 'users'));
    }

    public function update(UpdateLeadInteractionRequest $request, LeadInteraction $leadInteraction)
    {
        $leadInteraction->update($request->all());

        return redirect()->route('admin.lead-interactions.index');
    }

    public function show(LeadInteraction $leadInteraction)
    {
        abort_if(Gate::denies('lead_interaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leadInteraction->load('lead', 'user');

        return view('tenant.leadInteractions.show', compact('leadInteraction'));
    }

    public function destroy(LeadInteraction $leadInteraction)
    {
        abort_if(Gate::denies('lead_interaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leadInteraction->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeadInteractionRequest $request)
    {
        LeadInteraction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lead_interaction_create') && Gate::denies('lead_interaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new LeadInteraction();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
