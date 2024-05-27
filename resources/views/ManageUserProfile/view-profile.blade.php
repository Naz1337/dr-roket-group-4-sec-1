<x-modern-layout title="@isset($user){{ $user->user_type != 0 && $user->user_type != 1 ? $user->getUserProfile()->profile_name : $user->getPlatinum()->plat_name }}@else Profile @endisset">

</x-modern-layout>
