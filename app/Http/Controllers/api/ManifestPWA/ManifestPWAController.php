<?php

namespace App\Http\Controllers\api\ManifestPWA;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskTemplate;
use App\Services\ManifestPWA\ManifestPWA;
use Illuminate\Http\Request;

class ManifestPWAController extends Controller
{
    public function __invoke()
    {
        $userId = auth()->user()?->id;
        $projectCode = auth()->user()?->pwa_project_code;

        if (!$userId)
            return response()->json(['message' => 'Unauthorized']);

        $manifest = new ManifestPWA();
        $manifest->load($projectCode);
        $generatedManifest = $manifest->get();

        return response()->json($generatedManifest)
            ->header('Content-Type', 'application/manifest+json')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
