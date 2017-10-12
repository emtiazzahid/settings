<?php

namespace Kodeeo\Settings\Traits;

use Illuminate\Support\Facades\Cache;

trait GetSettings
{

    public function get( $keys = null, $default = null )
    {
        if ( is_array($keys) ) {
            foreach ( $keys as $key ) {
                $setting[ $key ] = $this->gettingExplodeValue($key, $default);
            }
        } else {
            $setting = $this->gettingExplodeValue($keys, $default);
        }

        return $setting;
    }

    private function gettingExplodeValue( $keys = null, $default = null )
    {
        $explode = explode('.', $keys);
        $setting = $this->getAll();

        if ( !isset($setting[ $explode[ 0 ] ]) ) {
            if ( !is_null($keys) ) {
                $setting = $default;
            }
        } else {
            $setting = $setting[ $explode[ 0 ] ];
        }

        if ( count($explode) > 1 && !is_null($setting) ) {
            unset($explode[ 0 ]);
            foreach ( $explode as $element ) {
                if ( isset($setting[ $element ]) ) {
                    $setting = $setting[ $element ];
                } else {
                    $setting = $default;
                    break;
                }
            }
        }

        return $setting;
    }

    public function set( $attributes, $value = null )
    {
        if(config('kodeeo-settings.cache')) {
            Cache::forget('kodeeo-settings');
        }
        if ( is_array($attributes) ) {
            foreach ( $attributes as $key => $attribute ) {
                if ( is_array($attribute) ) {
                    $attribute = json_encode($attribute);
                }
                static::updateOrInsert([ config('kodeeo-settings.keyColumn') => $key ], [ config('kodeeo-settings.valueColumn') => $attribute ])->get();
            }
        } else {
            if ( is_array($value) ) {
                $value = json_encode($value);
            }
            static::updateOrInsert([ config('kodeeo-settings.keyColumn') => $attributes ], [ config('kodeeo-settings.valueColumn') => $value ])->get();
        }

    }

    public function forget( $key )
    {
        $setting = static::where(config('kodeeo-settings.keyColumn'), $key);

        $setting->delete();
    }

    public function getAll()
    {
        $getAll = config('kodeeo-settings.cache') ? Cache::remember('kodeeo-settings', 15, function() {
            return static::all();
        }) : static::all();
        $string = json_encode($getAll->pluck(config('kodeeo-settings.valueColumn'), config('kodeeo-settings.keyColumn'))->toArray());
        $string = preg_replace([ '/}"/', '/"{/', '/\\\\/' ], [ '}', '{', '' ], $string);
        $string = collect(json_decode($string, true));

        return $string;
    }
}