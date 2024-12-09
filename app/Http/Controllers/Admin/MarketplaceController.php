<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use App\Services\Package\InstallPackageService;
use Illuminate\Http\Request;
use App\Models\Extension;
use DataTables;

class MarketplaceController extends Controller
{
    private $extensions;
    private $api;
    private $install;

    public function __construct()
    {
        $this->api = new LicenseController();
        $this->extensions = new ExtensionController();
        $this->install = new InstallPackageService();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $extensions = $this->extensions->extensions();
        $details = Extension::get();

        return view('admin.marketplace.index', compact('details', 'extensions'));
    }


    /**
     * Show Theme
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showExtension($slug)
    {   
        $theme = $this->extensions->search($slug);

        $extension = Extension::where('slug', $slug)->first();

        $tags = explode(',', $theme['tags']);

        $verify = $this->api->verify_license();
        $type = (isset($verify['type'])) ? $verify['type'] : '';

        $current_version = explode('v', config('app.version'));

        $approved = ((float)$theme['minimum_app_version'] > (float)$current_version[1]) ? false : true;
        $approved_version = $theme['minimum_app_version'];

        return view('admin.marketplace.checkout', compact('theme', 'extension', 'tags', 'type', 'approved', 'approved_version'));     
    }


    /**
     * Show Extension
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purchaseExtension(Request $request, $slug)
    {   
        session()->put('name', $slug);
        session()->put('type', $request->type);
        session()->put('amount', $request->value); 
        session()->put('extension_name', $request->extension_name);

        return view('admin.marketplace.gateway');    
    }


    /**
     * Install Extension
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function installExtension(Request $request, $slug)
    {   
        if ($request->ajax()) {

            $response = $this->install->install($slug);     
           
            return $response;  
        }
       
    }


    /**
     * Activate Extension
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activateExtension(Request $request, $slug)
    {   
        $theme = $this->extensions->checkPayment($slug);

        return redirect()->back();    
    }
    



}
