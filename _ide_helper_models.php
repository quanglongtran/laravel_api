<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {
	/**
	 * App\Models\Permission
	 *
	 * @property int $id
	 * @property string $name
	 * @property string|null $display_name
	 * @property string $guard_name
	 * @property string|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
	 * @property-read int|null $permissions_count
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
	 * @property-read int|null $roles_count
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
	 * @property-read int|null $users_count
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission filter(array $data = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDisplayName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
	 */
	class Permission extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Post
	 *
	 * @property int $id
	 * @property string $name
	 * @property string $content
	 * @property int $post_thread_id
	 * @property int $user_id
	 * @property string|null $tags
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\Models\PostThread $thread
	 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|Post filter(array $data = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Post onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostThreadId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTags($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Post withTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|Post withoutTrashed()
	 */
	class Post extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\PostCategory
	 *
	 * @property int $id
	 * @property string $name
	 * @property string|null $description
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
	 * @property-read int|null $posts_count
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostThread> $threads
	 * @property-read int|null $threads_count
	 * @method static \Database\Factories\PostCategoryFactory factory($count = null, $state = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory filter(array $data = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory query()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory withTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory withoutTrashed()
	 */
	class PostCategory extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\PostThread
	 *
	 * @property int $id
	 * @property string $name
	 * @property string|null $description
	 * @property int $post_category_id
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\Models\PostCategory $category
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
	 * @property-read int|null $posts_count
	 * @method static \Database\Factories\PostThreadFactory factory($count = null, $state = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread filter(array $data = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread query()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread whereDescription($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread wherePostCategoryId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread withTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|PostThread withoutTrashed()
	 */
	class PostThread extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Role
	 *
	 * @property int $id
	 * @property string $name
	 * @property string|null $display_name
	 * @property string $guard_name
	 * @property string|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
	 * @property-read int|null $permissions_count
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
	 * @property-read int|null $users_count
	 * @method static \Illuminate\Database\Eloquent\Builder|Role filter(array $data = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
	 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDisplayName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
	 */
	class Role extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\User
	 *
	 * @property int $id
	 * @property string $name
	 * @property string $email
	 * @property \Illuminate\Support\Carbon|null $email_verified_at
	 * @property mixed $password
	 * @property string|null $remember_token
	 * @property \Illuminate\Support\Carbon|null $deleted_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
	 * @property-read int|null $notifications_count
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
	 * @property-read int|null $permissions_count
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
	 * @property-read int|null $roles_count
	 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
	 * @property-read int|null $tokens_count
	 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
	 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
	 * @method static \Illuminate\Database\Eloquent\Builder|User query()
	 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
	 * @method static \Illuminate\Database\Eloquent\Builder|User can()
	 */
	class User extends \Eloquent implements \PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject
	{
	}
}
