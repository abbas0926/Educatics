<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyMarketingCampaignRequest;
use App\Http\Requests\Tenant\StoreMarketingCampaignRequest;
use App\Http\Requests\Tenant\UpdateMarketingCampaignRequest;
use App\Models\Event;
use App\Models\Expense;
use App\Models\Formation;
use App\Models\Lead;
use App\Models\MarketingCampaign;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MarketingCampaignController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('marketing_campaign_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MarketingCampaign::with(['manager', 'formations', 'events', 'leads', 'expenses'])->select(sprintf('%s.*', (new MarketingCampaign())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'marketing_campaign_show';
                $editGate = 'marketing_campaign_edit';
                $deleteGate = 'marketing_campaign_delete';
                $crudRoutePart = 'marketing-campaigns';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->addColumn('manager_name', function ($row) {
                return $row->manager ? $row->manager->name : '';
            });

            $table->editColumn('budget', function ($row) {
                return $row->budget ? $row->budget : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'manager']);

            return $table->make(true);
        }

        return view('tenant.marketingCampaigns.index');
    }

    public function create()
    {
        abort_if(Gate::denies('marketing_campaign_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $formations = Formation::pluck('title', 'id');

        $events = Event::pluck('title', 'id');

        $leads = Lead::pluck('last_name', 'id');

        $expenses = Expense::pluck('title', 'id');

        return view('tenant.marketingCampaigns.create', compact('events', 'expenses', 'formations', 'leads', 'managers'));
    }

    public function store(StoreMarketingCampaignRequest $request)
    {
        $marketingCampaign = MarketingCampaign::create($request->all());
        $marketingCampaign->formations()->sync($request->input('formations', []));
        $marketingCampaign->events()->sync($request->input('events', []));
        $marketingCampaign->leads()->sync($request->input('leads', []));
        $marketingCampaign->expenses()->sync($request->input('expenses', []));
        foreach ($request->input('gallery', []) as $file) {
            $marketingCampaign->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $marketingCampaign->id]);
        }

        return redirect()->route('admin.marketing-campaigns.index');
    }

    public function edit(MarketingCampaign $marketingCampaign)
    {
        abort_if(Gate::denies('marketing_campaign_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $formations = Formation::pluck('title', 'id');

        $events = Event::pluck('title', 'id');

        $leads = Lead::pluck('last_name', 'id');

        $expenses = Expense::pluck('title', 'id');

        $marketingCampaign->load('manager', 'formations', 'events', 'leads', 'expenses');

        return view('tenant.marketingCampaigns.edit', compact('events', 'expenses', 'formations', 'leads', 'managers', 'marketingCampaign'));
    }

    public function update(UpdateMarketingCampaignRequest $request, MarketingCampaign $marketingCampaign)
    {
        $marketingCampaign->update($request->all());
        $marketingCampaign->formations()->sync($request->input('formations', []));
        $marketingCampaign->events()->sync($request->input('events', []));
        $marketingCampaign->leads()->sync($request->input('leads', []));
        $marketingCampaign->expenses()->sync($request->input('expenses', []));
        if (count($marketingCampaign->gallery) > 0) {
            foreach ($marketingCampaign->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $marketingCampaign->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $marketingCampaign->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.marketing-campaigns.index');
    }

    public function show(MarketingCampaign $marketingCampaign)
    {
        abort_if(Gate::denies('marketing_campaign_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingCampaign->load('manager', 'formations', 'events', 'leads', 'expenses');

        return view('tenant.marketingCampaigns.show', compact('marketingCampaign'));
    }

    public function destroy(MarketingCampaign $marketingCampaign)
    {
        abort_if(Gate::denies('marketing_campaign_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingCampaign->delete();

        return back();
    }

    public function massDestroy(MassDestroyMarketingCampaignRequest $request)
    {
        MarketingCampaign::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('marketing_campaign_create') && Gate::denies('marketing_campaign_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MarketingCampaign();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
