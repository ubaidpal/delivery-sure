<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 15-Jul-16 12:15 PM
 * File Name    : Favourites.php
 */

namespace App\Traits;

use App\Favourite;

trait Favourites
{
    public function addToFavourite($data, $user_id) {
        $isSaved = $this->isSavedOrder($data, $user_id);
        if($isSaved == 0) {
            $saveOrder = new Favourite();

            $saveOrder->user_id     = $user_id;
            $saveOrder->object_id   = $data[ 'object_id' ];
            $saveOrder->object_type = $data[ 'object_type' ];
            $saveOrder->save();
        }
        return TRUE;
    }

    private function isSavedOrder($data, $user_id) {
        return Favourite::whereUserId($user_id)
                        ->whereObjectType($data[ 'object_type' ])
                        ->whereObjectId($data[ 'object_id' ])
                        ->count();
    }

    public function getSavedJobs($user_id) {
        return Favourite::whereUserId($user_id)
                        ->whereObjectType('order')
                        ->withoutGlobalScopes()
                        ->with('order.owner')
                        ->orderBy('id', 'DESC')
                        ->paginate(\Config::get('constant_settings.PAGINATE'));
    }

    public function getSavedApiJobs($user_id) {
        $favourite = Favourite::where('user_id', $user_id)
                              ->where('favourites.object_type', 'order')
                              ->with('order.owner')
                              ->orderBy('favourites.id', 'DESC')->get();

        return $favourite;
    }

    public function getSavedOrderApiJobs($user_id) {
        $query = \DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.user_id')
                    ->join('favourites', 'favourites.object_id', '=', 'orders.id')
                    ->where('favourites.object_type', 'order')
            //->where('order_bids.status', config('constant_settings.BID_STATUS.SELECTED'))
                    ->where('favourites.user_id', $user_id)
                    ->select(['favourites.id as fav_id', 'orders.id as order_id', 'orders.*', 'users.*', 'users.id as clientId','favourites.user_id as bidder_id'])
                    ->orderBy('favourites.id', 'DESC');

        return $query->get();

    }

    public function removeFavourites($id) {
        Favourite::destroy($id);
        return TRUE;
    }

    public function removeFavouritesByUserId($favourite_id, $user_id, $type) {
        $fav = Favourite::whereUserId($user_id)->whereObjectType($type)->whereObjectId($favourite_id)->first();
        if(!empty($fav)){
            $fav->delete();
        }

        return TRUE;
    }

    public function getALlFavourites($userId, $type) {
        return $fav = Favourite::whereObjectType($type)->whereUserId($userId)->with($type)->get();
    }

    public function skipSentFavourites($userId, $type, $invitations) {
        return $fav = Favourite::whereObjectType($type)->whereUserId($userId)->whereNotIn('object_id', $invitations)->with($type)->get();
    }
}
