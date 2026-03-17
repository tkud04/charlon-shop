<?php return array (
  'cloudinary-labs/cloudinary-laravel' => 
  array (
    'providers' => 
    array (
      0 => 'CloudinaryLabs\\CloudinaryLaravel\\CloudinaryServiceProvider',
    ),
    'aliases' => 
    array (
      'Cloudinary' => 'CloudinaryLabs\\CloudinaryLaravel\\Facades\\Cloudinary',
    ),
  ),
  'laravel/sail' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sail\\SailServiceProvider',
    ),
  ),
  'laravel/sanctum' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'nativephp/desktop' => 
  array (
    'aliases' => 
    array (
      'Dock' => 'Native\\Desktop\\Facades\\Dock',
      'Menu' => 'Native\\Desktop\\Facades\\Menu',
      'Shell' => 'Native\\Desktop\\Facades\\Shell',
      'Screen' => 'Native\\Desktop\\Facades\\Screen',
      'System' => 'Native\\Desktop\\Facades\\System',
      'Window' => 'Native\\Desktop\\Facades\\Window',
      'MenuBar' => 'Native\\Desktop\\Facades\\MenuBar',
      'Process' => 'Native\\Desktop\\Facades\\Process',
      'Updater' => 'Native\\Electron\\Facades\\Updater',
      'Settings' => 'Native\\Desktop\\Facades\\Settings',
      'Clipboard' => 'Native\\Desktop\\Facades\\Clipboard',
      'ContextMenu' => 'Native\\Desktop\\Facades\\ContextMenu',
      'QueueWorker' => 'Native\\Desktop\\Facades\\QueueWorker',
      'ChildProcess' => 'Native\\Desktop\\Facades\\ChildProcess',
      'Notification' => 'Native\\Desktop\\Facades\\Notification',
      'PowerMonitor' => 'Native\\Desktop\\Facades\\PowerMonitor',
      'GlobalShortcut' => 'Native\\Desktop\\Facades\\GlobalShortcut',
    ),
    'providers' => 
    array (
      0 => 'Native\\Desktop\\NativeServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'nunomaduro/termwind' => 
  array (
    'providers' => 
    array (
      0 => 'Termwind\\Laravel\\TermwindServiceProvider',
    ),
  ),
  'spatie/laravel-export' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Export\\ExportServiceProvider',
    ),
  ),
  'spatie/laravel-ignition' => 
  array (
    'aliases' => 
    array (
      'Flare' => 'Spatie\\LaravelIgnition\\Facades\\Flare',
    ),
    'providers' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider',
    ),
  ),
);