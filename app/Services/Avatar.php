<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class Avatar
{
    /**
     * Create a new avatar for the given name and email address.
     */
    public function __construct(
        private User $user,
    ) {
        //
    }

    /**
     * Get the avatar URL.
     */
    public function url(string $service = 'gravatar'): string
    {
        if ($service === 'github' && $this->user->github_username) {
            return "https://avatars.githubusercontent.com/{$this->user->github_username}";
        }

        if ($service === 'gravatar') {
            $gravatarHash = hash('sha256', mb_strtolower($this->user?->email));
            $gravatarUrl = "https://gravatar.com/avatar/{$gravatarHash}?s=300&d=404";
            $headers = get_headers($gravatarUrl);
            if ($headers !== false && ! in_array('HTTP/1.1 404 Not Found', $headers, true)) {
                return $gravatarUrl;
            }
        }

        return asset('default-avatar.png');
    }

    public function getAvatar(string $service = 'gravatar'): string
    {
        // You can add any of the gravatar supported options to this array.
        // See https://gravatar.com/site/implement/images/
        $config = [
            'default' => $this->getDefaultAvatar(),
            'size' => '300', // use 200px by 200px image
        ];

        return 'https://www.gravatar.com/avatar/' . md5($this->user?->email) . '?' . http_build_query($config);
    }

    public function getDefaultAvatar(): string
    {
        return 'https://ui-avatars.com/api/' . implode('/', [

            //IMPORTANT: Do not change this order
            urlencode($this->user?->full_name), // name
            300, // image size
            '556ee6', // background color
            'ffffff', // font color
        ]);
    }
}
