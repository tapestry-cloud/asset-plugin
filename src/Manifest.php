<?php

namespace TapestryCloud\Asset;

class Manifest
{

    /**
     * @var array|mixed
     */
    private $table = [];

    /**
     * Manifest constructor.
     *
     * @param string $path
     * @throws \Exception
     */
    public function __construct(string $path)
    {
        if (file_exists($path)) {
            $json = json_decode(file_get_contents($path), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error_msg());
            }
            $this->table = $this->parse($json);
        }
    }

    /**
     * Parse a manifest.json into a wildcard table.
     *
     * @param array $manifest
     * @return array
     */
    public function parse(array $manifest): array
    {
        $result = [];
        foreach ($manifest as $key => $value) {
            $result[$key] = $value;
            $result[pathinfo($key, PATHINFO_BASENAME)] = $value;
        }
        return $result;
    }

    /**
     * @param string $filename
     * @return string
     */
    public function find(string $filename): string
    {
        $basename = pathinfo($filename, PATHINFO_BASENAME);
        return isset($this->table[$basename]) ? $this->table[$basename] : $filename;
    }
}
