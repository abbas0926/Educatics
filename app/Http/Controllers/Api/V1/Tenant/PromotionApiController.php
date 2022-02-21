<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StorePromotionRequest;
use App\Http\Requests\Tenant\UpdatePromotionRequest;
use App\Http\Resources\Tenant\PromotionResource;
use App\Models\Promotion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PromotionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('promotion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PromotionResource(Promotion::with(['formation', 'students'])->get());
    }

    public function store(StorePromotionRequest $request)
    {
        $promotion = Promotion::create($request->all());
        $promotion->students()->sync($request->input('students', []));

        return (new PromotionResource($promotion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PromotionResource($promotion->load(['formation', 'students']));
    }

    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $promotion->update($request->all());
        $promotion->students()->sync($request->input('students', []));

        return (new PromotionResource($promotion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Promotion $promotion)
    {
        abort_if(Gate::denies('promotion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $promotion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
