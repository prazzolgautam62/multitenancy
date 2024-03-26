<?php
namespace App\Utilities;

use App\Models\Main\TenantConfiguration;

class ConvertDate
{
 	private static $configuration = [];

    //if auth()->user() is empty, set $configuration manually
    public static function setConfiguration(array $configuration) : void{
        //dd(is_array($configuration));
        static::$configuration = $configuration;
    }

 	public static function getConfiguration() : array
 	{
 		    if(empty(static::$configuration) ){
                $config = TenantConfiguration::where('tenant_id', auth()->user()->tenant_id)->value('configuration');
                if($config)
                    static::setConfiguration($config);
                else
                    static::setConfiguration(['date_type'=>'bs']);
            }
            return static::$configuration;
 	}

    public static function asConfig($date) //english date
    {
        return static::getConfiguration()['date_type'] == 'bs'
            ? englishToNepaliDate($date) : $date;
    }

    public static function toAD($date)
    {
        return static::getConfiguration()['date_type'] == 'bs'
            ? nepaliToEnglishDate($date) : $date;
    }

    public static function toBS($date)
    {
        return englishToNepaliDate($date);
    }

    public static function asReverseConfig($date){
        return static::getConfiguration()['date_type'] == 'bs' ? nepaliToEnglishDate($date) : englishToNepaliDate($date);
    }


}
