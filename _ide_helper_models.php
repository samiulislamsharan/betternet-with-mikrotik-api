<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Billing
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $invoice
 * @property string $package_name
 * @property int $package_price
 * @property string $package_start
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Billing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing wherePackageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing wherePackagePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing wherePackageStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereUserId($value)
 */
	class Billing extends \Eloquent {}
}

namespace App\Models{
/**
 * Detail
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $address
 * @property string $phone
 * @property string $dob
 * @property string|null $pin
 * @property string $router_password
 * @property string $package_name
 * @property int $package_price
 * @property string $package_start
 * @property int $due
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Detail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail wherePackageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail wherePackagePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail wherePackageStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereRouterPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detail whereUserId($value)
 */
	class Detail extends \Eloquent {}
}

namespace App\Models{
/**
 * Package
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 */
	class Package extends \Eloquent {}
}

namespace App\Models{
/**
 * User
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $invoice
 * @property string $payment_method
 * @property int $user_id
 * @property int $billing_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Billing|null $billing
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBillingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * Setting
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $router_ip
 * @property string $router_username
 * @property string $router_password
 * @property string $mail_server
 * @property string $mail_username
 * @property string $mail_password
 * @property int $mail_port
 * @property int|null $mail_from_address
 * @property int|null $mail_from_name
 * @property string|null $app_name
 * @property string|null $db
 * @property string|null $db_username
 * @property string|null $db_password
 * @property string|null $timezone
 * @property string|null $currency
 * @property int|null $bill_at
 * @property int|null $disconnect_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereBillAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDbPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDbUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDisconnectAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMailFromAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMailFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMailPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMailPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMailServer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMailUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRouterIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRouterPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRouterUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * User
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Billing> $billing
 * @property-read int|null $billing_count
 * @property-read \App\Models\Detail|null $detail
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payment
 * @property-read int|null $payment_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

