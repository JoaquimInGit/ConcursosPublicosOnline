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

Breadcrumbs::for('contests.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Contests'), route('contests.index'));
});
Breadcrumbs::for('contests.create', function ($trail) {
    $trail->parent('contests.index');
    $trail->push(__('Create'), route('contests.create'));
});
Breadcrumbs::for('contests.show', function ($trail, $contest) {
    $trail->parent('contests.index');
    $trail->push($contest->num_announcement, route('contests.show', $contest->id));
});
Breadcrumbs::for('contests.edit', function ($trail, $contest) {
    $trail->parent('contests.show', $contest);
    $trail->push(__('Update'), route('contests.edit', $contest));
});


Breadcrumbs::for('entities.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Entities'), route('entities.index'));
});
Breadcrumbs::for('entities.create', function ($trail) {
    $trail->parent('entities.index');
    $trail->push(__('Create'), route('entities.create'));
});
Breadcrumbs::for('entities.show', function ($trail, $entity) {
    $trail->parent('entities.index');
    $trail->push($entity->name, route('entities.show', $entity));
});
Breadcrumbs::for('entities.edit', function ($trail, $entity) {
    $trail->parent('entities.show', $entity);
    $trail->push(__('Update'), route('entities.edit', $entity));
});
Breadcrumbs::for('entities.own_show', function ($trail, $entity) {
    $trail->parent('home');
    $trail->push($entity->name, route('entities.show', $entity));
});
Breadcrumbs::for('entities.own_edit', function ($trail, $entity) {
    $trail->parent('entities.own_show', $entity);
    $trail->push(__('Update'), route('entities.edit', $entity));
});


Breadcrumbs::for('filters.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Filters'), route('filters.index'));
});
Breadcrumbs::for('filters.create', function ($trail) {
    $trail->parent('filters.index');
    $trail->push(__('Create'), route('filters.create'));
});
Breadcrumbs::for('filters.show', function ($trail, $filter) {
    $trail->parent('filters.index');
    $trail->push($filter->filter_name, route('filters.show', $filter));
});
Breadcrumbs::for('filters.edit', function ($trail, $filter) {
    $trail->parent('filters.show', $filter);
    $trail->push(__('Update'), route('filters.edit', $filter));
});
Breadcrumbs::for('filters.own_show', function ($trail, $filter) {
    $trail->parent('home');
    $trail->push($filter->filter_name, route('filters.show', $filter));
});
Breadcrumbs::for('filters.own_edit', function ($trail, $filter) {
    $trail->parent('filters.own_show', $filter);
    $trail->push(__('Update'), route('filters.edit', $filter));
});


Breadcrumbs::for('contest_filters.index', function ($trail) {
    $trail->push(__('Contest Filters'), route('contest_filters.index'));
});


Breadcrumbs::for('products.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Products'), route('products.index'));
});
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products.index');
    $trail->push(__('Create'), route('products.create'));
});
Breadcrumbs::for('products.show', function ($trail, $product) {
    $trail->parent('products.index');
    $trail->push($product->name, route('products.show', $product));
});
Breadcrumbs::for('products.edit', function ($trail, $product) {
    $trail->parent('products.show', $product);
    $trail->push(__('Update'), route('products.edit', $product));
});
Breadcrumbs::for('products.own_show', function ($trail, $product) {
    $trail->parent('home');
    $trail->push($product->name, route('products.show', $product));
});
Breadcrumbs::for('products.own_edit', function ($trail, $product) {
    $trail->parent('products.own_show', $product);
    $trail->push(__('Update'), route('products.edit', $product));
});


Breadcrumbs::for('orders.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Orders'), route('orders.index'));
});
Breadcrumbs::for('orders.create', function ($trail) {
    $trail->parent('orders.index');
    $trail->push(__('Create'), route('orders.create'));
});
Breadcrumbs::for('orders.show', function ($trail, $order) {
    $trail->parent('orders.index');
    $trail->push($order->id, route('orders.show', $order));
});
Breadcrumbs::for('orders.edit', function ($trail, $order) {
    $trail->parent('orders.show', $order);
    $trail->push(__('Update'), route('orders.edit', $order));
});
Breadcrumbs::for('orders.own_show', function ($trail, $order) {
    $trail->parent('home');
    $trail->push($order->id, route('orders.show', $order));
});
Breadcrumbs::for('orders.own_edit', function ($trail, $order) {
    $trail->parent('orders.own_show', $order);
    $trail->push(__('Update'), route('orders.edit', $order));
});