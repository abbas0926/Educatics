<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyFormationRequest;
use App\Http\Requests\Tenant\StoreFormationRequest;
use App\Http\Requests\Tenant\UpdateFormationRequest;
use App\Models\Formation;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FormationController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('formation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // if ($request->ajax()) {

        //     $query = Formation::query()->select(sprintf('%s.*', (new Formation())->table));
        //     $table = Datatables::of($query);

        //     $table->addColumn('placeholder', '&nbsp;');
        //     $table->addColumn('actions', '&nbsp;');

        //     $table->editColumn('actions', function ($row) {
        //         $viewGate = 'formation_show';
        //         $editGate = 'formation_edit';
        //         $deleteGate = 'formation_delete';
        //         $crudRoutePart = 'formations';

        //         return view('partials.tenant.datatablesActions', compact(
        //         'viewGate',
        //         'editGate',
        //         'deleteGate',
        //         'crudRoutePart',
        //         'row'
        //     ));
        //     });

        //     $table->editColumn('id', function ($row) {
        //         return $row->id ? $row->id : '';
        //     });
        //     $table->editColumn('title', function ($row) {
        //         return $row->title ? $row->title : '';
        //     });
        //     $table->editColumn('price', function ($row) {
        //         return $row->price ? $row->price : '';
        //     });
        //     $table->editColumn('status', function ($row) {
        //         return $row->status ? Formation::STATUS_SELECT[$row->status] : '';
        //     });

        //     $table->rawColumns(['actions', 'placeholder']);

        //     return $table->make(true);
        // }
        $formations =Formation::filter();
        
        return view('tenant.formations.index', compact('formations'));
    }

    public function create()
    {
        abort_if(Gate::denies('formation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.formations.create');
    }

    public function store(StoreFormationRequest $request)
    {
        $formation = Formation::create($request->all());

        if ($request->input('featured_image', false)) {
            $formation->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        foreach ($request->input('syllabus', []) as $file) {
            $formation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('syllabus');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $formation->id]);
        }
        return redirect()->route('tenant.formations.show',['formation' => $formation]);
    }

    public function edit(Formation $formation)
    {
        abort_if(Gate::denies('formation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.formations.edit', compact('formation'));
    }

    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $formation->update($request->all());

        if ($request->input('featured_image', false)) {
            if (!$formation->featured_image || $request->input('featured_image') !== $formation->featured_image->file_name) {
                if ($formation->featured_image) {
                    $formation->featured_image->delete();
                }
                $formation->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($formation->featured_image) {
            $formation->featured_image->delete();
        }

        if (count($formation->syllabus) > 0) {
            foreach ($formation->syllabus as $media) {
                if (!in_array($media->file_name, $request->input('syllabus', []))) {
                    $media->delete();
                }
            }
        }
        $media = $formation->syllabus->pluck('file_name')->toArray();
        foreach ($request->input('syllabus', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $formation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('syllabus');
            }
        }

        return redirect()->route('tenant.formations.index');
    }

    public function show(Formation $formation)
    {
        abort_if(Gate::denies('formation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formation->load('groups');
        $formation->load('promotions');

        return view('tenant.formations.show', compact('formation'));
    }

    public function destroy(Formation $formation)
    {
        abort_if(Gate::denies('formation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formation->delete();

        return back();
    }

    public function massDestroy(MassDestroyFormationRequest $request)
    {
        Formation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('formation_create') && Gate::denies('formation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Formation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
