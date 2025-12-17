<?php

namespace App\Traits;

use App\Http\Middleware\CheckIp;
use App\Models\CmsLog;
use Illuminate\Support\Facades\Auth;

trait LoggableTrait
{
    public function logAction(string $action, int $objId, string $objTable, string $description = null)
    {
        CmsLog::create([
            'cms_user_id' => Auth::guard('cms')->id() ?? null,
            'obj_id' => $objId,
            'obj_table' => $objTable,
            'action' => $action,
            'description' => $description ?? '',
            'ip' => CheckIp::getRealIp() ?? request()->ip(),
            'datetime' => now(),
        ]);
    }
}
