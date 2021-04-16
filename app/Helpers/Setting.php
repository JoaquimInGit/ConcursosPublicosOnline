<?php

namespace App\Helpers;
use Cache;
use Illuminate\Support\Facades\DB;

class Setting
{
    private $params;
    private $options = null;

    public function __construct()
    {
        $this->params = Cache::rememberForever('setting-params', function () {
            return DB::table('settings')->select('slug', 'value')->get();
        });
    }

    /**
     * return a parameter from the config array;
     * Can be accessed using Setting::getParam('slug') or \App\Facades\Setting::getParam('slug')
     * @param string $param
     * @param boolean $isArray is is set to true it converts the string to an array
     * @return element from array or array
     */
    public function getParam($param, $isArray = false)
    {

        if($isArray){
            return json_decode($this->params->where('slug', $param)->first()->value ?? '{}', true);
        }
        return $this->params->where('slug', $param)->first()->value ?? null;
    }

    /**
     * return a parameter from the options array;
     * @param string $param
     * @param boolean $isArray is is set to true it converts the string to an array
     * @return element from array or array
     */
    public function getOptions($param, $isArray = false)
    {
        $this->options = Cache::rememberForever('setting-options', function () {
            return DB::table('settings')->select('slug', 'options')->get();
        });
        if($isArray){
            return json_decode($this->options->where('slug', $param)->first()->options ?? '{}', true);
        }
        return $this->options->where('slug', $param)->first()->options ?? null;
    }
}
