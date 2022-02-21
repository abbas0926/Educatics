<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\MassDestroyThemeRequest;
use App\Http\Requests\Admin\StoreThemeRequest;
use App\Http\Requests\Admin\UpdateThemeRequest;
use App\Models\Tenant;
use App\Models\Theme;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ThemeController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('theme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Theme::with(['tenants'])->select(sprintf('%s.*', (new Theme())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'theme_show';
                $editGate = 'theme_edit';
                $deleteGate = 'theme_delete';
                $crudRoutePart = 'themes';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.themes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('theme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenants = Tenant::pluck('store_name', 'id');

        return view('admin.themes.create', compact('tenants'));
    }

    public function store(StoreThemeRequest $request)
    {
        $theme = Theme::create($request->all());
        $theme->tenants()->sync($request->input('tenants', []));
        if ($request->input('screenshot', false)) {
            $theme->addMedia(storage_path('tmp/uploads/' . basename($request->input('screenshot'))))->toMediaCollection('screenshot');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $theme->id]);
        }

        return redirect()->route('admin.themes.index');
    }

    public function edit(Theme $theme)
    {
        abort_if(Gate::denies('theme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenants = Tenant::pluck('store_name', 'id');

        $theme->load('tenants');

        return view('admin.themes.edit', compact('tenants', 'theme'));
    }

    public function update(UpdateThemeRequest $request, Theme $theme)
    {
        $theme->update($request->all());
        $theme->tenants()->sync($request->input('tenants', []));
        if ($request->input('screenshot', false)) {
            if (!$theme->screenshot || $request->input('screenshot') !== $theme->screenshot->file_name) {
                if ($theme->screenshot) {
                    $theme->screenshot->delete();
                }
                $theme->addMedia(storage_path('tmp/uploads/' . basename($request->input('screenshot'))))->toMediaCollection('screenshot');
            }
        } elseif ($theme->screenshot) {
            $theme->screenshot->delete();
        }

        return redirect()->route('admin.themes.index');
    }

    public function show(Theme $theme)
    {
        abort_if(Gate::denies('theme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $theme->load('tenants');

        return view('admin.themes.show', compact('theme'));
    }

    public function destroy(Theme $theme)
    {
        abort_if(Gate::denies('theme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $theme->delete();

        return back();
    }

    public function massDestroy(MassDestroyThemeRequest $request)
    {
        Theme::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('theme_create') && Gate::denies('theme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Theme();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
