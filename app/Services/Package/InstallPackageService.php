<?php

namespace App\Services\Package;

use App\Http\Controllers\Admin\ExtensionController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Filesystem\Filesystem;
use App\Models\Extension;
use ZanySoft\Zip\Zip;
use Exception;

class InstallPackageService
{
    private $zip_file;    
    private $zip_path;
    private $slug;
    private $extensions;
    private $indexJson;
    private array $indexJsonArray;

    public function __construct() {
        $this->zip_file = new Zip();
        $this->extensions = new ExtensionController();
    }

    public function install($slug)
    {
        $this->slug = $slug;

        $response = $this->extensions->installExtension($slug);

        if ($response->failed()) {
            return [
                'status'  => false,
                'message' => __('Extension download failed, please contact support'),
            ];
        }

        $content = $response->body();

        $destination = "extension.zip"; 
        Storage::disk('extension')->put($destination, $content);

        try {
            
            $is_valid = $this->zip_file->check(Storage::disk('extension')->path($destination));

        } catch(Exception $e) {
            Log::info($e->getMessage());
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }

        if($is_valid === TRUE) {
            $zip = $this->zip_file->open(Storage::disk('extension')->path($destination));
            $this->zip_path = storage_path('app/extension-install');
            $zip->extract($this->zip_path); 		
            $zip->close();		
            Storage::disk('extension')->delete($destination);
        }
                
        try {
      
            $this->getIndexJson();

            if (empty($this->indexJsonArray)) {
                return [
                    'status'  => false,
                    'message' => __('index.json was not found'),
                ];
            }

            $this->makeDir($slug);

            $this->copyResource();

            $this->copyRoute();

            $this->copyControllers();

            $this->copyFiles();


            if (data_get($this->indexJsonArray, 'migration')) {
                Artisan::call('migrate');
            }

            (new Filesystem)->deleteDirectory($this->zip_path);

            Extension::query()->where('slug', $slug)
                ->update([
                    'installed' => 1,
                    'version'   => data_get($this->indexJsonArray, 'version'),
                ]);

            Artisan::call('cache:clear');

            return [
                'status'  => true,
                'message' => __('Extension installed successfully'),
            ];

        } catch (Exception $e) {
            return [
                'status'  => false,
                'message' => $e->getMessage(),
            ];
        }
        
    }


    public function copyResource()
    {
        File::copy(
            $this->zip_path . DIRECTORY_SEPARATOR . 'index.json',
            resource_path("extensions/$this->slug/index.json")
        );

        $data = data_get($this->indexJsonArray, 'migrations.uninstall');

        if (empty($data) && ! is_array($data)) {
            return;
        }

        foreach ($data as $value) {
            $path = data_get($value, 'path');

            $sqlPath = $this->zip_path . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . $path;

            File::copy($sqlPath, resource_path("extensions/$this->slug/migrations/$path"));
        }
    }

    public function copyRoute()
    {
        $route = data_get($this->indexJsonArray, 'routes');

        if (empty($route)) {
            return;
        }

        $routePath = $this->zip_path . DIRECTORY_SEPARATOR . $route;

        if (File::exists($routePath)) {
            File::copy($routePath, base_path('routes/extensions/' . basename($routePath)));
        }
    }

    public function copyControllers()
    {
        $controllers = data_get($this->indexJsonArray, 'controllers');

        if (empty($controllers) && ! is_array($controllers)) {
            return;
        }

        foreach ($controllers as $controller) {

            $sourcePath = $this->zip_path . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . basename($controller);

            $destinationPath = base_path($controller);

            Log::info("Copying $sourcePath to $destinationPath...");

            if (! File::isDirectory(dirname($destinationPath))) {
                File::makeDirectory(dirname($destinationPath), 0777, true);
            }

            File::copy($sourcePath, $destinationPath);
        }
    }

    public function copyFiles()
    {

        $zip_path = $zip_path ?? $this->zip_path;

        $files = data_get($this->indexJsonArray, 'views');

        if (empty($files) && ! is_array($files)) {
            return;
        }

        foreach ($files as $key => $file) {

            $fileName = is_numeric($key) ? basename($file) : $key;

            $sourcePath = $zip_path . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $fileName;

            $destinationPath = base_path($file);

            Log::info("Copying $sourcePath to $destinationPath...");

            if (! File::isDirectory(dirname($destinationPath))) {
                File::makeDirectory(dirname($destinationPath), 0777, true);
            }

            File::copy($sourcePath, $destinationPath);
        }
    }


    public function getIndexJson()
    {
        $path = $this->zip_path . DIRECTORY_SEPARATOR . 'index.json';

        if (! File::exists($path)) {
            return false;
        }

        $this->indexJson = file_get_contents($path);
    
        if ($this->indexJson) {
            $this->indexJsonArray = json_decode($this->indexJson, true);
        }

        return $this->indexJson;
    }


    public function makeDir($slug = null)
    {
        $slug = $slug ?? $this->$slug;

        if (! File::isDirectory(resource_path("extensions/$slug/"))) {
            File::makeDirectory(resource_path("extensions/$slug/"), 0777, true);
        }

        if (! File::isDirectory(resource_path("extensions/$slug/migrations/uninstall"))) {
            File::makeDirectory(resource_path("extensions/$slug/migrations/uninstall"), 0777, true);
        }

        if (! File::isDirectory(base_path('routes/extensions/'))) {
            File::makeDirectory(base_path('routes/extensions/'), 0777, true);
        }

    }

}