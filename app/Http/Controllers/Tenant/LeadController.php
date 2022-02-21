<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyLeadRequest;
use App\Http\Requests\Tenant\StoreLeadRequest;
use App\Http\Requests\Tenant\UpdateLeadRequest;
use App\Models\Event;
use App\Models\Formation;
use App\Models\Lead;
use App\Models\MarketingCampaign;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('lead_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lead::with(['formations', 'events', 'marketing_campaign'])->select(sprintf('%s.*', (new Lead())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lead_show';
                $editGate = 'lead_edit';
                $deleteGate = 'lead_delete';
                $crudRoutePart = 'leads';

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
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('events', function ($row) {
                $labels = [];
                foreach ($row->events as $event) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $event->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'events']);

            return $table->make(true);
        }

        return view('tenant.leads.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lead_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formations = Formation::pluck('title', 'id');

        $events = Event::pluck('title', 'id');

        $marketing_campaigns = MarketingCampaign::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.leads.create', compact('events', 'formations', 'marketing_campaigns'));
    }

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->all());
        $lead->formations()->sync($request->input('formations', []));
        $lead->events()->sync($request->input('events', []));

        return redirect()->route('admin.leads.index');
    }

    public function edit(Lead $lead)
    {
        abort_if(Gate::denies('lead_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formations = Formation::pluck('title', 'id');

        $events = Event::pluck('title', 'id');

        $marketing_campaigns = MarketingCampaign::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lead->load('formations', 'events', 'marketing_campaign');

        return view('tenant.leads.edit', compact('events', 'formations', 'lead', 'marketing_campaigns'));
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->update($request->all());
        $lead->formations()->sync($request->input('formations', []));
        $lead->events()->sync($request->input('events', []));

        return redirect()->route('admin.leads.index');
    }

    public function show(Lead $lead)
    {
        abort_if(Gate::denies('lead_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->load('formations', 'events', 'marketing_campaign', 'leadLeadInteractions', 'leadMarketingCampaigns');

        return view('tenant.leads.show', compact('lead'));
    }

    public function destroy(Lead $lead)
    {
        abort_if(Gate::denies('lead_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeadRequest $request)
    {
        Lead::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
