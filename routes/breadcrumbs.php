<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('Home'), route('home'));
});

// Home > User
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Users'), route('users.index'));
});
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push(__('Create'), route('users.create'));
});
Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.show', $user));
});
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.show', $user);
    $trail->push(__('Update'), route('users.edit', $user));
});
Breadcrumbs::for('users.own_show', function ($trail, $user) {
    $trail->parent('home');
    $trail->push($user->name, route('users.show', $user));
});
Breadcrumbs::for('users.own_edit', function ($trail, $user) {
    $trail->parent('users.own_show', $user);
    $trail->push(__('Update'), route('users.edit', $user));
});

// Home > Role
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Roles'), route('roles.index'));
});
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push(__('Create'), route('roles.create'));
});
Breadcrumbs::for('roles.show', function ($trail, $model) {
    $trail->parent('roles.index');
    $trail->push($model->name, route('roles.show', $model));
});
Breadcrumbs::for('roles.edit', function ($trail, $model) {
    $trail->parent('roles.show', $model);
    $trail->push(__('Update'), route('roles.edit', $model));
});

// Home > Settings
Breadcrumbs::for('settings.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Settings'), route('settings.index'));
});
Breadcrumbs::for('settings.create', function ($trail) {
    $trail->parent('settings.index');
    $trail->push(__('Create'), route('settings.create'));
});
Breadcrumbs::for('settings.show', function ($trail, $model) {
    $trail->parent('settings.index');
    $trail->push($model->name, route('settings.show', $model));
});
Breadcrumbs::for('settings.edit', function ($trail, $model) {
    $trail->parent('settings.show', $model);
    $trail->push(__('Update'), route('settings.edit', $model));
});

// Home > Permissions
Breadcrumbs::for('permissions.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Permissions'), route('permissions.index'));
});
Breadcrumbs::for('permissions.create', function ($trail) {
    $trail->parent('permissions.index');
    $trail->push(__('Create'), route('permissions.create'));
});
Breadcrumbs::for('permissions.show', function ($trail, $model) {
    $trail->parent('permissions.index');
    $trail->push($model->name, route('permissions.show', $model));
});
Breadcrumbs::for('permissions.edit', function ($trail, $model) {
    $trail->parent('permissions.show', $model);
    $trail->push(__('Update'), route('permissions.edit', $model));
});

/*
// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});*/
