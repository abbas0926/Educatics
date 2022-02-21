<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreMarketingCampaignRequest;
use App\Http\Requests\Tenant\UpdateMarketingCampaignRequest;
use App\Http\Resources\Tenant\MarketingCampaignResource;
use App\Models\MarketingCampaign;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarketingCampaignApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('marketing_campaign_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarketingCampaignResource(MarketingCampaign::with(['manager', 'formations', 'events', 'leads', 'expenses'])->get());
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

        return (new MarketingCampaignResource($marketingCampaign))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MarketingCampaign $marketingCampaign)
    {
        abort_if(Gate::denies('marketing_campaign_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarketingCampaignResource($marketingCampaign->load(['manager', 'formations', 'events', 'leads', 'expenses']));
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

        return (new MarketingCampaignResource($marketingCampaign))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MarketingCampaign $marketingCampaign)
    {
        abort_if(Gate::denies('marketing_campaign_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingCampaign->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
