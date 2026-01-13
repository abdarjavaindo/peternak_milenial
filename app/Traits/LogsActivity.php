<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Trait for logging admin activities to the database.
 * 
 * Usage:
 *   use App\Traits\LogsActivity;
 *   
 *   class YourController extends Controller
 *   {
 *       use LogsActivity;
 *       
 *       public function someMethod()
 *       {
 *           $this->logActivity('action_name', 'ModelType', $modelId, ['key' => 'value']);
 *       }
 *   }
 */
trait LogsActivity
{
    /**
     * Log an activity to the database.
     *
     * @param string $action The action identifier (e.g., 'delete_peserta', 'reset_postest')
     * @param string|null $modelType The model type affected (e.g., 'UserKursusProgres')
     * @param int|null $modelId The ID of the affected model
     * @param array $properties Additional context data
     * @return void
     */
    protected function logActivity(
        string $action,
        ?string $modelType = null,
        ?int $modelId = null,
        array $properties = []
    ): void {
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'properties' => json_encode($properties),
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
