<?php

use Illuminate\Support\Facades\Route;

function active_link(string $name): bool
{
  return request()->routeIs($name);
}

function active_gallery_link(string $name, string $slug): bool
{
  return request()->routeIs($name) && head(Route::current()->parameters())->slug === $slug;
}