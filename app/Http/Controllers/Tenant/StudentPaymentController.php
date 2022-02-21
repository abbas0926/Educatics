<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyStudentPaymentRequest;
use App\Http\Requests\Tenant\StoreStudentPaymentRequest;
use App\Http\Requests\Tenant\UpdateStudentPaymentRequest;
use App\Models\Invoice;
use App\Models\StudentPayment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentPaymentController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentPayment::with(['charged_by', 'invoice'])->select(sprintf('%s.*', (new StudentPayment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_payment_show';
                $editGate = 'student_payment_edit';
                $deleteGate = 'student_payment_delete';
                $crudRoutePart = 'student-payments';

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
            $table->addColumn('charged_by_name', function ($row) {
                return $row->charged_by ? $row->charged_by->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('payment_method', function ($row) {
                return $row->payment_method ? StudentPayment::PAYMENT_METHOD_SELECT[$row->payment_method] : '';
            });
            $table->addColumn('invoice_subject', function ($row) {
                return $row->invoice ? $row->invoice->subject : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'charged_by', 'invoice']);

            return $table->make(true);
        }

        return view('tenant.studentPayments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::pluck('subject', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.studentPayments.create', compact('invoices'));
    }

    public function store(StoreStudentPaymentRequest $request)
    {
        $studentPayment = StudentPayment::create($request->all());

        foreach ($request->input('attachement', []) as $file) {
            $studentPayment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachement');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $studentPayment->id]);
        }

        return redirect()->route('admin.student-payments.index');
    }

    public function edit(StudentPayment $studentPayment)
    {
        abort_if(Gate::denies('student_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $charged_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoices = Invoice::pluck('subject', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentPayment->load('charged_by', 'invoice');

        return view('tenant.studentPayments.edit', compact('charged_bies', 'invoices', 'studentPayment'));
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

        return redirect()->route('admin.student-payments.index');
    }

    public function show(StudentPayment $studentPayment)
    {
        abort_if(Gate::denies('student_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentPayment->load('charged_by', 'invoice');

        return view('tenant.studentPayments.show', compact('studentPayment'));
    }

    public function destroy(StudentPayment $studentPayment)
    {
        abort_if(Gate::denies('student_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentPayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentPaymentRequest $request)
    {
        StudentPayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_payment_create') && Gate::denies('student_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StudentPayment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
