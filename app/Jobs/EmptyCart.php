<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Repositories\Carts\v1\CartRepository;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmptyCart implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            CartRepository::delete();

        } catch (Exception $exception) {
            Log::info('delete_carts', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTrace()
            ]);
        } catch (Throwable $throwable) {
            Log::channel('queue')
                ->info('delete_carts', [
                    'message' => $throwable->getMessage()
                ]);
        }
    }
}
