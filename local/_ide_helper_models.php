<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Attachment
 *
 * @property integer $file_id
 * @property integer $parent_file_id
 * @property string $type
 * @property string $parent_type
 * @property integer $parent_id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $storage_path
 * @property string $extension
 * @property string $name
 * @property string $mime_type
 * @property string $mime_major
 * @property integer $size
 * @property string $hash
 * @property boolean $is_temp
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereParentFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereParentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereStoragePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereMimeMajor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereHash($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereIsTemp($value)
 */
	class Attachment extends \Eloquent {}
}

namespace App{
/**
 * App\BankAccount
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $store_withdrawal_method_id
 * @property string $account_title
 * @property string $permanent_billing_address
 * @property string $temp_billing_address
 * @property string $temp_billing_address_2
 * @property string $city
 * @property string $state
 * @property string $post_code
 * @property string $country_code
 * @property string $account_number
 * @property string $iban_number
 * @property string $swift_code
 * @property string $bank_name
 * @property string $bank_branch_country_code
 * @property string $bank_branch_city
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereStoreWithdrawalMethodId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereAccountTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount wherePermanentBillingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereTempBillingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereTempBillingAddress2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount wherePostCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereIbanNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereSwiftCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereBankName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereBankBranchCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereBankBranchCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereUpdatedAt($value)
 */
	class BankAccount extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property integer $id
 * @property string $name
 * @property string $class
 * @property integer $owner_id
 * @property boolean $sort_order
 * @property integer $category_parent_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereClass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereSortOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCategoryParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\Conversation
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $deleted_at
 * @property string $type
 * @property string $title
 * @property integer $file_id
 * @property integer $updated_by
 * @property \Carbon\Carbon $created_at
 * @property integer $created_by
 * @property string $conv_for
 * @property boolean $status 1:Open, 0:Closed
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereConvFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereUpdatedAt($value)
 */
	class Conversation extends \Eloquent {}
}

namespace App{
/**
 * App\ConversationUser
 *
 * @property integer $conv_id
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\ConversationUser whereConvId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConversationUser whereUserId($value)
 */
	class ConversationUser extends \Eloquent {}
}

namespace App{
/**
 * App\Country
 *
 * @property integer $id
 * @property string $iso
 * @property string $name
 * @property string $region
 * @property string $nicename
 * @property string $iso3
 * @property integer $numcode
 * @property integer $phonecode
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereIso($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereRegion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereNicename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereIso3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereNumcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country wherePhonecode($value)
 */
	class Country extends \Eloquent {}
}

namespace App{
/**
 * App\DriverLatLng
 *
 * @property integer $id
 * @property integer $driver_id
 * @property float $latitude
 * @property float $longitude
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\DriverLatLng whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverLatLng whereDriverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverLatLng whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverLatLng whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverLatLng whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverLatLng whereCreatedAt($value)
 */
	class DriverLatLng extends \Eloquent {}
}

namespace App{
/**
 * App\DriverVehicle
 *
 * @property integer $id
 * @property integer $driver_id
 * @property string $make
 * @property string $model
 * @property string $year
 * @property string $color
 * @property string $plate_number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereDriverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereMake($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereModel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle wherePlateNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverVehicle whereUpdatedAt($value)
 */
	class DriverVehicle extends \Eloquent {}
}

namespace App{
/**
 * App\Favourite
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $object_type
 * @property integer $object_id
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property-read \App\Order $order
 * @property-read \App\User $user
 * @property-read \App\User $driver
 * @method static \Illuminate\Database\Query\Builder|\App\Favourite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favourite whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favourite whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favourite whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favourite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favourite whereCreatedAt($value)
 */
	class Favourite extends \Eloquent {}
}

namespace App{
/**
 * App\Feedback
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $rating
 * @property integer $rateable_id
 * @property string $rateable_type
 * @property string $feedback
 * @property integer $user_id
 * @property integer $order_id
 * @property-read \App\Order $order
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $rateable
 * @property-read \App\User $user
 * @property-read \App\User $rider
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereRateableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereRateableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereFeedback($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Feedback whereOrderId($value)
 */
	class Feedback extends \Eloquent {}
}

namespace App{
/**
 * App\Invitation
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $driver_id
 * @property string $object_type
 * @property integer $object_id
 * @property string $message
 * @property integer $status
 * @property boolean $is_archived
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Order $order
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereDriverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereIsArchived($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invitation whereUpdatedAt($value)
 */
	class Invitation extends \Eloquent {}
}

