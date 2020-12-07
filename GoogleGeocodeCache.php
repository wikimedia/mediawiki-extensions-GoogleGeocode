<?php
/*
 * Copyright (C) 2015 Ike Hecht <tosfos@yahoo.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/**
 * Cache for Google Geocode calls
 *
 * @author Ike Hecht <tosfos@yahoo.com>
 */
class GoogleGeocodeCache {

	/**
	 * Get this call from db cache
	 *
	 * @param string $address
	 * @return string|bool
	 */
	public static function getCache( $address ) {
		$cache = ObjectCache::getInstance( CACHE_ANYTHING );
		$key = $cache->makeKey( 'googlegeocode', $address );
		$cached = $cache->get( $key );
		wfDebugLog( "GoogleGeocode",
			__METHOD__ . ": got " . var_export( $cached, true ) .
			" from cache." );
		return $cached;
	}

	/**
	 * Store this call in cache
	 *
	 * @param string $address
	 * @param string $response
	 * @param int $cache_expire
	 * @return bool
	 */
	public static function setCache( $address, $response, $cache_expire = 0 ) {
		$cache = ObjectCache::getInstance( CACHE_ANYTHING );
		$key = $cache->makeKey( 'googlegeocode', $address );
		wfDebugLog( "GoogleGeocode",
			__METHOD__ . ": caching " . var_export( $response, true ) .
			" from Google." );
		return $cache->set( $key, $response, $cache_expire );
	}
}
