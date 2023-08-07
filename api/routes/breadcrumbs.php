<?php

declare(strict_types=1);

use App\Models\User\User;
use App\Models\Region;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Str;

Breadcrumbs::register('home', static function (Crumbs $crumbs): void {
    $crumbs->push('Главная страница', route('home'));
});

Breadcrumbs::register('login', function (Crumbs $crumbs): void {
    $crumbs->parent('home');
    $crumbs->push('Логин', route('login'));
});

Breadcrumbs::register('register', function (Crumbs $crumbs): void {
    $crumbs->parent('home');
    $crumbs->push('Регистрация', route('register'));
});

Breadcrumbs::register('password.request', function (Crumbs $crumbs): void {
    $crumbs->parent('login');
    $crumbs->push('Сбросить пароль', route('password.request'));
});

Breadcrumbs::register('password.reset', function (Crumbs $crumbs): void {
    $crumbs->parent('password.request');
    $crumbs->push('', route('password.reset', Str::uuid()));
});

Breadcrumbs::register('cabinet', function (Crumbs $crumbs): void {
    $crumbs->parent('home');
    $crumbs->push('Кабинет', route('cabinet'));
});

// Admin
Breadcrumbs::register('admin.home', function (Crumbs $crumbs): void {
    $crumbs->parent('home');
    $crumbs->push('Админ', route('admin.home'));
});

// Users
Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs): void {
    $crumbs->parent('admin.home');
    $crumbs->push('Пользователи', route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs): void {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Создать', route('admin.users.create'));
});

Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user): void {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user): void {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push('Изменить', route('admin.users.edit', $user));
});



// Regions
Breadcrumbs::register('admin.regions.index', function (Crumbs $crumbs): void {
    $crumbs->parent('admin.home');
    $crumbs->push('Регионы', route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function (Crumbs $crumbs): void {
    $crumbs->parent('admin.regions.index');
    $crumbs->push('Создать', route('admin.regions.create'));
});

Breadcrumbs::register('admin.regions.show', function (Crumbs $crumbs, Region $region): void {
    if( $parent = $region->parent){
        $crumbs->parent('admin.regions.show', $parent);
    }else{
        $crumbs->push($region->name, route('admin.regions.index', $region));
    }

    $crumbs->push($region->name, route('admin.regions.show', $region));
});

Breadcrumbs::register('admin.regions.edit', function (Crumbs $crumbs, Region $region): void {
    $crumbs->parent('admin.regions.show', $region);
    $crumbs->push('Изменить', route('admin.regions.edit', $region));
});
