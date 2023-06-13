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

function videoId(string $url): ? string
{
  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube.com/shorts/)([^"&?/ ]{11})%i', $url, $match);
  
  if (array_key_exists(1, $match))
  {
      return $match[1];
  }

  return null;
}