<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreStudentPaymentRequest;
use App\Http\Requests\Tenant\UpdateStudentPaymentRequest;
use App\Http\Resources\Tenant\StudentPaymentResource;
use App\Models\StudentPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentPaymentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentPaymentResource(StudentPayment::with(['charged_by', 'invoice'])->get());
    }

    public function store(StoreStudentPaymentRequest $request)
    {
        $studentPayment = StudentPayment::create($request->all());

        foreach ($request->input('attachement', []) as $file) {
            $studentPayment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachement');
        }

        return (new StudentPaymentResource($studentPayment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentPayment $studentPayment)
    {
        abort_if(Gate::denies('student_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentPaymentResource($studentPayment->load(['charged_by', 'invoice']));
    }

    public function update(UpdateStudentPaymentRequest $request, StudentPayment $studentPayment)
    {
        $studentPayment->update($request->all());

        if (count($studentPayment->attachement) > 0) {
            foreach ($studentPayment->attachement as $media) {
                if (!in_array($media->file_name, $request->input('attachement', []))) {
                    $media->delete();
                }
            }
        }
        $media = $studentPayment->attachement->pluck('file_name')->toArray();
        foreach ($request->input('attachement', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $studentPayment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachement');
            }
        }

        return (new StudentPaymentResource($studentPayment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentPayment $studentPayment)
    {
        abort_if(Gate::denies('student_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentPayment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
