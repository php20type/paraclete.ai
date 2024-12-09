<?php

namespace App\Services\Package;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Extension;
use Exception;

class UninstallPackageService 
{
    private $zip_file;    
    private $zip_path;
    private $slug;
    private $extensions;
    private $indexJson;
    private array $indexJsonArray;

    public function uninstall($slug)
    {
        
        try {
            $this->slug = $slug;

            $this->zip_path = resource_path('extensions' . DIRECTORY_SEPARATOR . $slug);

            $this->getIndexJson();

            if (empty($this->indexJsonArray)) {
                return [
                    'status'  => false,
                    'message' => __('index.json was not found'),
                ];
            }

            $this->deleteViewFiles();

            $this->deleteRoutes();

            $this->deleteControllers();

            $this->deleteResource();

            Artisan::call('optimize:clear');

            Extension::query()->where('slug', $slug)
                ->update([
                    'installed' => 0,
                ]);

            Artisan::call('cache:clear');

            return [
                'status'  => true,
                'message' => __('Extension uninstalled successfully'),
            ];
        } catch (Exception $e) {
            return [
                'status'  => false,
                'message' => $e->getMessage(),
            ];
        }
    }


    public function deleteViewFiles(): void
    {
        $files = data_get($this->indexJsonArray, 'views', []);

        if (empty($files) && ! is_array($files)) {
            return;
        }

        foreach ($files as $file) {
            $path = base_path($file);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }


    public function deleteRoutes(): void
    {
        $route = data_get($this->indexJsonArray, 'route', null);

        if (empty($route)) {
            return;
        }

        $path = base_path('routes/extensions/' . basename($route));

        if (File::exists($path)) {
            File::delete($path);
        }
    }


    public function deleteControllers(): void
    {
        $controllers = data_get($this->indexJsonArray, 'controllers', []);

        if (empty($controllers) && ! is_array($controllers)) {
            return;
        }

        foreach ($controllers as $controller) {
            $path = base_path($controller);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }


    public function deleteResource(): void
    {
        File::deleteDirectory(resource_path("extensions/$this->slug"));
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


}