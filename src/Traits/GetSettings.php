<?php

namespace Kodeeo\Settings\Traits;

use Illuminate\Support\Facades\Cache;

trait GetSettings
{

    /**
     * Getting Settings by key or keys
     *
     * @param null $keys
     * @param null $default
     *
     * @return \Illuminate\Support\Collection|null|string
     */
    public static function get( $keys = null, $default = null )
    {
        if ( is_array($keys) ) {
            foreach ( $keys as $key ) {
                $setting[ $key ] = self::gettingExplodeValue($key, $default);
            }
        } else {
            $setting = self::gettingExplodeValue($keys, $default);
        }

        if ( is_array($setting) ) {
            $setting = collect($setting);
        }

        return $setting;
    }

    /**
     * Store Settings
     *
     * @param $attributes
     * @param null $value
     *
     * @return void
     */
    public static function set( $attributes, $value = null )
    {
        self::cacheForget();
        if ( is_array($attributes) ) {
            foreach ( $attributes as $key => $attribute ) {
                if ( is_array($attribute) ) {
                    $attribute = json_encode($attribute);
                }
                static::updateOrInsert([ config('kodeeo-settings.keyColumn') => $key ],
                    [ config('kodeeo-settings.valueColumn') => $attribute ])->get();
            }
        } else {
            if ( is_array($value) ) {
                $value = json_encode($value);
            }
            static::updateOrInsert([ config('kodeeo-settings.keyColumn') => $attributes ],
                [ config('kodeeo-settings.valueColumn') => $value ])->get();
        }

    }

    /**
     * Setting Delete
     *
     * @param $keys
     *
     * @return integer
     */
    public static function forget( $keys )
    {
        self::cacheForget();
        if ( is_array($keys) ) {
            $setting = static::whereIn(config('kodeeo-settings.keyColumn'), $keys)->delete();
        } else {
            $setting = static::where(config('kodeeo-settings.keyColumn'), $keys)->delete();
        }

        return $setting;
    }

    /**
     * Having Settings key or not
     *
     * @param $keys
     *
     * @return bool|\Illuminate\Support\Collection
     */
    public static function has( $keys )
    {
        $settings = self::get($keys);

        if ( is_array($keys) ) {
            $hasSettings = [];
            foreach ( $keys as $key ) {
                $hasSettings[ $key ] = ( !is_null($settings[ $key ]) || is_array($settings[ $key ]) ) ? true : false;
            }

            return collect($hasSettings);
        } else {
            if ( !is_null($settings) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Getting All Settings
     *
     * @return \Illuminate\Support\Collection|string
     */
    public static function getAll()
    {
        $getAll = config('kodeeo-settings.cache') ? Cache::remember('kodeeo-settings', 15, function() {
            return static::all();
        }) : static::all();

        $string = json_encode($getAll->pluck(config('kodeeo-settings.valueColumn'),
            config('kodeeo-settings.keyColumn'))->toArray());
        $string = collect(json_decode(preg_replace([ '/}"/', '/"{/', '/\\\\/' ], [ '}', '{', '' ], $string), true));

        return $string;
    }

    /**
     * For Fallback Support
     *
     * @param null $keys
     * @param null $default
     *
     * @return \Illuminate\Support\Collection|mixed|null|string
     */
    private static function gettingExplodeValue( $keys = null, $default = null )
    {
        $explode = explode('.', $keys);
        $setting = self::getAll();

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

    /**
     * Delete Cache
     *
     * @return void
     */
    private static function cacheForget()
    {
        if ( config('kodeeo-settings.cache') ) {
            Cache::forget('kodeeo-settings');
        }
    }
}