namespace App{
/**
 * App\Message
 *
 * @property integer $id
 * @property integer $sender_id
 * @property integer $conv_id
 * @property string $content
 * @property integer $file_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereSenderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereConvId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App{
/**
 * App\MessageStatus
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $msg_id
 * @property boolean $self
 * @property integer $status
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereMsgId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereSelf($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereStatus($value)
 */
	class MessageStatus extends \Eloquent {}
}

namespace App{
/**
 * App\Notification
 *
 * @property integer $id
 * @property integer $resource_id created for
 * @property integer $subject_id Who create
 * @property string $object_type
 * @property integer $object_id
 * @property string $type
 * @property string $read
 * @property string $clicked
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereResourceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereClicked($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App{
/**
 * App\Order
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $pin_number
 * @property integer $delivery_driver_id
 * @property integer $selected_bid_id
 * @property boolean $status
 * @property string $title
 * @property float $item_value
 * @property string $order_description
 * @property integer $category_id
 * @property float $estimate_delivery_fee
 * @property integer $item_id
 * @property string $delivery_location
 * @property string $latitude
 * @property string $longitude
 * @property string $deliver_date_time
 * @property string $pick_up_latitude
 * @property string $pick_up_longitude
 * @property string $pick_up_time
 * @property string $pick_up_location_address
 * @property boolean $pick_up_location
 * @property boolean $is_archive
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Category $category
 * @property-read \App\User $owner
 * @property-read \App\User $driver
 * @property-read \App\User $ownerWithRating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderItem[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderBid[] $bids
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderBid[] $countBids
 * @property-read \App\OrderBid $selectedBid
 * @property-read \App\Feedback $feedback
 * @property-read \App\OrderBid $myBid
 * @property-read \App\Favourite $favourite
 * @property-read \App\OrderPayment $order_payment
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePinNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereDeliveryDriverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereSelectedBidId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereItemValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereOrderDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereEstimateDeliveryFee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereDeliveryLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereDeliverDateTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePickUpLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePickUpLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePickUpTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePickUpLocationAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order wherePickUpLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereIsArchive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order active()
 */
	class Order extends \Eloquent {}
}

namespace App{
/**
 * App\OrderBid
 *
 * @property integer $id
 * @property integer $bidder_id
 * @property integer $order_id
 * @property float $bid_amount
 * @property float $proposed_item_value
 * @property string $description
 * @property string $status 1: Selected, 0: Default, 2:Deleted by Owner of bid, 3:Rejected by order owner
 * @property string $rejected_reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $bidder
 * @property-read \App\Order $order
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereBidderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereBidAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereProposedItemValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereRejectedReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderBid whereUpdatedAt($value)
 */
	class OrderBid extends \Eloquent {}
}

namespace App{
/**
 * App\OrderItem
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $name
 * @property string $detail
 * @property float $price
 * @property string $status 1: Purchased, 0: Default
 * @property integer $location_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereLocationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereUpdatedAt($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App{
/**
 * App\OrderPayment
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $transaction_code
 * @property string $type
 * @property string $currency
 * @property string $state
 * @property string $response_object
 * @property boolean $gateway_id
 * @property float $amount
 * @property float $order_amount
 * @property float $delivery_fee
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereTransactionCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereCurrency($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereResponseObject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereGatewayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereOrderAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereDeliveryFee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderPayment whereUpdatedAt($value)
 */
	class OrderPayment extends \Eloquent {}
}

namespace App{
/**
 * App\PrivacySetting
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $privacy_type
 * @property boolean $privacy_value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PrivacySetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrivacySetting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrivacySetting wherePrivacyType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrivacySetting wherePrivacyValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrivacySetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrivacySetting whereUpdatedAt($value)
 */
	class PrivacySetting extends \Eloquent {}
}

namespace App{
/**
 * App\Rating
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $rating
 * @property integer $rateable_id
 * @property string $rateable_type
 * @property string $feedback
 * @property integer $user_id
 * @property integer $order_id
 * @property-read \App\Order $order
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereRateableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereRateableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereFeedback($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rating whereOrderId($value)
 */
	class Rating extends \Eloquent {}
}

namespace App{
/**
 * App\Referrer
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $referrer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Referrer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrer whereReferrerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrer whereUpdatedAt($value)
 */
	class Referrer extends \Eloquent {}
}

