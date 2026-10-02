<?php

namespace App\Controllers\Beheerpaneel;

use App\Controllers\BaseController;
use App\Models\SiteConfigurationModel;
use App\Helpers\MinifyHelper;

class Minifycontroller extends BaseController
{
    public function __construct() {
        /*$this->general_model = new General_model();
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();*/
        
    }

    public function index()
    {  
        $configModel = new SiteConfigurationModel();
        $enableMinification = $configModel->getSetting('enable_minification');

        return view('beheerpaneel/minify/minify', ['enableMinification' => $enableMinification]);
    }

    public function toggleMinification()
    {
        $configModel = new SiteConfigurationModel();
        $enableMinification = $configModel->getSetting('enable_minification');

        $newSetting = $enableMinification ? 0 : 1;
        $configModel->updateSetting('enable_minification', $newSetting);

        if ($newSetting) {
            $this->minifyAssets();
        }

        return redirect()->to('/cms/minify');
    }

    private function minifyAssets()
    {
        helper('minify');

        $inputCssFile = WRITEPATH . 'css/style.css';
        $outputCssFile = WRITEPATH . 'css/style.min.css';
        MinifyHelper::minifyCss($inputCssFile, $outputCssFile);

        $inputJsFile = WRITEPATH . 'js/script.js';
        $outputJsFile = WRITEPATH . 'js/script.min.js';
        MinifyHelper::minifyJs($inputJsFile, $outputJsFile);
    }
}

?>
