<?php

namespace Mohamedhk2\LaravelDevTools\Classes;

class RegexConfig
{
    protected string $pattern;
    protected int $group;
    protected $callback;

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return int
     */
    public function getGroupNumber(): int
    {
        return $this->group;
    }

    /**
     * @param string $pattern
     * @param int $group
     * @param callable|null $callback
     * @throws \Exception
     */
    public function __construct(string $pattern, int $group, callable $callback = null)
    {
        $this->pattern = $pattern;
        if ($group <= 0)
            throw new \Exception('Group must be greater than 0');
        if (!$this->isValidRegex($pattern))
            throw new \Exception('The regular expression is not valid.');
        $this->group = $group;
        $this->callback = $callback;
    }

    /**
     * Validates if the given string is a valid regular expression.
     *
     * @param string $regex The regular expression to validate.
     * @return bool True if the regular expression is valid, false otherwise.
     */
    protected function isValidRegex(string $pattern): bool
    {
        // Use @ to suppress errors and warnings
        return @preg_match($pattern, '') !== false;
    }

    public function result(array $out)
    {
        return $this->callback ? ($this->callback)($this, $out) : $out[$this->getGroupNumber()] ?? [];
    }
}
