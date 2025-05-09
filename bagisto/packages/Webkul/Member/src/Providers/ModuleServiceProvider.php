<?php

namespace Webkul\Member\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Blog\Models\Post::class,
    ];
}
