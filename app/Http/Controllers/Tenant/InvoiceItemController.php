<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyInvoiceItemRequest;
use App\Http\Requests\Tenant\StoreInvoiceItemRequest;
use App\Http\Requests\Tenant\UpdateInvoiceItemRequest;
use App\Models\Event;
use App\Models\Formation;
use App\Models\InvoiceItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoiceItemController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InvoiceItem::with(['formation', 'event'])->select(sprintf('%s.*', (new InvoiceItem())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'invoice_item_show';
                $editGate = 'invoice_item_edit';
                $deleteGate = 'invoice_item_delete';
                $crudRoutePart = 'invoice-items';

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
            $table->addColumn('formation_title', function ($row) {
                return $row->formation ? $row->formation->title : '';
            });

            $table->editColumn('formation.price', function ($row) {
                return $row->formation ? (is_string($row->formation) ? $row->formation : $row->formation->price) : '';
            });
            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->title : '';
            });

            $table->editColumn('event.price', function ($row) {
                return $row->event ? (is_string($row->event) ? $row->event : $row->event->price) : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'formation', 'event']);

            return $table->make(true);
        }

        return view('tenant.invoiceItems.index');
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formations = Formation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.invoiceItems.create', compact('events', 'formations'));
    }

    public function store(StoreInvoiceItemRequest $request)
    {
        $invoiceItem = InvoiceItem::create($request->all());

        return redirect()->route('tenant.invoice-items.index');
    }

    public function edit(InvoiceItem $invoiceItem)
    {
        abort_if(Gate::denies('invoice_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formations = Formation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoiceItem->load('formation', 'event');

        return view('tenant.invoiceItems.edit', compact('events', 'formations', 'invoiceItem'));
    }

    public function update(UpdateInvoiceItemRequest $request, InvoiceItem $invoiceItem)
    {
        $invoiceItem->update($request->all());

        return redirect()->route('tenant.invoice-items.index');
    }

    public function show(InvoiceItem $invoiceItem)
    {
        abort_if(Gate::denies('invoice_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceItem->load('formation', 'event');

        return view('tenant.invoiceItems.show', compact('invoiceItem'));
    }

    public function destroy(InvoiceItem $invoiceItem)
    {
        abort_if(Gate::denies('invoice_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceItemRequest $request)
    {
        InvoiceItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