namespace App{
/**
 * App\Referrers
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $referrer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $referrerId
 * @property-read \App\User $referrerToId
 * @method static \Illuminate\Database\Query\Builder|\App\Referrers whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrers whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrers whereReferrerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrers whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Referrers whereUpdatedAt($value)
 */
	class Referrers extends \Eloquent {}
}

namespace App{
/**
 * App\Report
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $object_type
 * @property integer $object_id
 * @property string $reasons
 * @property integer $status
 * @property string $description
 * @property integer $is_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereReasons($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereIsRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Report whereUpdatedAt($value)
 */
	class Report extends \Eloquent {}
}

namespace App{
/**
 * App\ReportReason
 *
 * @property integer $id
 * @property string $reason
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ReportReason whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReportReason whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReportReason whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReportReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReportReason whereUpdatedAt($value)
 */
	class ReportReason extends \Eloquent {}
}

namespace App{
/**
 * App\Share
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $object_type
 * @property integer $object_id
 * @property integer $resource_id Created for
 * @property integer $notification_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereResourceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereNotificationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Share whereUpdatedAt($value)
 */
	class Share extends \Eloquent {}
}

namespace App{
/**
 * App\SocialUser
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $social_id
 * @property string $provider
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\SocialUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialUser whereSocialId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialUser whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SocialUser whereUpdatedAt($value)
 */
	class SocialUser extends \Eloquent {}
}

namespace App{
/**
 * App\Subscriber
 *
 * @property integer $id
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Subscriber whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Subscriber whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Subscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Subscriber whereUpdatedAt($value)
 */
	class Subscriber extends \Eloquent {}
}

namespace App{
/**
 * App\Transaction
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $parent_type
 * @property integer $parent_id
 * @property float $amount
 * @property string $currency
 * @property string $transaction_type
 * @property boolean $status 0: Not delivered, 1 Delivered
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereParentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereTransactionType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transaction whereUpdatedAt($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property string $email
 * @property string $activation_code
 * @property string $active
 * @property boolean $approved
 * @property string $password
 * @property string $gender
 * @property string $dob
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $post_code
 * @property string $about
 * @property string $phone_number
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 * @property string $profile_photo_url
 * @property string $nic_front_photo_url
 * @property string $nic_back_photo_url
 * @property string $driver_license_photo_url
 * @property integer $user_type
 * @property boolean $driver_type
 * @property string $license_number
 * @property string $business_address
 * @property string $business_name
 * @property string $business_phone
 * @property float $business_lat
 * @property float $business_lng
 * @property string $remember_token
 * @property float $rating
 * @property boolean $lift_weight
 * @property string $approval_comment
 * @property string $token_expiry_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserDocument[] $documents
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserDocument[] $pendingDocument
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Rating[] $ratings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderBid[] $selected_bids
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bican\Roles\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bican\Roles\Models\Permission[] $userPermissions
 * @property-read mixed $average_rating
 * @property-read mixed $sum_rating
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActivationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDob($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePostCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereProfilePhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNicFrontPhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNicBackPhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDriverLicensePhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUserType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDriverType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLicenseNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBusinessAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBusinessName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBusinessPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBusinessLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBusinessLng($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLiftWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereApprovalComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTokenExpiryDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\UserDocument
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $document_url
 * @property boolean $status
 * @property boolean $type
 * @property string $reason
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereDocumentUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDocument whereCreatedAt($value)
 */
	class UserDocument extends \Eloquent {}
}

namespace App{
/**
 * App\Withdrawal
 *
 * @property integer $id
 * @property string $type
 * @property integer $seller_id
 * @property integer $withdrawal_method_id
 * @property float $amount
 * @property integer $fee_percentage
 * @property string $status
 * @property string $deposited_to
 * @property string $deposit_date
 * @property string $deposit_slip_number
 * @property string $deposit_attachment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $seller
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereWithdrawalMethodId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereFeePercentage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereDepositedTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereDepositDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereDepositSlipNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereDepositAttachment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Withdrawal whereUpdatedAt($value)
 */
	class Withdrawal extends \Eloquent {}
}

namespace App{
/**
 * App\WithdrawalMethod
 *
 * @property integer $id
 * @property integer $seller_id
 * @property string $method
 * @property boolean $is_default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\WithdrawalMethod whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WithdrawalMethod whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WithdrawalMethod whereMethod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WithdrawalMethod whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WithdrawalMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WithdrawalMethod whereUpdatedAt($value)
 */
	class WithdrawalMethod extends \Eloquent {}
}

