<?php


namespace MedanWeb\Tools\Traits;


trait SaveToUpper
{
    protected $no_uppercase = [
        'id',
        'password',
        'username',
        'email',
        'remember_token',
        'slug',
    ];

    public function setAttribute($key, $value)
    {
        // Call parent method first (assuming the parent has setAttribute)
        parent::setAttribute($key, $value);

        if (is_string($value)) {
            // If $this->no_upper is defined and not null, check both lists
            $skipUpper = in_array($key, $this->no_uppercase) ||
                (isset($this->no_upper) && in_array($key, $this->no_upper));

            if (!$skipUpper) {
                $this->attributes[$key] = trim(strtoupper($value));
            }
        }
    }
}
