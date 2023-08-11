<?php

namespace App\Services;

use Illuminate\Support\Arr;

class TagsService
{
  public function attach($model, $data)
  {
    $model->attachTags($this->alterData($data));
  }

  public function sync($model, $data)
  {
    $model->syncTags($this->alterData($data));
  }

  protected function alterData($data)
  {
    if ($tagsArr = json_decode($data, true)) {
      $tagsArr = Arr::map($tagsArr, function ($value) {
        return $value['name'];
      });
    }

    return $tagsArr;
  }
}
