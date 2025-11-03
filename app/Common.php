<?php

if (! function_exists('current_user')) {
    function current_user(): ?array
    {
        $session = session();
        return $session->get('user');
    }
}

if (! function_exists('user_has_role')) {
    function user_has_role(string ...$roles): bool
    {
        $session = session();
        $role    = $session->get('role');
        return in_array($role, $roles, true);
    }
}
