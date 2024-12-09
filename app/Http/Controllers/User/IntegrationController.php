<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserIntegration;
use App\Models\Integration;
use App\Services\HelperService;
use Exception;

class IntegrationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $integrations = Integration::get();

        return view('user.integration.index', compact('integrations'));
    }

}
