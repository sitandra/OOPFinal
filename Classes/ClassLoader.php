<?php
final class ClassLoader
{
    private static ClassLoader $instance;
    private static array $namespaces = [];

    private function __construct()
    {
        // регистрация метода load из этого же класса как функции-загрузчика
        spl_autoload_register([$this, 'load']);
    }
    private function __clone(): void
    {
    }
    public function __wakeup(): void
    {
    }

    public static function go(): self
    {
        return self::$instance ?? (self::$instance = new self());
    }

    public function load($classname): void
    {
        $class_path = $classname . '.php';
        foreach (self::$namespaces as $namespace => $path) {
            $lookup_pattern = sprintf('/^%s/', $namespace);
            if (preg_match($lookup_pattern, $classname)) {
                $class_path = preg_replace($lookup_pattern, $path, $class_path);
                break;
            }
        }
        $class_path = realpath(str_replace('\\', '/', $class_path));
        if ($class_path) include_once $class_path;
    }

    public function setNamespaces(string ...$namespaces): self
    {
        $root = $_SERVER['DOCUMENT_ROOT'] . '/Classes/';
        foreach($namespaces as $namespace) {
            self::$namespaces[$namespace] = $root . $namespace;
        }
        return $this;
    }
}

return ClassLoader::go();