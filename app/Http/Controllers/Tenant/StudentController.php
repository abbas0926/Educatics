<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyStudentRequest;
use App\Http\Requests\Tenant\StoreStudentRequest;
use App\Http\Requests\Tenant\UpdateStudentRequest;
use App\Models\Formation;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Promotion;
use App\Models\PromotionStudent;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Student::query()->select(sprintf('%s.*', (new Student())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_show';
                $editGate = 'student_edit';
                $deleteGate = 'student_delete';
                $crudRoutePart = 'students';

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
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'photo']);

            return $table->make(true);
        }
        $students =Student::filter();
       $formations= Formation::all();
       $promotions =Promotion::all();


        return view('tenant.students.index' , compact('students','formations','promotions'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());

        foreach ($request->input('attachements', []) as $file) {
            $student->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachements');
        }

        if ($request->input('photo', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }
        // // dd();
        // $student->setRawAttributes([$request->input('promotion_id', [])], true);
        $promotionStudent=new PromotionStudent();
        $promotionStudent->student_id = $student->id;
        $promotionStudent->promotion_id=$request->input('promotion_id', []);
        $promotionStudent->save();
        // $student->studentPromotions()->sync($request->input('promotion_id', []));
        return redirect()->route('tenant.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        if (count($student->attachements) > 0) {
            foreach ($student->attachements as $media) {
                if (!in_array($media->file_name, $request->input('attachements', []))) {
                    $media->delete();
                }
            }
        }
        $media = $student->attachements->pluck('file_name')->toArray();
        foreach ($request->input('attachements', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $student->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachements');
            }
        }

        if ($request->input('photo', false)) {
            if (!$student->photo || $request->input('photo') !== $student->photo->file_name) {
                if ($student->photo) {
                    $student->photo->delete();
                }
                $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($student->photo) {
            $student->photo->delete();
        }

        return redirect()->route('tenant.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('studentInvoices', 'studentGroups', 'studentPromotions', 'presenceStudentLessons');
        $promotions= Promotion::all();
        $formations=Formation::all();

        return view('tenant.students.show', compact('student','formations','promotions'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        Student::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    
    public function attachToGroup( Request $request){
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
        $group_student= new GroupStudent();
        $group_student->student_id=$request->student_id;
        $group_student->group_id=$request->group_id;
        $group_student->save();

        return redirect()->back();
    }
    public function changeGroup( Request $request){
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
        $group_student=  PromotionStudent::where('student_id',$request->student_id)->get()->first();
        $group_student->group_id=$request->group_id;
        $group_student->save();

        return redirect()->back();
    }

    public function changePromotion( Request $request){
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
        $group_student=  PromotionStudent::where('student_id',$request->student_id)->get()->first();
        $group_student->promotion_id=$request->promotion_id;
        $group_student->save();

        return redirect()->back();
    }

    public function attachToPromotion( Request $request){
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
        $group_student= new GroupStudent();
        $group_student->student_id=$request->student_id;
        $group_student->promotion_id=$request->promotion_id;
        $group_student->save();

        return redirect()->back();
    }
    public function changeFormation( Request $request){
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
        $group_student=  GroupStudent::where('student_id',$request->student_id)->get()->first();
        $group_student->formation_id=$request->formation_id;
        $group_student->save();

        return redirect()->back();
    }

    public function attachToFormation( Request $request){
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
        $group_student= new GroupStudent();
        $group_student->student_id=$request->student_id;
        $group_student->formation_id=$request->formation_id;
        $group_student->save();

        return redirect()->back();
    }
    
}
