<?php
namespace App\Http\Controllers\PowerSchedule;

use App\Http\Controllers\Controller;
use App\Models\PowerSchedule\Power;
use App\Traits\SendResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PowerController extends Controller {

    use SendResponse;

    public function index() {
        $bills = Power::all();
        return view('power-schedule.power', compact('bills'));
    }

    public function getReport(Request $request) {
        $reports = $this->getBlackOuts($request->get('bill_name'));
        $reports = sortDataByDay($reports);

        return $this->sendResponse($reports);
    }

    protected function getBlackOuts($billName) {
        $bill = Power::where('english_title', $billName)->first();
        if ($bill) {
            return $this->findReport($bill->bill_id, $billName);
        }

        return [];
    }

    protected function findReport($billId, $billName) {
        if (Cache::has("report_{$billName}")) {
            return Cache::get("report_{$billName}");
        }

        $report = $this->sendRequest($billId);
        if ($report) {
            Cache::put("report_{$billName}", $report, getFridayTime() - Carbon::now()->getTimestamp());
        }

        return $report;
    }

    protected function sendRequest($billId) {
        $response = Http::withToken(env('API_TOKEN'))
            ->withHeaders([
                'Content-type' => 'application/json',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
            ])
            ->post(env('API_URL'), [
                'bill_id' => (string) $billId,
                'to_date' => '1504/12/30',
            ]);

        if ($response->successful()) {
            $data = $response->json();
            return count($data['data']) > 0 ? collect($data['data']) : null;
        }

        return null;
    }
}
