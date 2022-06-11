<?php

namespace App\Observers\Tenant;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\PromotionStudent;

class PromotionStudentObserver
{
    /**
     * Handle the PromotionStudent "created" event.
     *
     * @param  \App\Models\PromotionStudent  $promotionStudent
     * @return void
     */
    public function created(PromotionStudent $promotionStudent)
    {
     
        try {
            $student=$promotionStudent->student;
          
            $invoice_item=new InvoiceItem();
            $invoice_item->quantity=1;
            $formation=$student->studentPromotions()->get()->first()->formation;
            $invoice_item->price= $formation->price;
            $invoice_item->designation="Inscription au formation ".$formation->title;
            $invoice_item->save();
    
            $invoice= new Invoice();
            $invoice->subject='Inscription au formation '.$formation->title;
            // $invoice->deadline=
            $invoice->total=$invoice_item->price;
            $invoice->total_to_pay=$invoice_item->price;
            $invoice->student_id=$student->id;
            $invoice->status=false;
            $invoice->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the PromotionStudent "updated" event.
     *
     * @param  \App\Models\PromotionStudent  $promotionStudent
     * @return void
     */
    public function updated(PromotionStudent $promotionStudent)
    {
        //
    }

    /**
     * Handle the PromotionStudent "deleted" event.
     *
     * @param  \App\Models\PromotionStudent  $promotionStudent
     * @return void
     */
    public function deleted(PromotionStudent $promotionStudent)
    {
        //
    }

    /**
     * Handle the PromotionStudent "restored" event.
     *
     * @param  \App\Models\PromotionStudent  $promotionStudent
     * @return void
     */
    public function restored(PromotionStudent $promotionStudent)
    {
        //
    }

    /**
     * Handle the PromotionStudent "force deleted" event.
     *
     * @param  \App\Models\PromotionStudent  $promotionStudent
     * @return void
     */
    public function forceDeleted(PromotionStudent $promotionStudent)
    {
        //
    }
}
