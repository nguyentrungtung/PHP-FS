<?php
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

function getValidator() {
    // Tạo một instance của Filesystem
    $filesystem = new Filesystem();

    // Tạo Loader để tải các file ngôn ngữ
    $loader = new FileLoader($filesystem, 'lang'); // Thư mục chứa các file ngôn ngữ

    // Khởi tạo Translator
    $translator = new Translator($loader, 'en');   // Thiết lập ngôn ngữ

    // Khởi tạo Event Dispatcher
    $dispatcher = new Dispatcher(new Container());

    // Tạo Validator Factory với Translator và Container
    return new Factory($translator, new Container());
}

