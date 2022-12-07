<?php

namespace App\Observers;

use App\Models\TableA;
use App\Models\TableB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TableAObserver
{
    /**
     * Handle the TableA "created" event.
     *
     * @param TableA $tableA
     * @return void
     * @throws \Exception
     */
    public function created(TableA $tableA): void
    {
        try {
            DB::beginTransaction();

            $TableBModel = new TableB();
            if ($TableBModel->exists()) {
                // table_b row exists so update the row
                $tableB = $TableBModel->latest()->first();

                $tableB->tableA()->associate($tableA);
                // add table1 id to table2

                $tableB->start_count = $tableB->start_count + $tableA->user_start;
                // sum user_start from table_a with start_count from table_b

                $tableB->save();
            } else {
                // table_b row doesn't exist so create new row
                $tableA->tableB()->create([
                    'start_count' => $tableA->user_start,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            // rollback data from database if throw exception
            DB::rollBack();
            $tableA->delete();

            app()->environment('local') ?
                throw $e :
                Log::error('error in TableAObserver :'.$e->getMessage());
        }
    }

    /**
     * Handle the TableA "updated" event.
     *
     * @param TableA $tableA
     * @return void
     */
    public function updated(TableA $tableA): void
    {
        //
    }

    /**
     * Handle the TableA "deleted" event.
     *
     * @param TableA $tableA
     * @return void
     */
    public function deleted(TableA $tableA): void
    {
        //
    }

    /**
     * Handle the TableA "restored" event.
     *
     * @param TableA $tableA
     * @return void
     */
    public function restored(TableA $tableA): void
    {
        //
    }

    /**
     * Handle the TableA "force deleted" event.
     *
     * @param TableA $tableA
     * @return void
     */
    public function forceDeleted(TableA $tableA): void
    {
        //
    }
}
