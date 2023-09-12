<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Update;
class UpdateController extends Controller
{
    /**
     * Display a listing of updates of a user.
     */
    public function notification(string $id)
    {
        $updates = Update::where('userId', $id)->get();

        for ($i=0; $i < count($updates); $i++) { 
            $current = $updates[$i];

            if(is_null($current['tradingAccountId']) && is_null($current['bankAccountId']) && is_null($current['transactionId'])){
                $current = Update::where('updates_id', $current['updates_id'])->with('user')->get();
            }
            else if(is_null($current['transactionId']) && is_null($current['tradingAccountId'])){
                $current = Update::where('updates_id', $current['updates_id'])->with('bankAccount')->get();
            }
            else if(is_null($current['transactionId']) && is_null($current['bankAccountId'])){
                $current = Update::where('updates_id', $current['updates_id'])->with('tradingAccount')->get();
            }
            else{
                $current = Update::where('updates_id', $current['updates_id'])->with('transactions')->get();
            }
            $updates[$i] = $current;
        }

        if(!empty($updates)){
            return $this->sendResponse($updates,'Successfully retruieve all updates');
        }
        else{
            return $this->sendError('Unable to retrieve updates', 'No updates were retrieved');
        }
    }

    /**
     * Display a listing of updates of a user.
     */
    public function updates(string $id)
    {
        $updates = Update::where('userId', $id)->whereNotNull('transactionId')->with('transactions')->get();

        if(!empty($updates)){
            return $this->sendResponse($updates,'Successfully retruieve all updates');
        }
        else{
            return $this->sendError('Unable to retrieve updates', 'No updates were retrieved');
        }
    }

}
